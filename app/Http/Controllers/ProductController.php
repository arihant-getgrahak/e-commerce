<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Models\Attributes;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\OrderAdress;
use App\Models\Product;
use App\Models\Search;
use Cache;
use DB;
use Illuminate\Http\Request;
use Storage;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        $attribute = Attributes::with('values')->get();
        $data = [];

        foreach ($categories as $category) {
            if ($category->parent) {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->parent->name.' - '.$category->name,
                ];
            } else {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }
        }

        $brand = Brand::all();

        return view('addproduct')->with('category', $data)->with('brand', $brand)->with('attribute', $attribute);
    }

    public function admindisplay()
    {
        $product = Product::where('added_by', auth()->user()->id)->with(['gallery', 'meta', 'brand', 'category', 'attributeValues.attribute'])->paginate(6);
        $categories = Category::with('parent')->get();
        $data = [];
        $brand = Brand::all();

        foreach ($categories as $category) {
            if ($category->parent) {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->parent->name.' - '.$category->name,
                    'parent_id' => $category->parent_id,
                ];
            } else {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }
        }

        if (! $product) {
            return view('productview')->with('product', []);
        }

        return view('productview')->with('product', $product)->with('category', $data)->with('brand', $brand);
    }

    public function display()
    {
        $country = session('country');

        $exchangeRate = Cache::remember('exchangeRate', now()->addHours(24), function () {
            return getExchangeRate();
        });

        $currencyInfo = Cache::remember('currencyInfo', now()->addHours(24), function () use ($country) {
            return getCurrencySymbol($country);
        });

        $currencySymbol = $currencyInfo['data'] ?? null;
        $currencyCode = $currencyInfo['currency_code'] ?? null;
        $product = Product::with(['gallery', 'meta', 'brand', 'category', 'attributeValues.attribute'])->paginate(10);

        $exchangeRateForCurrency = $exchangeRate['data'][$currencyCode] ?? 1;

        $product->getCollection()->transform(function ($product) use ($exchangeRateForCurrency, $currencySymbol) {
            $product->price = round($product->price * $exchangeRateForCurrency, 2);
            $product->currency = $currencySymbol;
            $product->cost_price = round($product->cost_price * $exchangeRateForCurrency, 2);

            return $product;
        });

        $categories = Category::with(['parent'])->get();
        $brand = Brand::withCount('products')->get();

        $data = [];
        $addedParents = [];

        foreach ($categories as $category) {
            if ($category->parent_id && ! isset($addedParents[$category->parent_id])) {
                $addedParents[$category->parent_id] = true;

                $data[] = [
                    'id' => $category->parent->id,
                    'name' => $category->parent->name,
                    'child' => $this->getChild($category->parent_id),
                ];
            }
        }

        $isLoggedin = auth()->check();
        $recentSearches = null;

        if ($isLoggedin) {
            $recentSearches = Search::where('user_id', auth()->user()->id)->get();
        } else {
            $recentSearches = Search::where('session_id', session()->getId())->get();
        }
        session()->put('recentsearch', $recentSearches);

        return view('welcome')->with('product', $product)->with('categories', collect($data))->with('brand', $brand);
    }

    public function store(ProductAddRequest $request)
    {

        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'added_by' => auth()->user()->id,
                'brand_id' => $request->brand_id,
                'slug' => $request->slug,
                'thumbnail' => $this->uploadImage($request->file('thumbnail')),
                'cost_price' => $request->cost_price,
                'sku' => $request->sku,
                'weight' => $request->weight,
            ];
            DB::beginTransaction();
            $product = Product::create($data);
            if (isset($request->attributes)) {
                foreach ($request->attribute as $attribute) {
                    $product->attributeValues()->attach($attribute);
                }
            } else {
                $product->attributeValues()->attach($request->attribute);
            }
            DB::commit();

            if ($request->hasFile('image')) {
                if (is_array($request->file('image'))) {
                    $imageFiles = $request->file('image');
                    foreach ($request->file('image') as $file) {
                        $imagePath = $this->uploadImage($file);
                        DB::beginTransaction();
                        Gallery::create([
                            'product_id' => $product->id,
                            'image' => $imagePath,
                        ]);
                        DB::commit();
                    }
                } else {
                    $imagePath = $this->uploadImage($request->file('image'));
                    DB::beginTransaction();
                    Gallery::create([
                        'product_id' => $product->id,
                        'image' => $imagePath,
                    ]);
                    DB::commit();
                }
            }

            return back()->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::with('gallery')->find($id);
        if (! $product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $this->uploadImage($request->file('thumbnail'));
                $product->thumbnail = $thumbnail;
            }

            $updateData = $request->only([
                'name',
                'description',
                'price',
                'stock',
                'category_id',
                'added_by',
                'cost_price',
                'brand_id',
            ]);

            $product->fill($updateData)->save();

            if ($request->hasFile('image')) {
                $product->gallery()->delete();
                $images = is_array($request->file('image')) ? $request->file('image') : [$request->file('image')];

                $galleryImages = [];
                foreach ($images as $file) {
                    $imagePath = $this->uploadImage($file);
                    $galleryImages[] = [
                        'product_id' => $product->id,
                        'image' => $imagePath,
                    ];
                }
                Gallery::insert($galleryImages);
            }

            DB::commit();

            $product->load('gallery');

            return back()->with('success', 'Product updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'An error occurred while updating the product: '.$e->getMessage());
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (! $product) {

            return back()->with('error', 'Incorrect product id');
        }
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }

    public function specific($id)
    {
        $country = session('country');

        $exchangeRate = Cache::remember('exchangeRate', now()->addHours(24), function () {
            return getExchangeRate();
        });

        $currencyInfo = Cache::remember('currencyInfo', now()->addHours(24), function () use ($country) {
            return getCurrencySymbol($country);
        });

        $currencySymbol = $currencyInfo['data'] ?? null;
        $currencyCode = $currencyInfo['currency_code'] ?? null;
        $product = Product::with(['gallery', 'meta', 'brand', 'category', 'attributeValues.attribute'])->paginate(10);

        $exchangeRateForCurrency = $exchangeRate['data'][$currencyCode] ?? 1;

        $product = Product::where('slug', $id)->with(['gallery', 'meta', 'brand', 'category', 'attributeValues.attribute'])->get();

        if (! $product) {
            return view('specificproduct')->with('error', 'Incorrect product id');
        }

        $product->transform(function ($product) use ($exchangeRateForCurrency, $currencySymbol) {
            $product->price = round($product->price * (float) $exchangeRateForCurrency, 2);
            $product->currency = $currencySymbol;
            $product->cost_price = round($product->cost_price * $exchangeRateForCurrency, 2);

            return $product;
        });

        $random = Product::where('category_id', $product[0]->category_id)->inRandomOrder()->get(['name', 'slug', 'price', 'cost_price', 'stock', 'thumbnail']);
        $random->transform(function ($random) use ($exchangeRateForCurrency, $currencySymbol) {
            $random->price = round($random->price * (float) $exchangeRateForCurrency, 2);
            $random->currency = $currencySymbol;
            $random->cost_price = round($random->cost_price * $exchangeRateForCurrency, 2);

            return $random;
        });

        return view('specificproduct')->with('product', $product)->with('random', $random);
    }

    protected function uploadImage($file)
    {
        // dd($file);
        $uploadFolder = 'product';
        $image = $file;
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageUrl = Storage::disk('public')->url($image_uploaded_path);

        return $uploadedImageUrl;
    }

    public function getChild($id)
    {
        // $child = Category::where('parent_id', $id)->get();
        $child = Category::where('parent_id', $id)->withCount('products')->get();

        return $child;
    }

    public function priceFilter(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'min' => 'required|numeric',
            'max' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $country = session('country');

        $exchangeRate = Cache::remember('exchangeRate', now()->addHours(24), function () {
            return getExchangeRate();
        });

        $currencyInfo = Cache::remember('currencyInfo', now()->addHours(24), function () use ($country) {
            return getCurrencySymbol($country);
        });

        $currencySymbol = $currencyInfo['data'] ?? null;
        $currencyCode = $currencyInfo['currency_code'] ?? null;

        $exchangeRateForCurrency = $exchangeRate['data'][$currencyCode] ?? 1;

        $priceFilter = Product::whereBetween('price', [$request->min, $request->max])->with(['gallery', 'meta', 'brand', 'category'])->paginate(10);

        $priceFilter->getCollection()->transform(function ($product) use ($exchangeRateForCurrency, $currencySymbol) {
            $product->price = round($product->price * $exchangeRateForCurrency, 2);
            $product->currency = $currencySymbol;
            $product->cost_price = round($product->cost_price * $exchangeRateForCurrency, 2);

            return $product;
        });

        return response()->json(['product' => $priceFilter], 200);
    }

    public function address()
    {
        $address = OrderAdress::where('user_id', auth()->id())->paginate(5);

        if ($address->isEmpty()) {
            return view('address');
        }

        return view('address', compact('address'));
    }
}
