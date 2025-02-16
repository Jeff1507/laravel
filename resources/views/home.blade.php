@extends('layouts.app')

@section('title', 'Projeto Estoque')

@section('content')
    <section class="bg-white">
        <div class="grid max-w-screen-xl px-8 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-gray-600">
                    Projeto Estoque
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">
                    Desenvolvimento de um projeto em Laravel para gestão de estoque.
                </p>
                <a href="{{ route('saidas_estoque.index') }}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-800">
                    Retirar Produto do Estoque
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <a href="{{ route('relatorios') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center bg-gray-600 text-white border border-gray-300 rounded-lg hover:bg-gray-800">
                    Gerar Relatórios
                </a> 
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="/img/estoque.jpg" alt="mockup">
            </div>                
        </div>  
    </section>
@endsection