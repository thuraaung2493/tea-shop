<x-modal title="Table Merge" size="modal-lg" id="tableMergeModal">
  <form action="{{ route('tables.checkout', $table->no) }}" method="GET" id="mergeTableForm">
    <div class="mb-3 row">
      <label for="this_table" class="col-md-4 col-form-label text-md-end">Current Table</label>

      <div class="col-md-6">
        <input id="this_table" type="text" class="form-control" value="{{ $table->no }}">
      </div>
    </div>

    <div class="mb-3 row">
      <label for="this_table" class="col-md-4 col-form-label text-md-end">Merge Tables</label>
      <div class="col-md-6">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="selectTables"
            data-bs-toggle="dropdown"data-bs-auto-close="outside" aria-expanded="false">
            Select Merge Tables
          </button>
          <ul class="dropdown-menu" aria-labelledby="selectTables">
            @foreach ($reservedTables as $table)
              @php
                $tableNo = $table->no;
                $isChecked = in_array($tableNo, request()->merge_tables ?? []) ? 'checked' : '';
              @endphp
              <li>
                <div class="dropdown-item">
                  <input class="form-check-input" name="merge_tables[]" type="checkbox"
                    value="{{ $tableNo }}" id="{{ $tableNo }}" {{ $isChecked }}>
                  <label class="form-check-label" for="{{ $tableNo }}">
                    {{ $tableNo }}
                  </label>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <x-slot:action>
      <button type="submit" class="btn btn-primary" id="mergeBtn">Merge</button>
      </x-slot>
  </form>

</x-modal>
