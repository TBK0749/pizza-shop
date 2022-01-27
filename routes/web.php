<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Models\Cart;
use App\Models\Pizza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use League\Flysystem\RootViolationException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 1. User open website
// 2. Request comes to route
// 3. Route send request to controller method
// 4. Controller send response (json, html)

// Seperation of concern

// Pizza endpiont
// Route::get('/pizzas', [PizzasController::class, 'index'])->name('pizzas.index');
// Route::get('/pizzas/create', [PizzasController::class, 'create'])->name('pizzas.create');
// Route::get('/pizzas/{id}/edit', [PizzasController::class, 'edit'])->name('pizzas.edit');
// Route::get('/pizzas/{id}', [PizzasController::class, 'show'])->name('pizzas.show');
// Route::post('/pizzas', [PizzasController::class, 'store'])->name('pizzas.store');
// Route::put('/pizzas/{id}', [PizzasController::class, 'update'])->name('pizzas.update');
// Route::delete('/pizzas/{id}', [PizzasController::class, 'destroy'])->name('pizzas.destroy');

Route::resource('admin/pizzas', PizzaController::class); // MAGIC
// php artisan route:list

// Ingredient endpiont
Route::resource('admin/ingredients', IngredientController::class);

// Route::get('/search', [PizzaController::class, 'search']);
// Route::get('/search', [IngredientController::class, 'search']);
// Route::get('/search', [SearchController::class, 'index']);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('admin', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('register', [RegisterController::class, 'show'])->name('register.show');
        Route::post('register', [RegisterController::class, 'register'])->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('login', [LoginController::class, 'show'])->name('login.show');
        Route::post('login', [LoginController::class, 'login'])->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('logout', [LogoutController::class, 'perform'])->name('logout.perform');
    });
});

//Cart endpiont
Route::post('add_to_cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('cart_list', [CartController::class, 'cartList'])->name('cartList');
Route::post('delete_item', [CartController::class, 'deleteItem'])->name('deleteItem');
Route::post('increment_qty', [CartController::class, 'incrementQty'])->name('incrementQty');
Route::post('decrement_qty', [CartController::class, 'decrementQty'])->name('decrementQty');

//Checkout endpiont
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');


Route::get('/test', function () {
    // app()->bind('students', function () {
    // return [];
    // });

    // helper functions

    // ResponseFactory
    // dd(response());

    // Facade -> บ่งบอกชื่อของ key ที่ถูก binding ไว้ใน service container

    // Response Facade -> 'Illuminate\Contracts\Routing\ResponseFactory'
    // app('Illuminate\Contracts\Routing\ResponseFactory')->json([])

    // Illuminate\Auth\AuthServiceProvider

    // dd(app('session'));
    // $carts = Auth::user()->carts;
    // $cartsItem = Cart::where('user_id', Auth::id())->with(['pizza'])->get();
    // dd($cartsItem);

    // 1 ก้อนข้อมูล มันผูกกับข้อมูลก้อนอื่นๆไหนอยู่บ้าง

    // $carts = Cart::with(['pizza'])->get(['id', 'pizza_id']);

    // $carts -> Collection
    // $carts[0] -> Cart


    // $cartItems = Cart::where('user_id', Auth::id())->get();

    $cartItems = Auth::user()->carts;
    // dd($cartItems);

    // return Response::json([]);
    // return Response::json([]);
    // dd(app('students'));
    // return redirect()->route('login.show');
    // redirect() -> Redirector (route, to, home, etc.)
    // redirect()->route
    // OOP (Object oriented programming)
    // dd(redirect()->to('/login'));
    // dd(redirect()->route('login.show'));
    // return new RedirectResponse('', '', '', '');
    return view('test', compact('cartItems'));
});
