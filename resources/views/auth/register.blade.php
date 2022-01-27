@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('register.perform') }}">
        @csrf

        <img class="mb-1" src="{!! url('images/icons/icon-pizza-register.png') !!}" alt="" width="100" height="100">

        <h1 class="h3 mb-3 fw-normal pizza-font">Register</h1>

        {{-- @include('layouts.partials.messages') --}}

        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" autofocus>
            <label for="floatingEmail">Email address</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" autofocus>
            <label for="floatingName">Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" >
            <label for="floatingConfirmPassword">Confirm Password</label>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>

        @include('auth.partials.copy')
    </form>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
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
@endsection
