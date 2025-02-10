@extends('layouts.app')

@section('title', 'Clientes')

@if (session('sucesso'))
    <div class="sucesso">
        {{session('sucesso')}}
    </div>
@elseif(session('erro'))
    <div class="erro">
        {{session('erro')}}
    </div>
@endif

<a href="{{ route('clientes.create') }}">Cadastrar</a>

@if ($clientes->isEmpty())
    <p>Nenhum cliente cadastrado!</p>
@else
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-max mx-auto">
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
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="mt-3.5">
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
@endif