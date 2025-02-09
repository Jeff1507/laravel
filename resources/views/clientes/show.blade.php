@extends('layouts.app')

@section('title', 'Informações do Cliente')

@section('content')
    <div class="flex items-start gap-4">
        <div class="bg-white p-10 rounded-lg flex flex-col items-center justify-center gap-6 w-[380px]">
            <div class="flex flex-col gap-2 items-center justify-center">
                <div class="w-24 h-24 rounded-full bg-gray-100"></div>
                <h3 class="text-2xl text-gray-600">{{ $cliente->nome }}</h3>
            </div>
            <div class="flex flex-wrap gap-2 items-center justify-center">
                <p class="p-2 bg-gray-100 rounded-lg text-blue-600 flex gap-2 items-center">
                    @svg('heroicon-s-identification', 'w-5 h-5') 
                    {{ $cliente->cpf }}
                </p>
                <p class="p-2 bg-gray-100 rounded-lg text-blue-600 flex gap-2 items-center">
                    @svg('heroicon-s-phone', 'w-5 h-5') 
                    {{ $cliente->telefone }}
                </p>
                <p class="p-2 bg-gray-100 rounded-lg text-blue-600 flex gap-2 items-center">
                    @svg('heroicon-s-envelope', 'w-5 h-5') 
                    {{ $cliente->email }}
                </p>
            </div>
            <a href="{{ route('clientes.index') }}" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium max-w-max rounded-lg ">
                Voltar
            </a>
            <!--<div class="flex gap-2 items-center justify-between w-full">
                <a href="#" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium rounded-lg w-1/2 flex items-center gap-1">
                    @svg('heroicon-s-pencil-square', 'w-5 h-5')
                    Editar Cliente
                </a>
                <a href="#" class="bg-red-500 cursor-pointer hover:bg-red-700 px-4 py-2 text-white font-medium rounded-lg w-1/2 flex items-center gap-1">
                @svg('heroicon-s-trash', 'w-5 h-5')
                    Excluir Cliente
                </a>
            </div>-->
        </div>

        <div class="bg-white p-10 rounded-lg space-y-6 flex-1">
            <div class="flex items-center gap-1.5">
                @svg('heroicon-s-map-pin', 'w-6 h-6 text-gray-600')
                <h2 class="font-bold text-2xl text-gray-600">Endereço do Cliente</h2>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <h3 class="font-light text-sm">CEP</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $cliente->endereco->cep }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Rua</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $cliente->endereco->rua }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Bairro</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $cliente->endereco->bairro }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Cidade</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $cliente->endereco->cidade }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Estado</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $cliente->endereco->estado }}</p>
                </div>
                <div>
                    <h3 class="font-light text-sm">Número da Residência</h3>
                    <p class="text-lg font-medium text-gray-600">{{ $cliente->endereco->numero }}</p>
                </div>

                
                <div class="col-span-full">
                    <h3 class="font-light text-sm">Complemento</h3>
                    @if($cliente->endereco->complemento)
                        <p class="text-lg font-medium text-gray-600">{{ $cliente->endereco->complemento }}</p>
                    @else
                        <p class="text-lg font-medium text-gray-600">Nenhum complemento foi informado!</p>
                    @endif
                </div>
            </div>
            <div>
                <a href="#" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium max-w-max rounded-lg flex items-center gap-1">
                    @svg('heroicon-s-pencil-square', 'w-5 h-5')
                    Editar Endereço
                </a>
            </div>
        </div>
    </div>
@endsection