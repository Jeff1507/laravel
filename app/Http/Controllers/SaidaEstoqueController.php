<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaidaEstoque;
use App\Models\Produto;
use App\Models\Cliente;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class SaidaEstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saidas = SaidaEstoque::with('cliente', 'produto')->get();
        return view('saidas_estoque.index', compact('saidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();

        return view('saidas_estoque.create', compact('clientes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        if ($request->quantidade > $produto->estoque) {
            return redirect()->back()->with('erro', 'A quantidade solicitada é maior que o estoque disponível!');
        }

        $valorTotal = $produto->valor_unitario * $request->quantidade;

        $saida = SaidaEstoque::create([
            'cliente_id' => $request->cliente_id,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'valor_total' => $valorTotal,
            'data_retirada' => now(),
        ]);

        $produto->decrement('estoque', $request->quantidade);

        $qrCodeData = "Cliente: {$saida->cliente->nome}\n"
                    . "Produto: {$saida->produto->nome}\n"
                    . "Quantidade: {$saida->quantidade}\n"
                    . "Valor Total: R$ {$saida->valor_total}\n"
                    . "Data: {$saida->data_retirada}";

        try {
            $qrCodeData = json_encode([
                'cliente' => $saida->cliente->nome,
                'produto' => $saida->produto->nome,
                'quantidade' => $saida->quantidade,
                'valor_total' => "R$ " . number_format($saida->valor_total, 2, ',', '.'),
                'data' => $saida->data_retirada->format('d/m/Y H:i'),
            ]);
        
            // 🔹 Configurando opções para melhor leitura
            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel' => QRCode::ECC_H, // Maior nível de correção de erro
                'scale' => 5, // Tamanho do QR Code
            ]);
        
            $qrCode = (new QRCode($options))->render($qrCodeData);
        
            return view('saidas_estoque.qrcode', compact('qrCode'))
                ->with('sucesso', 'Retirada registrada com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
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
