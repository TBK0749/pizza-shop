@extends('layout')

@section('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-6">
            <div class="card my-3">
                <div class="card-header">
                    <h4>User</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">First Name</label>
                            <div class="border p-2">{{ $user->first_name == null ? '-' : $user->first_name}}</div>
                            <label for="">Last Name</label>
                            <div class="border p-2">{{ $user->last_name == null ? '-' : $user->last_name }}</div>
                            <label for="">Email</label>
                            <div class="border p-2">{{ $user->email}}</div>
                            <label for="">Contack No.</label>
                            <div class="border p-2">{{ $user->phone_number == null ? '-' : $user->phone_number }}</div>
                            <label for="">Shipping Address</label>
                            <div class="border p-2">
                                {{ $user->address_1 == null ? 'address1: - , ' : $user->address_1 . ', ' }}
                                {{ $user->address_2 == null ? 'address2: - , ' : $user->address_2 . ', ' }}
                                {{ $user->city == null ? 'city: - , ' : $user->city . ', ' }}
                                {{ $user->state == null ? 'state: - ,' : $user->state . ', ' }}
                                {{ $user->country == null ? 'contry: -' : $user->country}}
                            </div>
                            <label for="">Zip Code</label>
                            <div class="border p-2">{{ $user->pin_code == null ? '-' : $user->pin_code }}</div>
                        </div>
                    </div>
                    <a href="{{ route('users.index') }}" class="btn btn-primary float-end mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
