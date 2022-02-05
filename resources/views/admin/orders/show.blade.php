@extends('layout')

@section('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-3">
                <div class="card-header">
                    <h4>Order View</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">First Name</label>
                            <div class="border p-2">{{ $order->first_name }}</div>
                            <label for="">Last Name</label>
                            <div class="border p-2">{{ $order->last_name }}</div>
                            <label for="">Email</label>
                            <div class="border p-2">{{ $order->email }}</div>
                            <label for="">Contack No.</label>
                            <div class="border p-2">{{ $order->phone_number }}</div>
                            <label for="">Shipping Address</label>
                            <div class="border p-2">
                                {{ $order->address_1 }},
                                {{ $order->address_2 }},
                                {{ $order->city }},
                                {{ $order->state }},
                                {{ $order->country }},
                            </div>
                            <label for="">Zip Code</label>
                            <div class="border p-2">{{ $order->pin_code }}</div>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->pizzas->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->qty * $item->pizzas->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td><b>Grand Total :</b></td>
                                        <td>{{ $order->total_price }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="" class="mb-2"><b>Order Status</b></label>
                                    <select class="form-select" name="status">
                                        <option {{ $order->status == '0' ? 'selected' : '' }} value="0">Pending</option>
                                        <option {{ $order->status == '1' ? 'selected' : '' }} value="1">Completed</option>
                                    </select>
                                    <button type="sumbit" class="btn btn-primary float-end mt-3">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
