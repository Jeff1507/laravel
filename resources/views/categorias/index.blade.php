@if (session('sucesso'))
    <div class="sucesso">
        {{session('sucesso')}}
    </div>
@elseif(session('erro'))
    <div class="erro">
        {{session('erro')}}
    </div>
@endif

<a href="{{ route('categorias.create') }}">Cadastrar</a>

@if ($categorias->isEmpty())
    <p>Nenhuma categoria cadastrada!</p>
@else
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descricao</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nome}}</td>
                    <td>{{ $categoria->descricao}}</td>
                    <td>
                        <a href="{{ route('categorias.show', $categoria->id) }}">Ver</a>
                        <a href="{{ route('categorias.edit', $categoria->id) }}">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
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