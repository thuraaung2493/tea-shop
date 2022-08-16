@extends('layout.master')

@section('title', 'Checkout')

@section('main-content')
  @include('modals.table-merge-modal', [
      'table' => $viewModel->currentTable,
      'reservedTables' => $viewModel->currentTable->otherReservedTables(),
  ])

  <div class="row">
    <div class="col-12 col-md-4">
      <div class="mb-3 card border-secondary">
        <div class="card-header">Checkout ({{ $viewModel->tableNos() }})</div>
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
                    {{ $viewModel->totalAmount()->formatted() }}
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
                {{ $viewModel->totalQuantity() }}
              </div>
            </div>
          </h5>
          <div class="d-grid">
            <button class="mb-3 btn btn-primary">Checkout</button>
            <button class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#tableMergeModal">Merge with Other
              Tables</button>
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
          @foreach ($viewModel->checkoutOrders as $orderedData)
            <table class="table table-striped caption-top">
              <caption>
                <span class="me-3">Products of {{ $orderedData->table->no }}</span>
                @if ($viewModel->currentTable->isNot($orderedData->table))
                  <button class="btn btn-sm btn-outline-danger"
                    data-table="{{ $orderedData->table->no }}" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Remove {{ $orderedData->table->no }}">X</button>
                @endif
              </caption>
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
          @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection
