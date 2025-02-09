@if (session('sucesso'))
    <div class="sucesso">
        {{session('sucesso')}}
    </div>
@elseif(session('erro'))
    <div class="erro">
        {{session('erro')}}
    </div>
@endif

<a href="{{ route('clientes.create') }}">Cadastrar</a>

@if ($clientes->isEmpty())
    <p>Nenhum cliente cadastrado!</p>
@else
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CEP</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome}}</td>
                    <td>{{ $cliente->cpf}}</td>
                    <td>{{ $cliente->email}}</td>
                    <td>{{ $cliente->telefone}}</td>
                    <td>{{ $cliente->endereco->cep}}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Excluir">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif