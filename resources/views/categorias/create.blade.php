@extends('layouts.app')

@section('title', 'Cadastrar Categoria')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Cadastro de Categorias</h2>
        <form action="{{ route('categorias.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label for="nome" class="block font-semibold text-gray-600">Nome</label>
                    <input type="text" name="nome" class="w-full p-2 border rounded" pattern="^[^ ].+[^ ]$" required>
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
                <a href="{{ route('categorias.index') }}" class="bg-red-500 px-4 py-2 text-white rounded">Voltar</a>
                    <input type="submit" value="Cadastrar Categoria" class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            </div>
        </form>
    </div>
@endsection

