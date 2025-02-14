@extends('layouts.app')

@section('content')
    <h2>QR Code da Retirada</h2>
    <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    <a href="{{ route('saidas_estoque.index') }}">Voltar</a>
@endsection
