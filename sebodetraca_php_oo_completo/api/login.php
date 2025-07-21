<?php
require_once 'classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (Usuario::autenticar($email, $senha)) {
        echo "Login realizado com sucesso!";
    } else {
        echo "E-mail ou senha inválidos.";
    }
}
?>
<form method="POST" action="">
  <label>Email: <input type="email" name="email" required></label><br>
  <label>Senha: <input type="password" name="senha" required></label><br>
  <button type="submit">Entrar</button>
</form>