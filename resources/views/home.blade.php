@extends('layout.master')

@section('title', 'Home')

@section('main-content')
  @include('modals.form-submit-confirm')
  @include('modals.table-transfer-modal')

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-baseline">
            <div>All Tables</div>
            <button type="button" class="btn btn-primary" id="submit">Add Table</button>
            <form id="form" action="{{ route('tables.store') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
          <div class="card-body">
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
                    <td>
                      {{ $data->table->no }}
                    </td>
                    <td>
                      <span class="badge rounded-pill {{ $data->getBackgroundClass() }}">
                        {{ $data->table->status->value }}
                      </span>
                    </td>
                    <td class="text-end">{{ $data->getTotalAmount()->formatted() }}</td>
                    <td class="text-center">{{ $data->getTotalQuantity() }}</td>
                    <td class="text-center">
                      @if ($data->table->isTransfer())
                        <button type="button" data-table-no="{{ $data->table->no }}"
                          class="btn btn-primary transferBtn">Transfer</button>
                      @else
                        <button type="button" class="btn btn-primary" disabled>Transfer</button>
                      @endif
                    </td>
                    <td class="text-center">
                      @if ($data->isCheckout())
                        <a href="{{ route('tables.checkout', $data->table->no) }}"
                          class="btn btn-primary">Checkout</a>
                      @else
                        <a href="{{ route('tables.show', $data->table->no) }}"
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
      </div>
    </div>
  </div>
@endsection


@push('scripts')
  @vite(['resources/js/submitForm.js', 'resources/js/tableTransfer.js'])
@endpush
