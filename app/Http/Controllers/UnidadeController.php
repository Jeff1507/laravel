<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidade::all();
        return view("unidades.index", compact("unidades"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("unidades.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sigla'=>'required|max:4',
            'descricao'=> 'nullable|max:255',
        ]);

        Unidade::create($request->all());

        return redirect()->route('unidades.index')->with('sucesso','Unidade cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unidade = Unidade::findOrFail($id);
        return view('unidades.show', compact('unidade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unidade = Unidade::findOrFail( $id );
        return view('unidades.edit', compact('unidade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sigla'=>'required|max:4',
            'descricao'=> 'nullable|max:255',
        ]);

        Unidade::findOrFail( $id )->update($request->all());

        return redirect()->route('unidades.index')->with('sucesso','Unidade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unidade = Unidade::findOrFail( $id );
        $unidade->delete();

        return redirect()->route('unidades.index')->with('sucesso','Unidade removida com sucesso!');

    }
}
