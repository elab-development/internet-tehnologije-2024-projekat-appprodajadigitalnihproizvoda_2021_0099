<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Vrati sve recepte
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes);
    }

    // Vrati jedan recept
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return response()->json($recipe);
    }

    // Kreiraj novi recept
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Dodaj ostala polja po potrebi
        ]);

        $recipe = Recipe::create($validated);
        return response()->json($recipe, 201);
    }

    // Ažuriraj recept
    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            // Dodaj ostala polja po potrebi
        ]);

        $recipe->update($validated);
        return response()->json($recipe);
    }

    // Obriši recept
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return response()->json(['message' => 'Recipe deleted']);
    }
}