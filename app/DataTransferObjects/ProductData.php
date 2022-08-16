<?php

namespace App\DataTransferObjects;

use App\ValueObjects\Price;
use Illuminate\Http\UploadedFile;

class ProductData
{
    public function __construct(
        public readonly string $name,
        public readonly string $price,
        public readonly UploadedFile $image,
        public readonly ?string $description,
    ) {
    }
}
