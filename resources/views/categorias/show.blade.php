@extends('layouts.app')

@section('title', 'Informações da Categoria')

@section('content')
    <div class="w-[630px] bg-white p-10 rounded-lg">
        <div class="flex flex-col gap-2 w-full">
            <div class="p-3 bg-blue-600 rounded-full size-max">
                @svg('heroicon-s-list-bullet', 'w-16 h-16 text-white')
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-6">Informações da Categoria</h2>
        </div>

        <h3 class="font-light text-sm">Nome da Categoria</h3>
        <p class="text-lg font-medium text-gray-600 mb-4">{{ $categoria->nome }}</p>
        <h3 class="font-light text-sm">Descrição da Categoria</h3>
        <p class="text-lg font-medium text-gray-600 mb-4">
            @if ($categoria->descricao)
                {{ $categoria->descricao }}
            @else
                Sem Descrição!
            @endif
        </p>
        <div class="flex gap-2 items-center justify-between w-full mt-6">
            <a href="{{ route('categorias.index') }}" class="w-[170px] bg-purple-500 cursor-pointer hover:bg-purple-800 px-4 py-2 text-white font-medium rounded-lg flex justify-center items-center gap-1">
                @svg('heroicon-c-arrow-left-circle', 'w-5 h-5')
                Voltar
            </a>
            <a href="{{ route('categorias.edit', $categoria->id) }}" class="bg-blue-600 cursor-pointer hover:bg-blue-800 px-4 py-2 text-white font-medium rounded-lg flex items-center justify-center gap-1">
                @svg('heroicon-s-pencil-square', 'w-5 h-5')
                Editar Categoria
            </a>
            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 cursor-pointer hover:bg-red-700 px-4 py-2 text-white font-medium rounded-lg flex items-center justify-center gap-1">
                    @svg('heroicon-s-trash', 'w-5 h-5')
                    Excluir Categoria
                </button>
            </form>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm("AVISO: Ao deletar essa categoria, todos os produtos relacionados serão deletados juntos. Deseja continuar mesmo assim?")) {
                event.target.submit();
            }
        }
    </script>
@endsection