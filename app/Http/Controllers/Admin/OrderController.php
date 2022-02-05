<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '0')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->first();

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update(['status' => $request->status]);

        return redirect(route('admin.orders.index'))->with('success', "Order Updated Successfully");
    }

    public function history()
    {
        $orders = Order::where('status', '1')->get();
        return view('admin.orders.history', compact('orders'));
    }
}
