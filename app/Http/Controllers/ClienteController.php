<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cliente::with('endereco');
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nome', 'LIKE', "%{$search}%");
        }

        $clientes = $query->get();

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $request->validate([
                'nome' => 'required|max:255',
                'cpf' => 'required|size:14|unique:clientes,cpf',
                'email' => 'required|email|max:255|unique:clientes,email',
                'telefone' => 'required|max:14',
                'cep' => 'required|size:9',
                'rua' => 'required|max:255',
                'bairro' => 'required|max:255',
                'cidade' => 'required|max:255',
                'estado' => 'required|max:255',
                'numero' => 'required|max:10',
                'complemento' => 'nullable|max:255',
            ]);
    
            $cliente = Cliente::create($request->only('nome', 'cpf', 'email', 'telefone'));
    
            Endereco::create([
                'cliente_id' => $cliente->id,
                'cep' => $request->cep,
                'rua' => $request->rua,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
            ]);
    
            return redirect()->route('clientes.index')->with('sucesso', 'Cliente cadastrado com sucesso!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::with('endereco')->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::with('endereco')->findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'cpf' => 'required|size:14|unique:clientes,cpf,' . $id,
            'email' => 'required|email|max:255|unique:clientes,email,' . $id,
            'telefone' => 'required|max:14',
            'cep' => 'required|size:9',
            'rua' => 'required|max:255',
            'bairro' => 'required|max:255',
            'cidade' => 'required|max:255',
            'estado' => 'required|max:255',
            'numero' => 'required|max:10',
            'complemento' => 'nullable|max:255',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->only('nome', 'cpf', 'email', 'telefone'));

        $cliente->endereco->update([
            'cep' => $request->cep,
            'rua' => $request->rua,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
        ]);

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente e endereço removidos com sucesso.');
    }
}
