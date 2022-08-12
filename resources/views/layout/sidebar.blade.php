<div class="list-group">
  @foreach ($viewModel->tables() as $table)
    <button type="button"
      class="list-group-item list-group-item-action {{ getActiveRouteClass('tables.show', ['table' => $table->no]) }}"
      {{ $table->status->isFree() ? '' : 'disabled' }}>
      <a class="text-decoration-none"
        href="{{ route('tables.show', $table) }}">{{ $table->no }}</a>
    </button>
  @endforeach
</div>
