<?php

namespace App\Http\Controllers;

use App\Actions\GetProductsAction;
use App\Actions\UpsertProductAction;
use App\DataTransferObjects\ProductData;
use App\Http\Requests\UpsertProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(
        protected GetProductsAction $getProducts,
        protected UpsertProductAction $upsertProduct,
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
        $this->upsert($request, new Product());

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('products.edit')->with('product', $product);
    }

    public function update(UpsertProductRequest $request, Product $product)
    {
        $this->upsert($request, $product);

        return redirect()->route('products.index');
    }

    private function upsert(UpsertProductRequest $request, Product $product): Product
    {
        $productData = ProductData::of($request->validated());

        return $this->upsertProduct->execute($product, $productData);
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->image->name);

        $product->delete();

        return redirect()->route('products.index');
    }

    public function showImage(string $image)
    {
        return response()->file(Storage::path($image));
    }
}
