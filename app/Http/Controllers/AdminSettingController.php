<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoreRequest;
use App\Models\Store;
use Artisan;
use DB;
use File;
use Illuminate\Http\Request;
use Validator;

class AdminSettingController extends Controller
{
    public function shiprocketView()
    {
        $data = [
            'username' => env('SHIPROCKET_USERNAME'),
            'password' => env('SHIPROCKET_PASSWORD'),
            'channelId' => env('SHIPROCKET_CHANNEL_ID'),
        ];

        return view('admin.setting.shiprocket', compact('data'));
    }

    public function forexView()
    {
        return view('admin.setting.forex');
    }

    public function storeView()
    {
        $store = Store::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.setting.store', compact('store'));
    }

    public function changeCredentials(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'channelId' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate->errors());
        }

        $data = $request->only(['username', 'password', 'channelId']);

        $this->updateEnv([
            'SHIPROCKET_USERNAME' => $data['username'],
            'SHIPROCKET_PASSWORD' => $data['password'],
            'SHIPROCKET_CHANNEL_ID' => $data['channelId'],
        ]);

        return back()->with('success', 'Credentials updated');
    }

    protected function updateEnv(array $data)
    {
        $envPath = base_path('.env');

        if (! File::exists($envPath)) {
            return false;
        }

        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            $escaped = preg_quote('='.env($key), '/');
            $envContent = preg_replace("/^{$key}{$escaped}/m", "{$key}={$value}", $envContent) ?? $envContent;

            if (! str_contains($envContent, "{$key}=")) {
                $envContent .= "\n{$key}={$value}";
            }
        }

        File::put($envPath, $envContent);

        Artisan::call('config:clear');
    }

    public function adminStore(CreateStoreRequest $request)
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'tax_type' => $request->tax_type,
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'phone' => $request->phone,
                'gst' => $request->gst,
            ];

            DB::beginTransaction();
            Store::create($data);
            DB::commit();

            return back()->with('success', 'Store Added Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function storeDelete($id)
    {
        try {
            if (Store::where('user_id', auth()->user()->id)->count() <= 1) {
                return back()->with('error', 'You can not delete last store');
            }
            DB::beginTransaction();
            Store::where('id', $id)->delete();
            DB::commit();

            return back()->with('success', 'Store deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function storeUpdate(Request $request, $id)
    {
        try {
            $data = $request->only([
                'tax_type',
                'name',
                'address',
                'city',
                'state',
                'country',
                'pincode',
                'phone',
                'gst',
            ]);
            DB::beginTransaction();
            Store::where('id', $id)->update($data);
            DB::commit();

            return back()->with('success', 'Store Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
