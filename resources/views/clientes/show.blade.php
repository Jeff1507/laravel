@extends('layouts.app')

@section('title', 'Informações do Cliente')

@section('content')
    <div class="flex items-start gap-4">
        <div class="bg-white p-8 rounded-lg grid grid-cols-2 gap-2 w-[350px]">
            <div>
                <h3>Nome</h3>
                <p class="uppercase">{{ $cliente->nome }}</p>
            </div>
            <div>
                <h3>CPF</h3>
                <p>{{ $cliente->cpf }}</p>
            </div>
            <div>
                <h3>Email</h3>
                <p>{{ $cliente->email }}</p>
            </div>
            <div>
                <h3>Telefone</h3>
                <p>{{ $cliente->telefone }}</p>
            </div>
        </div>

        <div class="bg-white p-10 rounded-lg space-y-4 flex-1">
            <h2 class="font-bold text-xl">Endereço do Cliente</h2>
            <div class="grid grid-cols-3 gap-2">
                <p>CEP: {{ $cliente->endereco->cep }}</p>
                <p>Rua: {{ $cliente->endereco->rua }}</p>
                <p>Bairro: {{ $cliente->endereco->bairro }}</p>
                <p>Cidade: {{ $cliente->endereco->cidade }}</p>
                <p>Estado: {{ $cliente->endereco->estado }}</p>
                <p>numero: {{ $cliente->endereco->numero }}</p>
                @if($cliente->endereco->complemento)
                    <p class="text-gray-600"><strong>Complemento:</strong> {{ $cliente->endereco->complemento }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection