<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;

//test
use App\http\Controllers\PizzasController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('pizzas/test', [PizzasController::class, 'test']);

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

Route::resource('/pizzas', PizzaController::class); // MAGIC
// php artisan route:list

// Ingredient endpiont
Route::resource('/ingredients', IngredientController::class);

Route::get('/search', [PizzaController::class, 'search']);
Route::get('/search', [IngredientController::class, 'search']);
// Route::get('/search', [SearchController::class, 'index']);
