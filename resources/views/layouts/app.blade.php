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
                @svg('heroicon-s-user-group', 'w-7 h-7')
                Clientes
            </a>
            <a href="{{ route('produtos.index') }}" class="flex items-center gap-1 font-medium text-lg">
                @svg('heroicon-s-shopping-cart', 'w-7 h-7')
                Produtos
            </a>
            <a href="{{ route('categorias.index') }}" class="flex items-center gap-1 font-medium text-lg">
                @svg('heroicon-s-list-bullet', 'w-7 h-7')
                Categorias
            </a>
            <a href="{{ route('unidades.index') }}" class="flex items-center gap-1 font-medium text-lg">
                @svg('heroicon-c-percent-badge', 'w-7 h-7')
                Unidades de Medida
            </a>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('saidas_estoque.index') }}" class="flex items-center gap-1 font-medium text-lg px-4 py-2 bg-rose-600 rounded-lg">
                @svg('heroicon-c-arrow-left-end-on-rectangle', 'w-5 h-5')
                Saidas de Estoque
            </a> 
            <a href="{{ route('relatorios') }}" class="flex items-center gap-1 font-medium text-lg px-4 py-2 bg-emerald-600 rounded-lg">
                @svg('heroicon-s-document', 'w-5 h-5')
                Gerar Relatórios
            </a>    
        </div>
    </nav>
    <div class="container flex items-center justify-center mx-auto p-4">
        @yield('content')
    </div>
</body>
</html>
