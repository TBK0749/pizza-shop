@extends('layouts.app-master-home')

@section('content')

@if(session("success"))
<div class="alert alert-success">{{session('success')}}</div>
@endif
@if(session("status"))
<div class="alert alert-success">{{session('status')}}</div>
@endif

    @auth
    @include('home.partials.image-slides')

    <nav class="navbar navbar-light bg-light mb-4 rounded-3">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1  fs-3 mx-2">Menu</span>
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
                                <a class="btn ">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="pizza-modal-{{ $pizza->id }}" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-scrollable">
                        <div class="modal-content">
                            <img src="{{ asset($pizza->image) }}" class="" alt="..." height="250px">
                            <form action="{{ route('addToCart') }}" method="POST">
                                @csrf
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
                                    <div class="form-group mb-2">
                                        <label for="price"><b>Price</b></label>
                                        <input type="number" name="pizza_qty" class="form-control" value="1" min="1">
                                    </div>
                                    <div class="mb-2">
                                        <h5 class="card-title">Price : {{$pizza->price}}</h5>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <input type="hidden" name="pizza_id" value={{ $pizza->id }}>
                                    <button type="submit" class="btn btn-danger addToCartBtn">ADD TO CART</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endforeach
    @endauth

    @guest
    @include('home.partials.image-slides')

    <nav class="navbar navbar-light bg-light mb-4 rounded-3">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1  fs-3 mx-2">Menu</span>
        </div>
    </nav>

    @foreach($pizzas->chunk(3) as $items)
        <div class="container">
            <div class="row mb-5 pizza_data">
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
                                <a href="" class="btn ">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="pizza-modal-{{ $pizza->id }}" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-scrollable">
                        <div class="modal-content">
                            <img src="{{ asset($pizza->image) }}" class="" alt="..." height="250px">
                        <form action="{{ route('addToCart') }}" method="POST">
                            @csrf
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

                                <div class="form-group mb-2">
                                    <label for="price"><b>Price</b></label>
                                    <input type="number" name="pizza_qty" class="form-control" value="1" min="1">
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title">Price : {{$pizza->price}}</h5>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <input type="hidden" name="pizza_id" value={{ $pizza->id }}>
                                <button type="submit" class="btn btn-danger ">ADD TO CART</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endforeach
    @endguest
@endsection
