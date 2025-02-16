@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')
    <div class="space-y-6 p-10 bg-white rounded">
        <h2 class="font-semibold text-2xl mb-10">
            Escolha uma opção para gerar Relatório:
        </h2>
        <div class="grid grid-cols-2 gap-8">
            <a href="{{ route('relatorios.gerar', 'periodo') }}" class="p-4 bg-sky-500 text-white font-medium flex flex-col gap-1 rounded-lg">
                @svg('heroicon-c-calendar-days', 'w-12 h-12')
                Relatório Mensal
            </a>
            <a href="{{ route('relatorios.gerar', 'cliente') }}" class="p-4 bg-purple-500 text-white font-medium flex flex-col gap-1 rounded-lg">
                @svg('heroicon-s-user-circle', 'w-12 h-12')
                Relatório por Cliente
            </a>
            <a href="{{ route('relatorios.gerar', 'sem-estoque') }}" class="p-4 bg-red-500 text-white font-medium flex flex-col gap-1 rounded-lg">
                @svg('heroicon-s-archive-box-x-mark', 'w-12 h-12')
                Relatório de Produtos sem Estoque
            </a>
            <a href="{{ route('relatorios.gerar', 'com-estoque') }}" class="p-4 bg-green-500 text-white font-medium flex flex-col gap-1 rounded-lg">
                @svg('heroicon-s-check-badge', 'w-12 h-12')
                Relatório de Produtos com Estoque
            </a>
        </div>
    </div>
@endsection
