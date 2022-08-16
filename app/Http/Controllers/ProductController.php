<?php

namespace App\Http\Controllers;

use App\Actions\CreateProductAction;
use App\Actions\GetProductsAction;
use App\DataTransferObjects\ProductData;
use App\Http\Requests\UpsertProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(
        protected GetProductsAction $getProducts,
        protected CreateProductAction $createProduct,
    ) {
    }

    public function index()
    {
        return view('products.index')->with('products', $this->getProducts->execute());
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(UpsertProductRequest $request)
    {
        $productData = new ProductData(...$request->validated());

        $this->createProduct->execute($productData);

        return redirect()->route('products.index');
    }

    public function showImage(string $image)
    {
        return response()->file(Storage::path($image));
    }
}
