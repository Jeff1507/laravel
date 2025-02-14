<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-100">
    <nav class="bg-blue-600 text-white px-8 py-4 shadow-lg flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-bold text-2xl whitespace-nowrap flex items-center">
            @svg('heroicon-s-archive-box', 'w-8 h-8 mr-2')
            Projeto Estoque
        </a>
        <div class="flex items-center gap-8">
            <a href="{{ route('clientes.index') }}" class="flex items-center gap-1 font-medium text-lg">
                @svg('heroicon-s-user-group', 'w-5 h-5')
                Clientes
            </a>
            <a href="{{ route('produtos.index') }}" class="flex items-center gap-1 font-medium text-lg">
                @svg('heroicon-s-shopping-cart', 'w-5 h-5')
                Produtos
            </a>
            <a href="{{ route('categorias.index') }}" class="flex items-center gap-1 font-medium text-lg">
                @svg('heroicon-s-list-bullet', 'w-5 h-5')
                Categorias
            </a>
            <a href="{{ route('unidades.index') }}" class="flex items-center gap-1 font-medium text-lg">
                @svg('heroicon-c-percent-badge', 'w-5 h-5')
                Unidades de Medida
            </a>
        </div>
    </nav>
    <div class="container flex items-center justify-center mx-auto p-4">
        @yield('content')
    </div>
</body>
</html>
