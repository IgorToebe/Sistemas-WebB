<?php
echo "<h2>Teste de Conexão com PostgreSQL - Render</h2>";

// Verificar se a extensão PostgreSQL está instalada
if (!extension_loaded('pdo_pgsql')) {
    echo "<p style='color: red;'>❌ Extensão pdo_pgsql não está instalada!</p>";
    exit;
} else {
    echo "<p style='color: green;'>✅ Extensão pdo_pgsql está instalada</p>";
}

require_once 'api/classes/Conexao.php';

try {
    echo "<p>🔄 Tentando conectar ao banco de dados...</p>";
    
    $conn = Conexao::conectar();
    echo "<p style='color: green;'>✅ Conexão com PostgreSQL estabelecida com sucesso!</p>";
    
    // Teste simples de query
    $stmt = $conn->query("SELECT version()");
    $version = $stmt->fetchColumn();
    echo "<p><strong>Versão do PostgreSQL:</strong> " . $version . "</p>";
    
    // Teste de conexão mais detalhado
    $stmt = $conn->query("SELECT current_database(), current_user");
    $info = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p><strong>Database:</strong> " . $info['current_database'] . "</p>";
    echo "<p><strong>Usuário:</strong> " . $info['current_user'] . "</p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Erro na conexão: " . $e->getMessage() . "</p>";
    echo "<p><strong>Código do erro:</strong> " . $e->getCode() . "</p>";
}
?>
