<?php

namespace App\DataTransferObjects;

use Illuminate\Http\UploadedFile;

class ProductData
{
    public function __construct(
        public readonly string $name,
        public readonly string $price,
        public readonly ?UploadedFile $image,
        public readonly ?string $description,
    ) {
    }

    public static function of($data)
    {
        if (!array_key_exists('image', $data)) {
            $data['image'] = null;
        }

        return new static(...$data);
    }
}
