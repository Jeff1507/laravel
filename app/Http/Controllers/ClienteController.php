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
    public function index()
    {
        $clientes = Cliente::with('endereco')->get();
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
        try {
            $request->validate([
                'nome' => 'required|max:255',
                'cpf' => 'required|size:11|unique:clientes,cpf',
                'email' => 'required|email|max:255|unique:clientes,email',
                'telefone' => 'required|max:11',
                'cep' => 'required|size:8',
                'rua' => 'required|max:255',
                'bairro' => 'required|max:255',
                'cidade' => 'required|max:255',
                'estado' => 'required|max:255',
                'numero' => 'required|max:10',
                'complemento' => 'nullable|max:255',
            ]);
    
            // Criar cliente
            $cliente = Cliente::create($request->only('nome', 'cpf', 'email', 'telefone'));
    
            // Criar endereço
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
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao cadastrar cliente.',
                'mensagem' => $e->getMessage(),
            ], 500);
        }
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
