<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class HomeController extends Controller
{
    public function index()
    {
        // $user = Cashier::findBillable(Auth::user()->stripe_id);
        // $stripeCustomer = $user->asStripeCustomer();
        // $taxIds = $user->taxIds();

        // dd($taxIds);
        return view('home.index', [
            'pizzas' => Pizza::all(),
        ]);
    }

    public function adminHome()
    {
        return view('home.adminHome', [
            'pizzas' => Pizza::all(),
        ]);
    }
}
