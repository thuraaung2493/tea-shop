@extends('layout.master')

@section('title', 'Products')

@section('main-content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-baseline">
            <div>All Products</div>
            <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
            <form id="create-table-form" action="{{ route('tables.store') }}" method="POST"
              class="d-none">
              @csrf
            </form>
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                      <x-img src="{{ $product->image }}" alt="{{ $product->name }}" />
                    </td>
                    <td>
                      {{ $product->price->formatted() }}
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>
                      <a class="btn btn-primary" href="#">Edit</a>
                      <a class="btn btn-danger" href="#">Delete</a>
                    </td>
                  </tr>
                @endforeach

              </tbody>
            </table>
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
