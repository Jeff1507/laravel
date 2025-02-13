<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Unidade;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::with(['categoria', 'unidade'])->get();
        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $unidades = Unidade::all();

        return view('produtos.create', compact('categorias', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'unidade_id' => 'required|exists:unidades,id',
            'estoque' => 'required|integer|min:0',
            'descricao' => 'nullable|max:255',
            'valor_unitario' => 'required|numeric|min:0',
        ]);

        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('produtos', 'public');
        }

        Produto::create([
            'nome' => $request->nome,
            'imagem' => $imagemPath,
            'categoria_id' => $request->categoria_id,
            'unidade_id' => $request->unidade_id,
            'estoque' => $request->estoque,
            'descricao' => $request->descricao,
            'valor_unitario' => $request->valor_unitario,
        ]);

        return redirect()->route('produtos.index')->with('sucesso', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
