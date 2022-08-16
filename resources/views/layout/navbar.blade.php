<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
  <div class="container">
    <a class="navbar-brand" href="/">
      <x-img src="{{ asset('images/home.svg') }}" width="30" height="24"
        class="align-text-top d-inline-block logo-white" />
      TeaShop
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="mb-2 navbar-nav mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('products.index') }}">Products</a>
        </li>
        @auth
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('logout') }}"
              onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
