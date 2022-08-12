@extends('layout.master')

@section('main-content')
  <div class="row">
    <div class="col-3">
      @include('layout.sidebar')
    </div>

    <div class="col-9">
      @yield('content')
    </div>
  </div>
@endsection
