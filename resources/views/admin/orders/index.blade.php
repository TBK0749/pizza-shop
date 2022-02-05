@extends('layout')

@section('content')
@if(session("success"))
<div class="alert alert-success">{{session('success')}}</div>
@endif

<div class="container bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-3">
                @if ($orders->count() == 0)
                <div class="card-header d-flex justify-content-center">
                    <h1>Orders Is Empty</h1>
                </div>
                @else
                <div class="card-header">
                    <h4>New Orders</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Order Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->tracking_no }}</td>
                                <td>{{ date('d-m-y h:m:s', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->total_price }}</td>
                                <td>{{ $item->status == "0" ? 'pending' : 'completed' }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $item->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        <a href="{{ route('admin.orders.history') }}" class="btn btn-primary">Order History</a>
    </div>
</div>
@endsection
