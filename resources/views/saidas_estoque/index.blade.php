@extends('layouts.app')

@section('title', 'Saidas do Estoque')

@section('content')
    <div class="flex flex-col gap-4 max-w-max mx-auto">
        @if (session('sucesso'))
            <div class="sucesso">
                {{session('sucesso')}}
            </div>
        @elseif(session('erro'))
            <div class="erro">
                {{session('erro')}}
            </div>
        @endif

        <a href="{{ route('saidas_estoque.create') }}" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium rounded-lg w-max flex items-center justify-center gap-2">
            @svg('heroicon-c-plus-circle', 'w-5 h-5')
            Registrar Nova Saída
        </a>

        @if ($saidas->isEmpty())
            <p>Nenhuma saida registrada!</p>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Cliente</th>
                        <th scope="col" class="px-6 py-3">Produto</th>
                        <th scope="col" class="px-6 py-3">Quantidade</th>
                        <th scope="col" class="px-6 py-3">Valor Total</th>
                        <th scope="col" class="px-6 py-3">Data</th>
                        <th scope="col" class="px-6 py-3">QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($saidas as $saida)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $saida->cliente->nome }}</td>
                            <td class="px-6 py-4">{{ $saida->produto->nome }}</td>
                            <td class="px-6 py-4">{{ $saida->quantidade }}</td>
                            <td class="px-6 py-4">R$ {{ $saida->valor_total }}</td>
                            <td class="px-6 py-4">{{ $saida->data_retirada }}</td>
                            <td class="px-6 py-4 flex items-center">
                                <a href="{{ route('saidas_estoque.qrcode', $saida->id) }}" class="bg-emerald-500 p-2 rounded-lg text-white flex items-center font-medium">
                                    @svg('heroicon-c-qr-code', 'w-5 h-5 mr-1.5')
                                    Gerar QR Code
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
@endsection
