<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AutoAddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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

/**
 * Home Routes
 */
Route::get('/', [HomeController::class, 'index'])->name('home.index');

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

    //Cart endpiont
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('cart-list', [CartController::class, 'cartList'])->name('cartList');
    Route::post('delete-item', [CartController::class, 'deleteItem'])->name('deleteItem');
    Route::post('increment-qty', [CartController::class, 'incrementQty'])->name('incrementQty');
    Route::post('decrement-qty', [CartController::class, 'decrementQty'])->name('decrementQty');

    //Checkout endpiont
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('place-order', [CheckoutController::class, 'placeOrder'])->name('placeOrder');

    //Order endpiont
    Route::resource('orders', OrderController::class);
});

// Admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('admin', [HomeController::class, 'adminHome'])->name('admin.home');
    // Route::get('users', [UserController::class, 'users']);
    Route::get('admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('admin/orders/update/{id}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
    Route::get('admin/orders-history', [AdminOrderController::class, 'history'])->name('admin.orders.history');
    Route::resource('admin/users', DashboardController::class);

    Route::resource('admin/pizzas', PizzaController::class); // MAGIC
    // php artisan route:list

    // Ingredient endpiont
    Route::resource('admin/ingredients', IngredientController::class);
});

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

// Route::get('/search', [PizzaController::class, 'search']);
// Route::get('/search', [IngredientController::class, 'search']);
// Route::get('/search', [SearchController::class, 'index']);

// 2 routes
// /abc/test1
// /abc/test2

// Route::get('/ooo/test1', function () {
//     dd('test1');
// });
// Route::get('/ooo/test2', function () {
//     dd('test2');
// });

// prefix: คำนำหน้า
// suffix: คำตามหลัง

// Route::group(['prefix' => '/admin'], function () {
//     Route::get('/test1', function () {
//         dd("I'm in test1");
//     });
//     Route::get('/test2', function () {
//         dd("I'm in test2");
//     });
// });


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

Route::get('/map', function () {
    return view('googlemaps.map2');
});
