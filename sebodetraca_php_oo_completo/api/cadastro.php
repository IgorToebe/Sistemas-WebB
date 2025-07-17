<?php
require_once 'classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = new Usuario($nome, $email, $senha);
    if ($usuario->salvar()) {
        echo "Usuário cadastrado com sucesso! <a href='login.php'>Fazer login</a>";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
<form method="POST" action="">
  <label>Nome: <input type="text" name="nome" required></label><br>
  <label>Email: <input type="email" name="email" required></label><br>
  <label>Senha: <input type="password" name="senha" required></label><br>
  <button type="submit">Cadastrar</button>
</form>