@extends('layouts.app-master')

@section('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-3">
                <div class="card-header">
                    <h4>My Orders</h4>
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
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->total_price }}</td>
                                <td>{{ $item->status == "0" ? 'pending' : 'completed' }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $item->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
