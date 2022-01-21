<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Cart;
use App\Models\Pizza;
use App\Models\Ingredient;
use App\Models\IngredientPizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // /pizzas
    {
        //web endpiont
        return view('pizzas.index', [
            'pizzas' => Pizza::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pizzas.create', [
            'ingredients' => Ingredient::all(),
            'pizzas' => Pizza::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePizzaRequest $request)
    {
        // TODO: เปลี่ยนเป็น Request Class
        // https://laravel.com/docs/8.x/validation#form-request-validation
        // php artisan make:request StorePizzaRequest
        $data = $request->validated();

        //การเข้ารหัสรูปภาพ
        // TODO: พยายามใช้ case เดียวกันสำหรับตัวแปร
        /** UploadedFile */
        $image = $request->file('image');

        //Generate ชื่อภาพ
        // $nameGen = hexdec(uniqid());
        $nameGen = Str::random(10);

        //ดึงนาสสกุลไฟล์ภาพ
        $imgExt = strtolower($image->getClientOriginalExtension());

        //รวมชื่อใหม่และนามสกุล
        $imgName = $nameGen . '.' . $imgExt;

        //อัพโหลดและบันทึกข้อมูล
        $uploadLocation = 'image/pizzas/';
        $fullPath = $uploadLocation . $imgName;
        $image->move($uploadLocation, $imgName);

        $ingredientIds = $data['ingredients'];

        // $pizza = new Pizza;
        // $pizza->name = $data['name'];
        // $pizza->price = $data['price'];
        // TODO: ชื่อ column ไม่ต้องใส่ชื่อ model ซ้ำ
        // $pizza->image = $fullPath;
        // $pizza->save();

        $pizza = Pizza::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $fullPath,
        ]);

        $pizza->ingredients()->sync($ingredientIds);

        return redirect()->back()->with('success', "Successfully created a pizza.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza) // MAGIC {pizza} id
    {
        // 1. See {pizza} in route
        // 2. See $pizza in controller and see that it's Pizza model
        // 3. Get route key from Pizza model (default is 'id')
        // 4. Get the model object using the route key and store it in $pizza
        // dd($pizza);
        // /pizzas/5

        // Homework
        // 1. Create /pizzas page that show all pizzas (read @foreach directive in Laravel Blade)
        // 2. Create /pizzas/create page that show the form to create pizza
        // 3. Create /pizzas/{id} page that show the pizza details

        // var_dump($pizza->ingredients);

        return view('pizzas.show', [
            'pizza' => $pizza,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function edit(Pizza $pizza)
    {
        return view('pizzas.edit', [
            'pizza' => $pizza,
            'pizzas' => Pizza::all(),
            'ingredients' => Ingredient::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePizzaRequest $request, Pizza $pizza)
    {
        // TODO: Move to Request Class
        $data = $request->validated();

        $image = $request->file('image');
        $nameGen = hexdec(uniqid());
        $imgExt = strtolower($image->getClientOriginalExtension());
        $imgName = $nameGen . '.' . $imgExt;
        $uploadLocation = 'image/pizzas/';
        $fullPath = $uploadLocation . $imgName;

        $pizza->deleteImage();
        $image->move($uploadLocation, $imgName);

        $ingredientId = $data['ingredients'];

        $data['image'] = $fullPath;
        $pizza->update($data);
        $pizza->ingredients()->sync($ingredientId);

        return redirect()->back()->with('success', "Successfully edited a pizza.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        $pizza->deleteImage();
        $pizza->delete();

        return redirect()->route('pizzas.index')->with('success', 'Successfully deleted a pizza.');
    }

    public function addToCart(Request $req)
    {
        if (Auth::user()) {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->pizza_id = $req->pizza_id;
            $cart->save();

            return redirect(route('home.index'));
        } else {
            return redirect(route('login.show'));
        }
    }
}
