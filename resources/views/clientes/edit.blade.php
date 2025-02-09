@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Editar Cliente</h2>

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Nome:</label>
        <input type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">CPF:</label>
        <input type="text" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Email:</label>
        <input type="email" name="email" value="{{ old('email', $cliente->email) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Telefone:</label>
        <input type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" required class="w-full p-2 border rounded">

        <h3 class="text-xl font-semibold mt-4">Endereço</h3>

        <label class="block mt-2">CEP:</label>
        <input type="text" name="cep" value="{{ old('cep', $cliente->endereco->cep) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Rua:</label>
        <input type="text" name="rua" value="{{ old('rua', $cliente->endereco->rua) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Bairro:</label>
        <input type="text" name="bairro" value="{{ old('bairro', $cliente->endereco->bairro) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Cidade:</label>
        <input type="text" name="cidade" value="{{ old('cidade', $cliente->endereco->cidade) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Estado:</label>
        <input type="text" name="estado" value="{{ old('estado', $cliente->endereco->estado) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Número:</label>
        <input type="text" name="numero" value="{{ old('numero', $cliente->endereco->numero) }}" required class="w-full p-2 border rounded">

        <label class="block mt-2">Complemento:</label>
        <textarea name="complemento" class="w-full p-2 border rounded">{{ old('complemento', $cliente->endereco->complemento) }}</textarea>

        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('clientes.index') }}" class="bg-red-500 px-4 py-2 text-white rounded-lg hover:bg-red-700">Voltar</a>
            <input type="submit" value="Editar Cliente" class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-blue-800">
        </div>
    </form>
</div>
@endsection
