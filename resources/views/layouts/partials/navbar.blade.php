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

            {{-- Menu guset--}}
            <div class="offcanvas offcanvas-start bg-warning bg-gradient w-auto p-3" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                <img class="mb-1" src="{!! url('images/icons/icon-pizza-menu.png') !!}"alt="" width="100" height="100">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <h3 class=" fs-2">TheBakaPizza!!</h3>
                <div class="offcanvas-body ">
                    <div class="my-2"><a href="{{route('home.index')}}" class="text-dark fs-4 ">Menu</a></div>
                    <div class="my-2"><a href="{{ route('login.perform') }}" class="text-dark fs-4">Login</a></div>
                    <div class="my-2"><a href="{{ route('register.perform') }}" class="text-dark fs-4">Sign-up</a></div>
                </div>
            </div>
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

            {{-- Menu auth--}}
            <div class="offcanvas offcanvas-start bg-warning bg-gradient w-auto p-3" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                <img class="mb-1" src="{!! url('images/icons/icon-pizza-menu.png') !!}"alt="" width="100" height="100">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <h3 class=" fs-2">TheBakaPizza!!</h3>
                <div class="offcanvas-body ">
                    <div class="my-2"><a href="{{route('home.index')}}" class="text-dark fs-4 ">Menu</a></div>
                    <a href="{{ route('logout.perform') }}" class="text-dark fs-4">Logout</a>
                </div>
            </div>
          @endauth
        </ul>

        @auth
          <div class="text-white ">Welcome {{auth()->user()->username}}</div>
          <a href="{{ route('cartList') }}"><i class="fas fa-pizza-slice text-warning fs-4 mx-3 btn btn-outline-light text-primary">
              <font class="ms-1" color=#DB1C0B>{{ $total }}</font></i>
          </a>
          <i class="fas fa-angle-down btn btn-outline-light me-2" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('orders.index') }}">Orders</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout.perform') }}">Logout</a></li>
          </ul>
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

