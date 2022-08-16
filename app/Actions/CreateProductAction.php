<?php

namespace App\Actions;

use App\DataTransferObjects\ProductData;
use App\Models\Product;

class CreateProductAction
{
    public function execute(ProductData $productData,)
    {
        $image = (new FileUploadAction)->execute($productData->image, $productData->name);

        Product::create([
            'name' => $productData->name,
            'price' => $productData->price,
            'image' => $image,
            'description' => $productData->description,
        ]);
    }
}
