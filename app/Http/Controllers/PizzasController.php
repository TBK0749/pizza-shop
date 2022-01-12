<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class Animal
{
    protected function myName()
    {
        $this->name();
    }

    private function name()
    {
        dump("Animal name");
    }
}

class Dog extends Animal
{
    public $name;

    public function run()
    {

      dump("I'm running!");
    }

    // public -> ใครเรียกใช้ก็ได้
    // protected -> ลูกเรียกใช้ได้ แต่คนอื่นใช้ไม่ได้
    // private -> ใช้ได้แต่ตัวเอง

    
    // static function

    public static function drink()
    {
        dump("I'm drinking");
    }
}

// php artisan make:controller PizzaController --resource --model=Pizza

class PizzasController extends Controller
{
    public function test(Request $request) 
    {
        // dd($request->all());
        // ?name=Hawaiian
        // https://laravel.com/docs/8.x/eloquent
        // PHP class
        // TS class

        // $dog = new Dog();
        // $dog->name = "ABC DEF";
        // dd($dog->name);


        // Dog::drink();
        // Dog::run();


        // https://laravel.com/docs/8.x/collections

        // pizzas is a Collection
        // $pizzas = Pizza::all();

        // dump($pizzas->toArray());

        // Create
        // 1. Use static ::create method
        // 2. Create new object and use ->save()

        // 1.
        // ?name=Hawaiian
        // &is_admin=1
        // Mass Assignment
        // Pizza::create($request->all());

        // 2. MAGIC
        // $pizza = new Pizza();
        // $pizza->name = $request->input('name');
        // $pizza->save();

        // Update
        // 1. Get pizza into an object
        // $pizza = Pizza::find(1);
        // $pizza->name = "XXO";
        // $pizza->save();

        // 2.
        // Pizza::find(1)->update([
        //     'name' => 'UUOOO',
        //     'age' => 50,
        // ]);

        // https://laravel.com/docs/8.x/eloquent -> ใช้ผ่าน Model
        // https://laravel.com/docs/8.x/queries -> ใช้ผ่าน DB class

        // Pizza::whereName('Hawaiian')->first()->update([
        //     'name' => 'UUOOO',
        // ]);

        // \DB::table('pizzas')->find(1)->update([
        //     'name' => 'UUOOO',
        // ]);

        // 1. Delete via Model
        // 2. Delete an object
        // Pizza::whereName('Hawaiian')->delete(); 
        // Delete all pizza with name 'hawaiian'

        // Pizza::find(1)->delete();

        return view('pizzas/test');
    }

    // public function show(Request $request, int $id) // MAGIC
    // {
    //     // /pizzas/1
    //     dd($id);      
    // }

    // Render create pizza page
    // public function create()
    // {
    //     return view('pizzas.create');
    // }
}
