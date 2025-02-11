@extends('layouts.app')

@section('title', 'Cadastrar Unidade de Medida')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex flex-col gap-2 w-full items-center justify-center">
            <div class="p-3 bg-blue-600 rounded-full">
                @svg('heroicon-c-percent-badge', 'w-16 h-16 text-white')
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Cadastrar Unidade de Medida</h2>
        </div>
        <form action="{{ route('unidades.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label for="sigla" class="block font-semibold text-gray-600">Sigla</label>
                    <input type="text" name="sigla" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label for="descricao" class="block font-semibold text-gray-600">Descrição</label>
                    <textarea name="descricao" id="descricao" class="w-full p-2 border rounded"></textarea>
                </div>
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
                <a href="{{ route('unidades.index') }}" class="bg-red-500 px-4 py-2 text-white rounded">Voltar</a>
                <input type="submit" value="Cadastrar Unidade" class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            </div>
        </form>
    </div>
@endsection

