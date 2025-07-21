<?php
require_once 'Conexao.php';

class Livro {
    public $titulo, $autor, $paginas, $editora, $ano;

    public function __construct($titulo, $autor, $paginas, $editora, $ano) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->paginas = $paginas;
        $this->editora = $editora;
        $this->ano = $ano;
    }

    public function salvar() {
        $conn = Conexao::conectar();
        $sql = "INSERT INTO livros (titulo, autor, paginas, editora, ano) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$this->titulo, $this->autor, $this->paginas, $this->editora, $this->ano]);
    }
}
?>