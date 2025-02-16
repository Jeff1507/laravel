<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SaidaEstoque;
use App\Models\Produto;


class RelatorioController extends Controller
{
    public function index() {
        return view('relatorios.index');
    }
    public function gerarPDF($tipo)
    {
        switch ($tipo) {
            case 'periodo':
                $dados = $this->relatorioPorPeriodo();
                $titulo = "Relatório de Retiradas Mensal";
                break;

            case 'cliente':
                $dados = $this->relatorioPorCliente();
                $titulo = "Relatório de Retiradas por Cliente";
                break;

            case 'sem-estoque':
                $dados = $this->relatorioSemEstoque();
                $titulo = "Relatório de Produtos Sem Estoque";
                break;

            case 'com-estoque':
                $dados = $this->relatorioComEstoque();
                $titulo = "Relatório de Produtos com Estoque";
                break;

            default:
                return abort(404);
        }

        $html = view('relatorios.template', compact('dados', 'titulo'))->render();

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();


        return $dompdf->stream("$tipo-relatorio.pdf", ["Attachment" => true]);
    }

    private function relatorioPorPeriodo()
    {
        return SaidaEstoque::join('produtos', 'saida_estoques.produto_id', '=', 'produtos.id')
        ->join('clientes', 'saida_estoques.cliente_id', '=', 'clientes.id')
        ->join('categorias','produtos.categoria_id','=','categorias.id')
        ->join('unidades','produtos.unidade_id','=','unidades.id')
        ->whereMonth('saida_estoques.data_retirada', now()->month)
        ->whereYear('saida_estoques.data_retirada', now()->year)
        ->select(
            'produtos.nome as Nome_do_Produto',
            'clientes.nome as Cliente',
            'categorias.nome as Categoria',
            'unidades.sigla as Unidade_de_Medida',
            \DB::raw('SUM(saida_estoques.quantidade) as Quantidade_Retirada'),
            \DB::raw('MAX(saida_estoques.data_retirada) as Data_da_Retirada'),
            \DB::raw('SUM(saida_estoques.valor_total) as Valor_Total')
        )
        ->groupBy('produtos.nome', 'clientes.nome', 'categorias.nome', 'unidades.sigla')
        ->get();
    }

    private function relatorioPorCliente()
    {
        return SaidaEstoque::join('produtos', 'saida_estoques.produto_id', '=', 'produtos.id')
        ->join('clientes', 'saida_estoques.cliente_id', '=', 'clientes.id')
        ->join('unidades', 'produtos.unidade_id', '=', 'unidades.id')
        ->join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
        ->whereMonth('saida_estoques.data_retirada', now()->month)
        ->whereYear('saida_estoques.data_retirada', now()->year)
        ->select(
            'clientes.nome as Cliente',
            'produtos.nome as Nome_do_Produto',
            'unidades.sigla as Unidade',
            'categorias.nome as Categoria',
            \DB::raw('SUM(saida_estoques.quantidade) as Quantidade_Retirada'),
            \DB::raw('MAX(saida_estoques.data_retirada) as Data_da_Retirada'),
            \DB::raw('SUM(saida_estoques.valor_total) as Valor_Total')
        )
        ->groupBy('clientes.nome', 'produtos.nome', 'unidades.sigla', 'categorias.nome')
        ->orderBy('clientes.nome')
        ->get();
    }

    private function relatorioSemEstoque()
    {
        return Produto::join('unidades', 'produtos.unidade_id', '=', 'unidades.id')
        ->join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
        ->join('saida_estoques', 'produtos.id', '=', 'saida_estoques.produto_id')
        ->where('produtos.estoque', '=', 0)
        ->select(
            'produtos.nome as Nome_do_Produto',
            'unidades.sigla as Unidade',
            'categorias.nome as Categoria',
            \DB::raw('MAX(saida_estoques.data_retirada) as Data_que_o_estoque_findou')
        )
        ->groupBy('produtos.nome', 'unidades.sigla', 'categorias.nome')
        ->orderBy('Data_que_o_estoque_findou', 'desc')
        ->get();
    }

    private function relatorioComEstoque()
    {
        return Produto::leftJoin('unidades', 'produtos.unidade_id', '=', 'unidades.id') 
        ->leftJoin('categorias', 'produtos.categoria_id', '=', 'categorias.id') 
        ->leftJoin('saida_estoques', 'produtos.id', '=', 'saida_estoques.produto_id')
        ->where('produtos.estoque', '>', 0) 
        ->select(
            'produtos.nome as Nome_do_Produto',
            'unidades.sigla as Unidade',
            'categorias.nome as Categoria',
            'produtos.estoque as Quantidade',
            \DB::raw('ROUND((produtos.estoque / (produtos.estoque + COALESCE(SUM(saida_estoques.quantidade), 0))) * 100, 2) as Percentual_Restante')
        )
        ->groupBy('produtos.id', 'produtos.nome', 'unidades.sigla', 'categorias.nome', 'produtos.estoque')
        ->orderBy('Percentual_Restante', 'asc')
        ->get();
    }
}
