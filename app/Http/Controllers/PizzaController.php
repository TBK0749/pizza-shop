<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingredient;
use App\Models\IngredientPizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:pizzas|max:255',
                'ingredients' => 'required',
                'pizza_image' => 'required|mimes:png,jpg,jpeg'
            ],
            [
                'name.required' => "Please enter a new pizza name.",
                'name.unique' => "You are entering the same pizza name as the existing one.",
                'name.max' => "You are entering a pizza name exceeding 225 characters.",
                'ingredients.required' => "Please select ingredients.",
                'pizza_image.required' => "Please add an illustration."
            ]
        );

        //การเข้ารหัสรูปภาพ
        $pizza_image = $request->file('pizza_image');

        //Generate ชื่อภาพ
        $name_gen = hexdec(uniqid());

        //ดึงนาสสกุลไฟล์ภาพ
        $img_ext = strtolower($pizza_image->getClientOriginalExtension());

        //รวมชื่อใหม่และนามสกุล
        $img_name = $name_gen . '.' . $img_ext;

        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/pizzas/';
        $full_path = $upload_location . $img_name;
        $pizza_image->move($upload_location, $img_name);

        $ingredientsId = array_keys($data['ingredients']);

        $pizza = new Pizza;
        $pizza->name = $data['name'];
        $pizza->pizza_image = $full_path;
        $pizza->save();

        $pizza->ingredients()->sync($ingredientsId);

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
            'pizzas' => Pizza::find($pizza->id),
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
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:pizzas|max:255',
                'ingredients' => 'required',
                'pizza_image' => 'required|mimes:png,jpg,jpeg'
            ],
            [
                'name.required' => "Please enter a new pizza name.",
                'name.unique' => "You are entering the same pizza name as the existing one.",
                'name.max' => "You are entering a pizza name exceeding 225 characters.",
                'ingredients.required' => "Please select ingredients.",
                'pizza_image.required' => "Please add an illustration."
            ]
        );

        $pizza_image = $request->file('pizza_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($pizza_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $upload_location = 'image/pizzas/';
        $full_path = $upload_location . $img_name;
        $pizza_image->move($upload_location, $img_name);

        $ingredientId = array_keys($data['ingredients']);

        $pizza = Pizza::find($id);
        $data['pizza_image'] = $full_path;
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
        $pizza->delete();
        return redirect()->route('pizzas.index')->with('success', 'Successfully deleted a pizza.');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $pizzas = DB::table('pizzas')
            ->where('name', 'like', '%' . $search . '%')
            ->paginate(5);
        return view('pizzas.index', ['pizzas' => $pizzas]);
    }
}
