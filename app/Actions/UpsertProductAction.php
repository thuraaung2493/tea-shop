<?php

namespace App\Actions;

use App\DataTransferObjects\ProductData;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class UpsertProductAction
{
    public function execute(Product $product, ProductData $productData)
    {
        $image = $product->image->name ?? 'food.jpg';

        if ($productData->image) {
            $image = $this->upoadImage($productData->image, $productData->name);
        }

        $product->name = $productData->name;
        $product->price = $productData->price;
        $product->image = $image;
        $product->description = $productData->description;
        $product->save();
        return $product;
    }

    private function upoadImage(UploadedFile $image, string $name)
    {
        return (new FileUploadAction)->execute($image, $name);
    }
}
