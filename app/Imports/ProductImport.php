<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'stock' => $row['stock'],
            'category_id' => $row['category_id'],
            'added_by' => $row['added_by'],
            'brand_id' => $row['brand_id'],
            'slug' => Str::slug($row['name']),
            'thumbnail' => $row['thumbnail'],
            'cost_price' => $row['cost_price'],
            'sku' => $row['sku'],
            'weight' => $row['weight'],
        ]);
    }
}
