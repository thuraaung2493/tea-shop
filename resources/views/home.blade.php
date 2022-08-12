@extends('layout.master')

@section('title', 'Home')

@section('main-content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Status</th>
              <th class="text-end">Total Amount</th>
              <th class="text-center">Total Quantity</th>
              <th class="text-center">Transfer</th>
              <th class="text-center">Order / Checkout</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($summary as $data)
              <tr>
                <td>{{ $data->tableNo }}</td>
                <td>
                  <span class="badge rounded-pill {{ $data->getBackgroundClass() }}">
                    {{ $data->status->value }}
                  </span>
                </td>
                <td class="text-end">{{ $data->getTotalAmount()->formatted() }}</td>
                <td class="text-center">{{ $data->getTotalQuantity() }}</td>
                <td class="text-center">
                  <button class="btn btn-primary">
                    Transfer
                  </button>
                </td>
                <td class="text-center">
                  @if ($data->isCheckout())
                    <a href="{{ route('order.checkout', $data->order->id) }}"
                      class="btn btn-primary">Checkout</a>
                  @else
                    <a href="{{ route('tables.show', $data->tableNo) }}"
                      class="btn btn-primary">Order</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $summary->links() }}
      </div>
    </div>
  @endsection
