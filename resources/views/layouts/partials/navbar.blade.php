@php
    use App\Http\Controllers\CartController;
    $total = CartController::cartItem();
@endphp


<header class="p-3 bg-secondary sticky-top mb-5">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ">
          @guest
            <button class="btn btn-outline-light mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-list" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></i></button>
            <li class="fs-4 ms-1">|</li>
            <li><a href="{{route('home.index')}}" class="nav-link px-2 text-white">Pizza Shop</a></li>
            <li class="fs-4">|</li>
          @endguest

          @auth
            @if (auth()->user()->is_admin == 1)
                <button class="btn btn-outline-light mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-list" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></i></button>
                <li class="fs-4 ms-1">|</li>
                <li><a class="nav-link px-2 text-white" href="{{route('admin.home')}}">Pizza Shop</a></li>
                <li class="fs-4">|</li>
                <li><a class="nav-link text-warning" href="{{route('pizzas.index')}}">Admin</a></li>
                <li class="fs-4">|</li>
            @else
                <button class="btn btn-outline-light mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-list" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></i></button>
                <li class="fs-4 ms-1">|</li>
                <li><a href="{{route('home.index')}}" class="nav-link px-2 text-white ">Pizza Shop</a></li>
                <li class="fs-4">|</li>
            @endif
          @endauth
        </ul>

        @auth
          <div class="text-white ">Welcome {{auth()->user()->username}}</div>
          <a href="{{ route('cartList') }}"><i class="fas fa-pizza-slice text-warning fs-4 mx-3 btn btn-outline-light text-primary"><font class="ms-1" color=#DB1C0B>{{ $total }}</font></i></a>

          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2"><i class="fas fa-sign-out-alt"></i></a>
        @endauth

        @guest
          <div class="text-end">
            <a class="btn btn-outline-light me-2" href="{{ route('login.perform') }}" >Login</a>
            <a class="btn btn-warning" href="{{ route('register.perform') }}">Sign-up</a>
          </div>
        @endguest
      </div>
    </div>

</header>
