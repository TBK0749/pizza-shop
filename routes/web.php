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
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\Pizza;
use Illuminate\Support\Facades\Artisan;
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

    //Location
    Route::resource('locations', LocationController::class);
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

Route::get('test', function () {
    return view('test.test-checkout');
});

Route::get('/clear-cache-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('routh:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');

    dd("Cache Clear All");
});
