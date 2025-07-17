<?php
require_once 'classes/Livro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro = new Livro($_POST['titulo'], $_POST['autor'], $_POST['paginas'], $_POST['editora'], $_POST['ano']);
    if ($livro->salvar()) {
        echo "Livro cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar livro.";
    }
}
?>
<form method="POST" action="">
  <label>Título: <input type="text" name="titulo" required></label><br>
  <label>Autor: <input type="text" name="autor" required></label><br>
  <label>Páginas: <input type="number" name="paginas" required></label><br>
  <label>Editora: <input type="text" name="editora" required></label><br>
  <label>Ano: <input type="number" name="ano" required></label><br>
  <button type="submit">Cadastrar Livro</button>
</form>