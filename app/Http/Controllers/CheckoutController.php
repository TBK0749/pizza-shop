<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->carts;
        $location = $user->locations;

        return view('cart.checkout', compact('cartItems', 'user', 'location'));
    }

    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pin_code' => $request->pin_code,
            'tracking_no' => 'ID' . rand(1111, 9999),
            'total_price' => $request->total_price,
        ]);

        $cartItems = Auth::user()->carts;
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'pizza_id' => $item->pizzas->id,
                'qty' => $item->pizza_qty,
                'price' => $item->pizzas->price,
            ]);
        }

        if (Auth::user()->address_1 == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pin_code' => $request->pin_code,
            ]);
        }

        Cart::destroy($cartItems);

        return redirect(route('home.index'))->with('status', "Order placed Successfully");
    }
}
