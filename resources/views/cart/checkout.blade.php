@extends('layouts.app-master')

@section('content')
@if(session("success"))
<div class="alert alert-success">{{session('success')}}</div>
@endif
@php $total = 0; @endphp
    <div class="container bg-white">
        <form action="{{ route('placeOrder') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-7 p-2">
                    <div class="card">
                        <div class="card-body">
                            <h6>User Details</h6>
                            <hr>
                            <div class="row checkout-from">
                                <div class="col-md-6 mb-2">
                                    <label for="">first Name</label>
                                    <input type="text" class="form-control" placeholder="Enter first Name" name="first_name" value="{{ $user->first_name }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" value="{{ $user->last_name }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{ $user->email }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number" value="{{ $user->phone_number }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Address 1</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 1" name="address_1" value="{{ $user->address_1 }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Address 2</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 2"  name="address_2" value="{{ $user->address_2 }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" placeholder="Enter City"  name="city" value="{{ $user->city }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" placeholder="Enter State"  name="state" value="{{ $user->state }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" placeholder="Enter Country" name="country" value="{{ $user->country }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Pin Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Pin Code" name="pin_code" value="{{ $user->pin_code }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 p-2">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            <table class="table table-bordered my-2">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->pizzas->name }}</td>
                                            <td>{{ $item->pizzas->price }}</td>
                                            <td>{{ $item->pizza_qty }}</td>
                                            <td>{{ $item->pizzas->price * $item->pizza_qty }}</td>
                                        </tr>
                                        @php $total += $item->pizzas->price * $item->pizza_qty ; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <input type="hidden" name="total_price" value="{{ $total }}">
                            <font>Total Price : {{ $total }}</font>
                            <button type="submit" class="btn btn-primary float-end">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
