<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
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
