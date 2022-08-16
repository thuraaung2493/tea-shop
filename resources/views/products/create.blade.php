@extends('layout.master')

@section('title', 'Create Product')

@section('main-content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Product</div>

        <div class="card-body">
          <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">Product Name</label>

              <div class="col-md-6">
                <input id="name" type="text"
                  class="form-control @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name') }}">

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="price" class="col-md-4 col-form-label text-md-end">Product Price</label>

              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text">MMK</span>
                  <input type="text" class="form-control @error('price') is-invalid @enderror"
                    name="price" value="{{ old('price') }}" required aria-label="Amount (MMK)">
                </div>

                @error('price')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="image" class="col-md-4 col-form-label text-md-end">Product Image</label>

              <div class="col-md-6">
                <input class="form-control @error('image') is-invalid @enderror" type="file"
                  id="image" name="image">

                @error('image')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="price" class="col-md-4 col-form-label text-md-end">Product
                Description</label>

              <div class="col-md-6">
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>

                @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Create
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
