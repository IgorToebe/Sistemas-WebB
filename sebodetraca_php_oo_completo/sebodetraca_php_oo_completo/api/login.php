<?php
// login.php

// 1. O script "puxa" a definição da classe Usuario para poder usá-la.
// O caminho do arquivo deve estar correto conforme sua estrutura de pastas.
require_once 'api/classes/Usuario.php'; 

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'] ?? '';
$senha = $input['password'] ?? '';

if (empty($email) || empty($senha)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'E-mail e senha são obrigatórios.']);
    exit;
}

// 2. AQUI ESTÁ O PONTO-CHAVE: 
// O script chama o método estático 'autenticar' diretamente da sua classe Usuario,
// passando o email e a senha que vieram do formulário do index.html.
if (Usuario::autenticar($email, $senha)) { //
    // A classe Usuario retornou 'true', então o login é válido.
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Login bem-sucedido!']);
} else {
    // A classe Usuario retornou 'false', então o login é inválido.
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'E-mail ou senha incorretos.']);
}
?>