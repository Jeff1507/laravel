@extends('layouts.app')

@section('title', 'Cadastro de Cliente')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex flex-col gap-2 w-full items-center justify-center">
            <div class="p-3 bg-blue-600 rounded-full">
                @svg('heroicon-s-user-group', 'w-16 h-16 text-white')
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Cadastrar Cliente</h2>
        </div>
        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="nome" class="block font-semibold text-gray-600">Nome</label>
                    <input type="text" name="nome" id="nome" class="w-full p-2 border rounded" pattern="^[^ ].+[^ ]$" required>
                </div>

                <div>
                    <label for="cpf" class="block font-semibold text-gray-600">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="w-full p-2 border rounded" required maxlength="14">
                </div>

                <div>
                    <label for="email" class="block font-semibold text-gray-600">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border rounded" required>
                </div>

                <div>
                    <label for="telefone" class="block font-semibold text-gray-600">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="w-full p-2 border rounded" required maxlength="14">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="cep" class="block font-semibold text-gray-600">CEP</label>
                    <input type="text" name="cep" id="cep" class="w-full p-2 border rounded" required maxlength="9">
                </div>

                <div>
                    <label for="rua" class="block font-semibold text-gray-600">Rua</label>
                    <input type="text" name="rua" id="rua" class="w-full p-2 border rounded" required>
                </div>

                <div>
                    <label for="bairro" class="block font-semibold text-gray-600">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="w-full p-2 border rounded" required>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="cidade" class="block font-semibold text-gray-600">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="w-full p-2 border rounded" required>
                </div>

                <div>
                    <label for="estado" class="block font-semibold text-gray-600">Estado</label>
                    <input type="text" name="estado" id="estado" class="w-full p-2 border rounded" required>
                </div>

                <div>
                    <label for="numero" class="block font-semibold text-gray-600">Número</label>
                    <input type="text" name="numero" id="numero" class="w-full p-2 border rounded" required>
                </div>
            </div>

            <div>
                <label for="complemento" class="block font-semibold text-gray-600">Complemento</label>
                <textarea name="complemento" id="complemento" class="w-full p-2 border rounded"></textarea>
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

            <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('clientes.index') }}" class="bg-red-500 px-4 py-2 text-white rounded">Voltar</a>
                <input type="submit" value="Cadastrar Cliente" class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const inputs = document.querySelectorAll("input, textarea");

            inputs.forEach(input => {
                input.addEventListener("input", function () {
                    if (this.name === "cpf") {
                        this.value = this.value.replace(/\D/g, "");
                        if (this.value.length > 11) this.value = this.value.substring(0, 11);
                        if (this.value.length === 11) {
                            this.value = this.value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
                        }
                    } else if (this.name === "cep") {
                        this.value = this.value.replace(/\D/g, "");
                        if (this.value.length > 8) this.value = this.value.substring(0, 8);
                        if (this.value.length === 8) {
                            this.value = this.value.replace(/(\d{5})(\d{3})/, "$1-$2");
                        }
                    } else if (this.name === "telefone") {
                        this.value = this.value.replace(/\D/g, "").substring(0, 11);
                    } else if (this.name === "numero") {
                        this.value = this.value.replace(/\D/g, "").substring(0, 10);
                    }
                });
            });

            // Busca endereço pelo CEP
            document.getElementById("cep").addEventListener("blur", function () {
                let cep = this.value.replace(/\D/g, '');

                document.getElementById("rua").value = "";
                document.getElementById("bairro").value = "";
                document.getElementById("cidade").value = "";
                document.getElementById("estado").value = "";

                if (cep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!data.erro) {
                                document.getElementById("rua").value = data.logradouro;
                                document.getElementById("bairro").value = data.bairro;
                                document.getElementById("cidade").value = data.localidade;
                                document.getElementById("estado").value = data.uf;
                            } else {
                                alert("CEP não encontrado!");
                            }
                        })
                        .catch(error => console.error("Erro ao buscar CEP:", error));
                }
            });
        });
    </script>
@endsection
