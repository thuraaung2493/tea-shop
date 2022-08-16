<x-modal title="Table Transfer" size="modal-lg" id="tableTransferModal">
  <form action="{{ route('tables.transfer') }}" method="POST" id="tableTransferForm">
    @csrf

    <div class="row mb-3">
      <label for="from" class="col-md-4 col-form-label text-md-end">From</label>

      <div class="col-md-6">
        <input id="from" type="text" class="form-control" name="from">
      </div>
    </div>

    <div class="row mb-3">
      <label for="to" class="col-md-4 col-form-label text-md-end">To</label>

      <div class="col-md-6">
        <select id="to" name="to" class="form-select"
          aria-label="Default select example">
          @foreach ($freeTables as $table)
            <option value="{{ $table->no }}">{{ $table->no }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <x-slot:action>
      <button type="button" class="btn btn-primary" id="transferBtn">Transfer</button>
      </x-slot>
  </form>

</x-modal>
