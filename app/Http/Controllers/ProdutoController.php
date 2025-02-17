<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Unidade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            'imagem' => 'required|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'unidade_id' => 'required|exists:unidades,id',
            'estoque' => 'required|integer|min:0',
            'descricao' => 'nullable|max:255',
            'valor_unitario' => 'required|numeric|min:0',
        ]);

        $dados = $request->all();

        if($request->hasFile('imagem')&& $request->file('imagem')->isValid()){
            $requestImagem = $request->file('imagem');
            $extensao = $requestImagem->extension();
            $nomeImagem = md5($requestImagem->getClientOriginalName().strtotime("now")).'.'.$extensao;
            $request->imagem->move(public_path('img/produtos'),$nomeImagem);
            $dados['imagem'] = $nomeImagem;
        }
        else{
            $dados['imagem'] = "nulo.jpg";
        }

        Produto::create($dados);

        return redirect()->route('produtos.index')->with('sucesso', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produto = Produto::with(['categoria', 'unidade'])->findOrFail($id);
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produto = Produto::with(['categoria', 'unidade'])->findOrFail($id);
        $categorias = Categoria::all();
        $unidades = Unidade::all();

        return view('produtos.edit', compact('produto', 'categorias', 'unidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'unidade_id' => 'required|exists:unidades,id',
            'estoque' => 'required|integer|min:0',
            'descricao' => 'nullable|max:255',
            'valor_unitario' => 'required|numeric|min:0',
        ]);

        $produto = Produto::findOrFail($id);
        $dados = $request->except('imagem');

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if ($produto->imagem && file_exists(public_path('img/produtos/' . $produto->imagem))) {
                unlink(public_path('img/produtos/' . $produto->imagem));
            }

            $requestImagem = $request->file('imagem');
            $nomeImagem = md5($requestImagem->getClientOriginalName() . strtotime("now")) . '.' . $requestImagem->extension();

            $requestImagem->move(public_path('img/produtos'), $nomeImagem);

            $dados['imagem'] = $nomeImagem;
        }

        $produto->update($dados);

        return redirect()->route('produtos.index')->with('sucesso', 'Produto atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);
        if ($produto->imagem && $produto->imagem != 'nulo.jpg') {
            // Defina o caminho completo da imagem
            $caminhoImagem = public_path('img/produtos/' . $produto->imagem);

            // Verifique se o arquivo existe e exclua
            if (file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }
        }
        $produto->delete();

        return redirect()->route('produtos.index')->with('sucesso', 'Produto removido com sucesso.');
    }
}
