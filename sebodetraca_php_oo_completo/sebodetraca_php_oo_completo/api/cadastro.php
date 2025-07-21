<?php
// cadastro.php - Refatorado para ser um Endpoint de API

// Padronizando o caminho para a pasta 'api'
require_once 'api/classes/Usuario.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

// Lê o corpo da requisição JSON, que virá do fetch do Cadastro.html
$input = json_decode(file_get_contents('php://input'), true);

$nome = $input['nome'] ?? '';
$email = $input['email'] ?? '';
$senha = $input['senha'] ?? '';

if (empty($nome) || empty($email) || empty($senha)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
    exit;
}

try {
    // A classe Usuario já faz o hash da senha no construtor
    $usuario = new Usuario($nome, $email, $senha);

    if ($usuario->salvar()) {
        http_response_code(201); // 201 Created
        echo json_encode(['success' => true, 'message' => 'Usuário cadastrado com sucesso!']);
    } else {
        http_response_code(500); // Erro Interno do Servidor
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco de dados.']);
    }
} catch (PDOException $e) {
    // Captura erros de violação de chave única (ex: email duplicado)
    if ($e->getCode() == 23505) { // Código de erro para unique_violation no PostgreSQL
        http_response_code(409); // Conflict
        echo json_encode(['success' => false, 'message' => 'Este e-mail já está cadastrado.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro no servidor: ' . $e->getMessage()]);
    }
}
?>