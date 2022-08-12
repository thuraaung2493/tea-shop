@extends('layout.master')

@section('title', 'Checkout')

@section('main-content')

  <div class="row">
    <div class="col-4">
      <div class="card border-secondary mb-3">
        <div class="card-header">Checkout</div>
        <div class="card-body text-secondary">
          <h5 class="card-title">
            <div class="row">
              <div class="col-6 d-flex justify-content-between">
                <span class="d-block">Total Price</span>
                <span class="d-block">:</span>
              </div>
              <div class="col-6">
                <h5 class="card-title">
                  <span>
                    {{ $order->products->getTotalAmount()->formatted() }}
                  </span>
                </h5>
              </div>
            </div>
          </h5>
          <h5 class="card-title mb-4">
            <div class="row">
              <div class="col-6  d-flex justify-content-between">
                <span class="d-block">Total Quantity</span>
                <span class="d-block">:</span>
              </div>
              <div class="col-6">
                {{ $order->products->getTotalQuantity() }}
              </div>
            </div>
          </h5>
          <div class="d-grid">
            <button class="btn btn-primary">Checkout</button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-8">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($order->products->items as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td><img src="{{ $item->product->image }}" alt="image"></td>
              <td>{{ $item->product->name }}</td>
              <td>{{ $item->totalQuantity }}</td>
              <td>{{ $item->totalPrice->formatted() }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
