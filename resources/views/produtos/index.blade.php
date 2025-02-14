@extends('layouts.app')

@section('title', 'Produtos')

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

        <a href="{{ route('produtos.create') }}" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium rounded-lg w-max flex items-center justify-center gap-2">
            @svg('heroicon-c-plus-circle', 'w-5 h-5')
            Cadastrar Produto
        </a>

        @if ($produtos->isEmpty())
            <p>Nenhuma produto cadastrado!</p>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Imagem do Produto</th>
                        <th scope="col" class="px-6 py-3">Nome</th>
                        <th scope="col" class="px-6 py-3">Estoque</th>
                        <th scope="col" class="px-6 py-3">Valor Unitário</th>
                        <th scope="col" class="px-6 py-3">Categoria</th>
                        <th scope="col" class="px-6 py-3">Unidade de Medida</th>
                        <th scope="col" class="px-6 py-3">Descrição</th>
                        <th scope="col" class="px-6 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="p-4 flex items-center justify-center w-32 h-32 ">
                                <img src="{{ asset('img/produtos/' . $produto->imagem) }}" alt="Imagem do Produto" class="max-w-full max-h-full">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $produto->nome }}</td>
                            <td class="px-6 py-4">{{ $produto->estoque }} unidade(s)</td>
                            <td class="px-6 py-4">R$ {{ $produto->valor_unitario }}</td>
                            <td class="px-6 py-4">{{ $produto->categoria->nome }}</td>
                            <td class="px-6 py-4">{{ $produto->unidade->sigla }}</td>
                            <td class="px-6 py-4">
                                @if ($produto->descricao)
                                    {{ $produto->descricao }}
                                @else
                                    Sem Descrição!
                                @endif
                            </td>
                            <td class="px-6 py-4 ">
                                <div class="flex gap-3">

                                    <a href="{{ route('produtos.show', $produto->id) }}" class="bg-blue-500 p-2 rounded-full text-white">
                                        @svg('heroicon-s-eye', 'w-5 h-5')
                                    </a>
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="bg-purple-500 p-2 rounded-full text-white">
                                        @svg('heroicon-s-pencil-square', 'w-5 h-5')
                                    </a>
                                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 p-2 rounded-full text-white">
                                            @svg('heroicon-s-trash', 'w-5 h-5')
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection