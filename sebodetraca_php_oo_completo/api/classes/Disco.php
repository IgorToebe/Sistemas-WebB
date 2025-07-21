<?php
require_once 'Conexao.php';

class Disco {
    public $album, $artista, $gravadora, $nfaixas, $ano;

    public function __construct($album, $artista, $gravadora, $nfaixas, $ano) {
        $this->album = $album;
        $this->artista = $artista;
        $this->gravadora = $gravadora;
        $this->nfaixas = $nfaixas;
        $this->ano = $ano;
    }

    public function salvar() {
        $conn = Conexao::conectar();
        $sql = "INSERT INTO discos (album, artista, gravadora, nfaixas, ano) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$this->album, $this->artista, $this->gravadora, $this->nfaixas, $this->ano]);
    }
}
?>