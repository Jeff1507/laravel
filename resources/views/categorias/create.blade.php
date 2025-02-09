<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" id="descricao"></textarea>

    <input type="submit" value="Cadastrar">
</form>
