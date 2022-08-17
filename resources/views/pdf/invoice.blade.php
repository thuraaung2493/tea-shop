<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
  <style>
    .table {
      border-collapse: collapse;
      border: 1px solid #000;
    }

    tr,
    td,
    th {
      border: 1px solid #000;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="p-3 my-5 rounded card bg-body">
          <header>
            <h3 class="mb-3 text-center">Tea Shop</h3>
            <p class="text-center text-muted">
              Invoice Number : {{ $data->invoiceNo() }}<br />
              Table Numbers : {{ $data->tableNos() }}<br />
              Date : {{ $data->orderedDate() }}
            </p>
          </header>
          <section class="row justify-content-center">
            <div class="col-10">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Name.</th>
                    <th scope="col" class="text-center">Qty.</th>
                    <th scope="col" class="text-end">Price.</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data->items() as $index => $item)
                    <tr>
                      <th scope="row" class="text-center">{{ $index + 1 }}</th>
                      <td>{{ $item->product->name }}</td>
                      <td class="text-center">{{ $item->totalQuantity }}</td>
                      <td class="text-end">{{ $item->totalPrice->formatted() }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="text-center">
                    <th scope="row" colspan="2">Total</th>
                    <th scope="row">{{ $data->totalQuantity() }}</th>
                    <th scope="row" class="text-end">{{ $data->totalAmount()->formatted() }}</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
