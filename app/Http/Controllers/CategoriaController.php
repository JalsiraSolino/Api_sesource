<?php

namespace App\Http\Controllers;


use App\Models\categoria;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriaResource;

class CategoriaController extends Controller
{
    public function index()
    {
        return new CategoriaResource(categoria::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = categoria::create($validated);
        return response()->json($category, 201);
    }

    public function show(categoria $category)
    {
        return $category;
    }

    public function update(Request $request, categoria $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validated);
        return response()->json($category);
    }

    public function destroy(categoria $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
