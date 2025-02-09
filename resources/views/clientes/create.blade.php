<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>

    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" required>

    <label for="email">Email:</label>
    <input type="text" name="email" required>

    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" required>

    <label for="cep">CEP:</label>
    <input type="text" name="cep" required>

    <label for="rua">Rua:</label>
    <input type="text" name="rua" required>

    <label for="bairro">Bairro:</label>
    <input type="text" name="bairro" required>

    <label for="cidade">Cidade:</label>
    <input type="text" name="cidade" required>

    <label for="estado">Estado:</label>
    <input type="text" name="estado" required>

    <label for="numero">Numero:</label>
    <input type="text" name="numero" required>

    <label for="complemento">Complemento:</label>
    <textarea name="complemento" id="complemento"></textarea>

    <input type="submit" value="Cadastrar">
</form>
