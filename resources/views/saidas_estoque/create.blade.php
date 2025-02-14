@extends('layouts.app')

@section('title', 'Retirar do Estoque')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex flex-col gap-2 w-full items-center justify-center">
            <div class="p-3 bg-blue-600 rounded-full">
                @svg('heroicon-c-percent-badge', 'w-16 h-16 text-white')
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Registrar Saída de Estoque</h2>
        </div>
        <form action="{{ route('saidas_estoque.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label for="cliente_id" class="block font-semibold text-gray-600">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="w-full p-2 border rounded" required>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="produto_id" class="block font-semibold text-gray-600">Produto</label>
                    <select name="produto_id" id="produto_id" class="w-full p-2 border rounded" required>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}">{{ $produto->nome }} (Qtd: {{ $produto->estoque }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="quantidade" class="block font-semibold text-gray-600">Quantidade</label>
                    <input type="number" name="quantidade" required min="1" class="w-full p-2 border rounded">
                </div>
            </div>
            @if ($errors->any() || session('erro'))
                <div class="bg-red-50 text-red-700 p-3 rounded mb-4">
                    <strong>Erro ao retirar do estoque!</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                        @if (session('erro'))
                            <li class="text-sm">{{ session('erro') }}</li>
                        @endif
                    </ul>
                </div>
            @endif
            <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('saidas_estoque.index') }}" class="bg-red-500 px-4 py-2 text-white rounded">Voltar</a>
                <input type="submit" value="Registrar Saída" class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            </div>
        </form>
    </div>
@endsection
