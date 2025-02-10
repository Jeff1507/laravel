@extends('layouts.app')

@section('title', 'Categorias')

@if (session('sucesso'))
    <div class="sucesso">
        {{session('sucesso')}}
    </div>
@elseif(session('erro'))
    <div class="erro">
        {{session('erro')}}
    </div>
@endif

<a href="{{ route('categorias.create') }}">Cadastrar</a>

@if ($categorias->isEmpty())
    <p>Nenhuma categoria cadastrada!</p>
@else
    @section('content')
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-max mx-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nome</th>
                        <th scope="col" class="px-6 py-3">Descricao</th>
                        <th scope="col" class="px-6 py-3">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $categoria->nome}}</td>
                            <td class="px-6 py-4">{{ $categoria->descricao}}</td>
                            <td class="px-6 py-4 flex items-center gap-3">
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="bg-purple-500 p-2 rounded-full text-white">
                                    @svg('heroicon-s-pencil-square', 'w-5 h-5')
                                </a>
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="mt-3.5">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 p-2 rounded-full text-white">
                                        @svg('heroicon-s-trash', 'w-5 h-5')
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
@endif