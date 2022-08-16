<x-modal title="Order Confirm" size="modal-lg" scroll="true">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Total Price</th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
  </table>

  <x-slot:action>
    <button type="button" class="btn btn-primary" id="confirmBtn">Confirm</button>
    </x-slot>
</x-modal>
