<?php
require_once "Conexao.php";

$intervalo = 120; // segundos entre cada ciclo (2 minutos)

while (true) {
    $pdo = Conectar::getInstance();

    // Inserir evento no historico
    echo "Inserindo evento no historico...\n";
    $stmt = $pdo->prepare("INSERT INTO historico (usuario_id, projeto_id, acao, detalhes) VALUES (?, ?, ?, ?)");
    $stmt->execute([1, 1, "Importação de medições", "Importação realizada via TXT"]);

    // Inserir dado na tabela dados_api
    echo "Inserindo dado na tabela dados_api...\n";
    $stmt = $pdo->prepare("INSERT INTO dados_api (chave, valor, projeto_id) VALUES (?, ?, ?)");
    $stmt->execute(["temperatura_ambiente", "28.5", 1]);

    // Consultar dados inseridos
    echo "\nHistórico:\n";
    foreach ($pdo->query("SELECT * FROM historico") as $row) {
        print_r($row);
    }
    echo "\nDados API:\n";
    foreach ($pdo->query("SELECT * FROM dados_api") as $row) {
        print_r($row);
    }

    $pdo = null;
    echo "\nColeta concluída!\n";
    echo "Aguardando $intervalo segundos...\n";
    sleep($intervalo);
}
?>
