@extends('layout.master')

@section('title', 'Checkout')

@section('main-content')
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="mb-3 card border-secondary">
        <div class="card-header">Checkout ({{ $orderedData->tableNo() }})</div>
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
                    {{ $orderedData->getTotalAmount()->formatted() }}
                  </span>
                </h5>
              </div>
            </div>
          </h5>
          <h5 class="mb-5 card-title">
            <div class="row">
              <div class="col-6 d-flex justify-content-between">
                <span class="d-block">Total Quantity</span>
                <span class="d-block">:</span>
              </div>
              <div class="col-6">
                {{ $orderedData->getTotalQuantity() }}
              </div>
            </div>
          </h5>
          <div class="d-grid">
            <button class="btn btn-primary">Checkout</button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-8">
      <div class="card border-secondary">
        <div class="card-header">
          Product Details List
        </div>
        <div class="card-body">
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
              @foreach ($orderedData->items as $index => $item)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>
                    <x-img src="{{ $item->product->image }}" />
                  </td>
                  <td>{{ $item->product->name }}</td>
                  <td>{{ $item->totalQuantity }}</td>
                  <td>{{ $item->totalPrice->formatted() }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
