<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResourse;
use App\Models\Produto;
use App\Models\categoria;

class ProdutoController extends Controller
{
    public function index()
    {
        $col = Produto::with('categoria')->get();
        return  ProdutoResourse::collection($col);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $product = Produto::create($validated);
        return response()->json($product, 201);
         //$product = Produto::create($request->all());
    }

    public function show(Produto $produto)
    {
        return $produto->load('categoria');
    }

    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $produto->update($validated);
        return response()->json($produto);
    }

    public function destroy(Produto $produto){
        $produto->delete();
        return response()->json(null, 204);
    }
}
