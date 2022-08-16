@extends('layout.app')

@section('title', 'Order')

@section('content')
  @include('modals.order-confirm-modal')

  <div class="container">
    <form action="{{ route('tables.order', $viewModel->currentTable) }}" method="POST" id="orderForm">
      @csrf

      <div class="row">
        @foreach ($viewModel->products() as $product)
          <div class="col-3 mb-4">
            <div class="card text-center">
              <x-img src="{{ $product->image }}" alt="bugger" class="card-img-top" />
              <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">
                  Price - {{ $product->price->formatted() }}
                </p>
                <p class="d-flex justify-content-around" data-product="{{ $product }}">
                  <button type="button" class="btn btn-primary decrementBtn"> - </button>
                  <input type="text" name="product_{{ $product->id }}" value="0"
                    min="0" readonly class="item-count">
                  <button type="button" class="btn btn-primary incrementBtn"> + </button>
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </form>
    <div class="row">
      <div class="col-auto me-auto"></div>
      <div class="col-auto">
        <button type="button" class="btn btn-success btn-lg" id="orderBtn">Order Now</button>
      </div>
    </div>
  </div>
@endsection
