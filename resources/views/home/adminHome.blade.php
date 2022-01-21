@extends('layouts.app-master')

@section('content')
    <div class="mt-5">

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
                <div class="row mb-5 ">
                    @foreach($items as $pizza)
                        <div class="col-4 d-flex justify-content-center">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset($pizza->image) }}" class="card-img-top" alt="..." height="250px">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pizza->name }}</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <h5 class="card-title">Price : <font color="red">{{$pizza->price}}</font></h5>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endauth

    </div>

@endsection
