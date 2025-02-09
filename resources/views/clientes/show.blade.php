@extends('layouts.app')

@section('title', 'Informações do Cliente')

@section('content')
    <div class="flex items-start gap-4">
        <div class="bg-white p-8 rounded-lg flex flex-col items-center justify-center gap-2 max-w-max">
            <div>
                <img src="" alt="">
            </div>
            <h3 class="uppercase">{{ $cliente->nome }}</h3>
            <div class="flex items-center justify-between gap-2">
                <h3>CPF</h3>
                <p>{{ $cliente->cpf }}</p>
            
                <h3>Email</h3>
                <p>{{ $cliente->email }}</p>
            
                <h3>Telefone</h3>
                <p>{{ $cliente->telefone }}</p>
            </div>
        </div>

        <div class="bg-white p-10 rounded-lg space-y-8 flex-1">
            <h2 class="font-bold text-2xl text-gray-600">Endereço do Cliente</h2>
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
                <a href="#" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-mediu rounded-lg">Editar Endereço</a>
            </div>
        </div>
    </div>
@endsection