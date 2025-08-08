<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Prikaz svih kategorija u JSON formatu
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Prikaz jedne kategorije u JSON formatu
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
    // Kreiranje nove kategorije
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }
    // Ažuriranje postojeće kategorije
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());
        return response()->json($category);
    }
    // Brisanje kategorije
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);
    }
}

   
