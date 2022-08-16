@props(['title', 'size' => '', 'id' => 'confirmModal', 'scroll' => false])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="confirmModalLabel"
  aria-hidden="true" data-bs-backdrop="static">
  <div
    class="modal-dialog {{ $size }} modal-dialog-centered {{ $scroll ? 'modal-dialog-scrollable' : '' }}">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
        {{ $slot }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        {{ $action }}
      </div>
    </div>
  </div>
</div>
