@extends('layout')

@section('content')
@if(session("success"))
<div class="alert alert-success">{{session('success')}}</div>
@endif

<div class="container bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-3">
                @if ($users->count() == 0)
                <div class="card-header d-flex justify-content-center">
                    <h1>Is Empty</h1>
                </div>
                @else
                <div class="card-header">
                    <h4>New Orders</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
