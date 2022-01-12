<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ingredients.index', [
            'ingredients' => Ingredient::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create', [
            'ingredients' => Ingredient::all(),
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
                'name' => 'required|unique:ingredients|max:225',
                'price' => 'required',
            ],
            [
                'name.required' => "Please enter a new ingredient name.",
                'name.unique' => "You are entering the same ingredient name as the existing one.",
                'name.max' => "You are entering a ingredient name exceeding 225 characters.",
                'price.required' => "Put price."
            ]
        );

        Ingredient::create($data);

        return redirect()->back()->with('success', "Successfully created a ingredient.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', [
            'ingredients' => ingredient::find($ingredient->id),
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', [
            'ingredient' => $ingredient,
            'ingredients' => Ingredient::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:ingredients|max:225',
                'price' => 'required',
            ],
            [
                'name.required' => "Please enter a new ingredient name.",
                'name.unique' => "You are entering the same ingredient name as the existing one.",
                'name.max' => "You are entering a ingredient name exceeding 225 characters.",
                'price.required' => "Put price."
            ]
        );

        $ingredient = ingredient::find($id);
        $ingredient->update($data);

        return redirect()->back()->with('success', "Successfully edited a ingredient.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect('/ingredients');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $ingredients = DB::table('ingredients')
            ->where('name', 'like', '%' . $search . '%')
            ->paginate(5);
        return view('ingredients.index', ['ingredients' => $ingredients]);
    }
}
