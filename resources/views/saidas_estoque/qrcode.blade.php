@extends('layouts.app')

@section('title', 'QR Code da Retirada do Produto')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg text-center">
        @if (session('sucesso'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-gray-700 mb-4">Escaneie o QR Code abaixo:</h2>

        <div class="flex justify-center">
            <img src="{{ $qrCode }}" alt="QR Code da Retirada">
        </div>

        <div class="mt-4">
            <a href="{{ route('saidas_estoque.index') }}" class="bg-blue-600 px-4 py-2 text-white rounded-lg hover:bg-blue-800">Voltar</a>
        </div>
    </div>
@endsection
