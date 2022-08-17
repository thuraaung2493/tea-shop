@extends('layout.master')

@section('title', 'Edit Product')

@section('main-content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit Product ({{ $product->name }})</div>

        <div class="card-body">
          <form method="POST" action="{{ route('products.update', $product->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Product Name</label>

              <div class="col-md-6">
                <input id="name" type="text"
                  class="form-control @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name', $product->name) }}">

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="mb-3 row">
              <label for="price" class="col-md-4 col-form-label text-md-end">Product Price</label>

              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text">MMK</span>
                  <input type="text" class="form-control @error('price') is-invalid @enderror"
                    name="price" value="{{ old('price', $product->price->value()) }}" required
                    aria-label="Amount (MMK)">
                </div>

                @error('price')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="mb-3 row">
              <label for="image" class="col-md-4 col-form-label text-md-end">Product Image</label>
              <div class="col-md-5">
                <input class="form-control @error('image') is-invalid @enderror" type="file"
                  id="image" name="image" value="{{ $product->image }}">

                @error('image')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-1">
                <x-img src="{{ $product->image }}" id="imagePreview" />
              </div>
            </div>

            <div class="mb-3 row">
              <label for="price" class="col-md-4 col-form-label text-md-end">Product
                Description</label>

              <div class="col-md-6">
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>

                @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="mb-0 row">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
