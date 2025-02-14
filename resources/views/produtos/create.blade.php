@extends('layouts.app')

@section('title', 'Cadastrar Produto')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex flex-col gap-2 w-full items-center justify-center">
            <div class="p-3 bg-blue-600 rounded-full">
                @svg('heroicon-s-archive-box', 'w-16 h-16 text-white')
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Cadastrar Produto</h2>
        </div>
        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="nome" class="block font-semibold text-gray-600">Nome</label>
                    <input type="text" name="nome" id="nome" class="w-full p-2 border rounded" pattern="^[^ ].+[^ ]$" required>
                </div>
                <div>
                    <label for="imagem" class="block font-semibold text-gray-600">Imagem</label>
                    <img id="imagemPreview" src="#" alt="Imagem do Produto" class="max-w-full max-h-40 mx-auto mt-2">
                    <input type="file" name="imagem" id="imagem" onchange="ImagemPreview(event)" class="w-full">
                </div>
                <div>
                    <label for="categoria_id" class="block font-semibold text-gray-600">Categoria</label>
                    <select name="categoria_id" id="categoria_id" class="w-full p-2 border rounded" required>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="unidade_id" class="block font-semibold text-gray-600">Unidade de Medida</label>
                    <select name="unidade_id" id="unidade_id" class="w-full p-2 border rounded" required>
                        @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->sigla }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="estoque" class="block font-semibold text-gray-600">Estoque</label>
                    <input type="number" name="estoque" id="estoque" required min="0" class="w-full p-2 border rounded">
                </div>

                <div>
                    <label for="valor_unitario" class="block font-semibold text-gray-600">Valor Unitário</label>
                    <input type="text" name="valor_unitario" id="valor_unitario" required class="w-full p-2 border rounded">
                </div>

                <div class="col-span-full">
                    <label for="descricao" class="block font-semibold text-gray-600">Descrição</label>
                    <textarea name="descricao" id="descricao" class="w-full p-2 border rounded"></textarea>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 text-red-700 p-3 rounded mb-4">
                        <strong>Erro no cadastro</strong>
                        <ul class="mt-2">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
            <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('produtos.index') }}" class="bg-red-500 px-4 py-2 text-white rounded">Voltar</a>
                <input type="submit" value="Cadastrar Produto" class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            </div>
        </form>
    </div>
    <script>
    function ImagemPreview(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagemPreview');
            output.src = reader.result;
            output.style.display = 'block';  // Exibe a imagem
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection