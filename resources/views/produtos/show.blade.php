@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
    <div class="flex items-start gap-4 bg-white p-10 rounded-lg max-w-5xl self-center">
        <div class="flex flex-col items-center justify-center gap-6 w-[280px]">
            <div class="flex flex-col gap-2 items-center justify-center">
                <div class="w-40 h-40 rounded-full flex items-center justify-center">
                    <img src="{{ asset('img/produtos/' . $produto->imagem) }}" alt="Imagem do Produto" class="max-w-full max-h-full">
                </div>
                <h3 class="text-2xl text-gray-600">{{ $produto->nome }}</h3>
            </div>
            <div class="flex flex-wrap gap-2 items-center justify-center">
                <p class="p-2 bg-gray-100 rounded-lg text-blue-600 flex gap-2 items-center">
                    Qtd: {{ $produto->estoque }}
                </p>
                <p class="p-2 bg-gray-100 rounded-lg text-blue-600 flex gap-2 items-center">
                    R$ {{ $produto->valor_unitario }} p/unidade
                </p>
            </div>
            <div class="flex flex-col gap-2 items-center justify-between w-full">
                <a href="{{ route('produtos.edit', $produto->id) }}" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium rounded-lg w-full flex items-center justify-center gap-1">
                    @svg('heroicon-s-pencil-square', 'w-5 h-5')
                    Editar Produto
                </a>
                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 cursor-pointer hover:bg-red-700 px-4 py-2 text-white font-medium rounded-lg w-full flex items-center justify-center gap-1">
                        @svg('heroicon-s-trash', 'w-5 h-5')
                        Excluir Produto
                    </button>
                </form>
                <a href="{{ route('produtos.index') }}" class="bg-purple-500 cursor-pointer hover:bg-purple-800 px-4 py-2 text-white font-medium rounded-lg w-full flex justify-center items-center gap-1">
                    @svg('heroicon-c-arrow-left-circle', 'w-5 h-5')
                    Voltar
                </a>
            </div>
        </div>
        <div class="w-px h-[420px] bg-gray-300 mr-3"></div>
        <div class="space-y-6 flex-1">
            <h2 class="font-bold text-2xl text-gray-600">Informações do Produto</h2>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <h3 class="font-light text-sm">Quantidade</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $produto->estoque }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Valor Unitário</h3>
                    <p class="text-lg font-medium text-gray-600">R$ {{ $produto->valor_unitario }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Categoria</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $produto->categoria->nome }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Unidade de Medida</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $produto->unidade->sigla }}</p>
                </div>
                <div class="col-span-full w-full">
                    <h3 class="font-light text-sm">Descrição</h3>
                    @if($produto->descricao)
                        <p class="text-lg font-medium text-gray-600 whitespace-wrap w-full">{{ $produto->descricao }}</p>
                    @else
                        <p class="text-lg font-medium text-gray-600">Sem Descrição!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection