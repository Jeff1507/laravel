@extends('layouts.app')

@section('title', 'Cadastro de Cliente')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Cadastro de Cliente</h2>
    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="nome" class="block font-semibold text-gray-600">Nome</label>
                <input type="text" name="nome" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label for="cpf" class="block font-semibold text-gray-600">CPF</label>
                <input type="text" name="cpf" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label for="email" class="block font-semibold text-gray-600">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label for="telefone" class="block font-semibold text-gray-600">Telefone</label>
                <input type="text" name="telefone" class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="cep" class="block font-semibold text-gray-600">CEP</label>
                <input type="text" name="cep" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label for="rua" class="block font-semibold text-gray-600">Rua</label>
                <input type="text" name="rua" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label for="bairro" class="block font-semibold text-gray-600">Bairro</label>
                <input type="text" name="bairro" class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="cidade" class="block font-semibold text-gray-600">Cidade</label>
                <input type="text" name="cidade" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label for="estado" class="block font-semibold text-gray-600">Estado</label>
                <input type="text" name="estado" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label for="numero" class="block font-semibold text-gray-600">Número</label>
                <input type="text" name="numero" class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div>
            <label for="complemento" class="block font-semibold text-gray-600">Complemento</label>
            <textarea name="complemento" class="w-full p-2 border rounded"></textarea>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <strong>Erro no cadastro</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('clientes.index') }}" class="bg-red-500 px-4 py-2 text-white rounded">Voltar</a>
            <input type="submit" value="Cadastrar Cliente" class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-blue-800">
        </div>
    </form>
</div>
@endsection
