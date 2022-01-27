@extends('layouts.app-master')

@section('content')
@if(session("success"))
<div class="alert alert-success">{{session('success')}}</div>
@endif
@php $total = 0; @endphp
    <div class="container bg-white">
        <div class="row">
            <div class="col my-3 text-center">
                <span class="fs-2">YOUR ORDER</span>
                <table class="table table-bordered my-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $item->pizzas->name }}</td>
                                <td>{{ $item->pizzas->price }}</td>
                                <td style="width: 175px">
                                    <div class="input-group">
                                        <form method="POST" action="{{ route('decrementQty') }}">
                                            @csrf

                                            <input type="hidden" name="pizza_id" value={{ $item->pizza_id }}>
                                            <button type="submit" class="input-group-text btn btn-secondary">-</button>
                                        </form>
                                        <input type="text" name="pizza_qty" class="form-control text-center" min="1" value="{{ $item->pizza_qty }}" disabled>
                                        <form method="POST" action="{{ route('incrementQty') }}">
                                            @csrf

                                            <input type="hidden" name="pizza_id" value={{ $item->pizza_id }}>
                                            <button type="submit" class="input-group-text btn btn-secondary">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $item->pizzas->price * $item->pizza_qty }}</td>
                                <td class="d-flex justify-content-center">
                                    <form method="POST" action="{{ route('deleteItem') }}">
                                        @csrf

                                        <input type="hidden" name="pizza_id" value={{ $item->pizza_id }}>
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @php $total += $item->pizzas->price * $item->pizza_qty ; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="my-2 d-flex justify-content-end">
                <h1 class="fs-5 mx-3 p-2">TOTAL PRICE: <font class="border border-danger border-5 ">{{ $total }}</font></h1>
                <a href="{{ route('checkout.index') }}" class="btn btn-success d-flex align-items-center">Proceed to Checkout</a>
            </div>
        </div>
    </div>
@endsection

