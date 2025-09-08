<?php
require_once "Conexao.php";

$pdo = Conectar::getInstance();

// Inserir usuário
echo "Inserindo usuário...\n";
$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
$stmt->execute(["Usuário Testw", "testwe@exemplo.com", password_hash("1234556", PASSWORD_DEFAULT), "admin"]);
$usuario_id = $pdo->lastInsertId();

// Inserir projeto
echo "Inserindo projeto...\n";
$stmt = $pdo->prepare("INSERT INTO projetos (nome, descricao, localizacao, criado_por) VALUES (?, ?, ?, ?)");
$stmt->execute(["Projeto T1este", "Projeeto de teste", "Lpocal Teste", $usuario_id]);
$projeto_id = $pdo->lastInsertId();

// Inserir medição
echo "Inserindo medição...\n";
$stmt = $pdo->prepare("INSERT INTO medicoes (projeto_id, energia_gerada, irradiancia, temperatura, data_medicao) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$projeto_id, 163.45, 801.5, 35.3, date('Y-m-d H:i:s')]);

// Consultar dados inseridos
echo "\nUsuários:\n";
foreach ($pdo->query("SELECT * FROM usuarios") as $row) {
    print_r($row);
}
echo "\nProjetos:\n";
foreach ($pdo->query("SELECT * FROM projetos") as $row) {
    print_r($row);
}
echo "\nMedições:\n";
foreach ($pdo->query("SELECT * FROM medicoes") as $row) {
    print_r($row);
}

$pdo = null;
echo "\nTeste concluído!";
?>
