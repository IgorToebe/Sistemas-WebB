<?php
require_once 'classes/Disco.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $disco = new Disco($_POST['album'], $_POST['artista'], $_POST['gravadora'], $_POST['nfaixas'], $_POST['ano']);
    if ($disco->salvar()) {
        echo "Disco cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar disco.";
    }
}
?>
<form method="POST" action="">
  <label>Álbum: <input type="text" name="album" required></label><br>
  <label>Artista: <input type="text" name="artista" required></label><br>
  <label>Gravadora: <input type="text" name="gravadora" required></label><br>
  <label>Nº Faixas: <input type="number" name="nfaixas" required></label><br>
  <label>Ano: <input type="number" name="ano" required></label><br>
  <button type="submit">Cadastrar Disco</button>
</form>