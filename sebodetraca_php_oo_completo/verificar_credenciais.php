<?php
echo "<h2>Verificação das Credenciais do PostgreSQL</h2>";

echo "<h3>📋 Configurações atuais no código:</h3>";
echo "<p><strong>Host:</strong> dpg-d1sjc3re5dus73b3pre0-a.oregon-postgres.render.com</p>";
echo "<p><strong>Porta:</strong> 5432</p>";
echo "<p><strong>Database:</strong> sbt_bd</p>";
echo "<p><strong>Usuário:</strong> sebodetraca</p>";
echo "<p><strong>Senha:</strong> Ye4TSE... (primeiros 6 caracteres)</p>";

echo "<h3>✅ O que você deve verificar no painel do Render:</h3>";
echo "<ol>";
echo "<li><strong>Host completo:</strong> Deve terminar com <code>.render.com</code></li>";
echo "<li><strong>Porta:</strong> Geralmente é 5432 para PostgreSQL</li>";
echo "<li><strong>Nome do Database:</strong> Confirme se é exatamente 'sbt_bd'</li>";
echo "<li><strong>Username:</strong> Confirme se é exatamente 'sebodetraca'</li>";
echo "<li><strong>Password:</strong> Copie exatamente como aparece no painel</li>";
echo "</ol>";

echo "<h3>🔍 Possíveis variações do host:</h3>";
echo "<ul>";
echo "<li>dpg-d1sjc3re5dus73b3pre0-a.oregon-postgres.render.com</li>";
echo "<li>dpg-d1sjc3re5dus73b3pre0-a.virginia-postgres.render.com</li>";
echo "<li>dpg-d1sjc3re5dus73b3pre0-a.frankfurt-postgres.render.com</li>";
echo "</ul>";

echo "<h3>📝 Passos para verificar:</h3>";
echo "<ol>";
echo "<li>Entre no painel do Render</li>";
echo "<li>Vá na seção 'PostgreSQL'</li>";
echo "<li>Clique no seu banco de dados</li>";
echo "<li>Na aba 'Info', compare com as configurações acima</li>";
echo "</ol>";

echo "<p style='background: #f0f0f0; padding: 10px; border-radius: 5px;'>";
echo "<strong>💡 Dica:</strong> Se alguma informação estiver diferente, me avise para que eu possa corrigir no arquivo Conexao.php";
echo "</p>";
?>
