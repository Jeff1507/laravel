@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
    <div class="flex flex-col gap-4 max-w-4xl mx-auto">
        @if (session('sucesso'))
            <div class="sucesso">
                {{session('sucesso')}}
            </div>
        @elseif(session('erro'))
            <div class="erro">
                {{session('erro')}}
            </div>
        @endif
        <div class="flex items-center justify-between w-full">
            <form class="max-w-md flex-1">   
                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Pesquisar</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="search" class="block w-full p-4 ps-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Pesquisar cliente pelo nome..." required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Pesquisar</button>
                </div>
            </form>
            <a href="{{ route('clientes.create') }}" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium rounded-lg w-max flex items-center justify-center gap-2">
                @svg('heroicon-s-user-plus', 'w-5 h-5')
                Cadastrar cliente
            </a>
        </div>
        @if ($clientes->isEmpty())
            <p>Nenhum cliente cadastrado!</p>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nome</th>
                        <th scope="col" class="px-6 py-3">CPF</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Telefone</th>
                        <th scope="col" class="px-6 py-3">CEP</th>
                        <th scope="col" class="px-6 py-3">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $cliente->nome}}</td>
                            <td class="px-6 py-4">{{ $cliente->cpf}}</td>
                            <td class="px-6 py-4">{{ $cliente->email}}</td>
                            <td class="px-6 py-4">{{ $cliente->telefone}}</td>
                            <td class="px-6 py-4">{{ $cliente->endereco->cep}}</td>
                            <td class="px-6 py-4 flex items-center gap-3">
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="bg-blue-500 p-2 rounded-full text-white">
                                    @svg('heroicon-s-eye', 'w-5 h-5')
                                </a>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-purple-500 p-2 rounded-full text-white">
                                    @svg('heroicon-s-pencil-square', 'w-5 h-5')
                                </a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
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
        @endif
    </div>
@endsection