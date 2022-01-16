@extends('layouts.app-master')

@section('content')
    <div class="mt-5">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">You are normal user.</p>
        @endauth

        @guest
            <div class="row mb-4">
                <img src="images/home/ภาพแสดงก่อนเมนูหน้าhome.jpg" alt="..." height="350px">
            </div>
            <nav class="navbar navbar-light bg-light mb-4 rounded-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 pizza-font fs-3 mx-2">Menu</span>
                </div>
            </nav>
            @foreach($pizzas->chunk(3) as $items)
                <div class="row mb-5 d-flex justify-content-around">
                  @foreach($items as $pizza)
                    <div class="col mx-5">
                        <div class="card" style="width: 15rem;">
                            <img src="{{ asset($pizza->image) }}" class="card-img-top" alt="..." height="200px">
                            <div class="card-body">
                            <h5 class="card-title">{{ $pizza->name }}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
            @endforeach
        @endguest
    </div>
@endsection
