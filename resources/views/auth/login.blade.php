@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">
        @csrf

        <img class="mb-1" src="{!! url('images/icons/icon-pizza-login.jpg') !!}"alt="" width="100" height="100">

        <h1 class="h3 mb-3 fw-normal pizza-font">Login</h1>

        {{-- @include('layouts.partials.messages') --}}

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" autofocus>
            <label for="floatingName">Email or Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" >
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        @if(session("errors"))
        <span class="text-danger">{{session('errors')}}</span>
        @endif

        <button class="w-100 btn btn-lg btn-primary" id="liveToastBtn" type="submit">Login</button>

        @include('auth.partials.copy')
    </form>
@endsection
