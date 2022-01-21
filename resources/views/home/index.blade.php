@extends('layouts.app-master')

@section('content')
    <div class="mt-5">

<!-- Button trigger modal -->

        @auth
            <div class="offcanvas offcanvas-start bg-warning bg-gradient w-auto p-3" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                <img class="mb-1" src="{!! url('images/icons/icon-pizza-menu.png') !!}"alt="" width="100" height="100">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <h3 class="pizza-font fs-2">TheBakaPizza!!</h3>
                <div class="offcanvas-body pizza-font">
                    <div class="my-2"><a href="{{route('home.index')}}" class="text-dark fs-4 ">Menu</a></div>
                    <a href="{{ route('logout.perform') }}" class="text-dark fs-4">Logout</a>
                </div>
            </div>

            @include('home.partials.image-slides')

            <nav class="navbar navbar-light bg-light mb-4 rounded-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 pizza-font fs-3 mx-2">Menu</span>
                </div>
            </nav>

            @foreach($pizzas->chunk(3) as $items)
                <div class="container">
                    <div class="row mb-5">
                      @foreach($items as $pizza)
                        <div class="col-4 d-flex justify-content-center">
                            <div class="d-lg-flex">
                                <div class="card border-0 me-lg-4 mb-lg-0 mb-4 text-center" data-bs-toggle="modal" data-bs-target="#pizza-modal-{{ $pizza->id }}">
                                    <div class="backgroundEffect"></div>
                                    <div class="pic">
                                        <img src="{{ asset($pizza->image) }}" class="card-img-top" alt="..." height="250px">
                                    </div>
                                    <div class="content">
                                        <h5 class="card-title">{{ $pizza->name }}</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <h5 class="card-title">Price : <font color="red">{{$pizza->price}}</font></h5>
                                        <a class="btn pizza-font">ADD</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="pizza-modal-{{ $pizza->id }}" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-scrollable">
                                <div class="modal-content">
                                    <img src="{{ asset($pizza->image) }}" class="" alt="..." height="250px">
                                    <div class="modal-body">
                                        {{-- description --}}
                                        <h5 class="card-title">{{ $pizza->name }}</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                        {{-- Choose 3 pies --}}
                                        <div class="mb-2">
                                            <h5>Choose 3 pies</h5>
                                            <div>
                                            </div>
                                        </div>

                                        {{-- price total --}}
                                        <div class="mb-2">
                                            <h5 class="card-title">Price : {{$pizza->price}}</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <form action="{{ route('pizza.addToCart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="pizza_id" value={{ $pizza->id }}>
                                            <button type="submit" class="btn btn-danger pizza-font">ADD TO CART</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            @endforeach
        @endauth

        @guest
            <div class="offcanvas offcanvas-start bg-warning bg-gradient w-auto p-3" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                <img class="mb-1" src="{!! url('images/icons/icon-pizza-menu.png') !!}"alt="" width="100" height="100">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <h3 class="pizza-font fs-2">TheBakaPizza!!</h3>
                <div class="offcanvas-body pizza-font">
                    <div class="my-2"><a href="{{route('home.index')}}" class="text-dark fs-4 ">Menu</a></div>
                    <div class="my-2"><a href="{{ route('login.perform') }}" class="text-dark fs-4">Login</a></div>
                    <div class="my-2"><a href="{{ route('register.perform') }}" class="text-dark fs-4">Sign-up</a></div>
                </div>
            </div>

            @include('home.partials.image-slides')

            <nav class="navbar navbar-light bg-light mb-4 rounded-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 pizza-font fs-3 mx-2">Menu</span>
                </div>
            </nav>

            @foreach($pizzas->chunk(3) as $items)
                <div class="container">
                    <div class="row mb-5">
                      @foreach($items as $pizza)
                        <div class="col-4 d-flex justify-content-center">
                            <div class="d-lg-flex" data-bs-toggle="modal" data-bs-target="#pizza-modal-{{ $pizza->id }}">
                                <div class="card border-0 me-lg-4 mb-lg-0 mb-4 text-center">
                                    <div class="backgroundEffect"></div>
                                    <div class="pic"><img src="{{ asset($pizza->image) }}" class="card-img-top" alt="..." height="250px">
                                    </div>
                                    <div class="content">
                                        <h5 class="card-title">{{ $pizza->name }}</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <h5 class="card-title">Price : <font color="red">{{$pizza->price}}</font></h5>
                                        <a href="" class="btn pizza-font">ADD</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="pizza-modal-{{ $pizza->id }}" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-scrollable">
                                <div class="modal-content">
                                    <img src="{{ asset($pizza->image) }}" class="" alt="..." height="250px">
                                    <div class="modal-body">
                                        {{-- description --}}
                                        <h5 class="card-title">{{ $pizza->name }}</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                        {{-- Choose 3 pies --}}
                                        <div class="mb-2">
                                            <h5>Choose 3 pies</h5>
                                            <div>
                                            </div>
                                        </div>

                                        {{-- price total --}}
                                        <div class="mb-2">
                                            <h5 class="card-title">Price : {{$pizza->price}}</h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <form action="{{ route('pizza.addToCart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="pizza_id" value={{ $pizza->id }}>
                                            <button type="submit" class="btn btn-danger pizza-font">ADD TO CART</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            @endforeach
        @endguest
    </div>
@endsection
