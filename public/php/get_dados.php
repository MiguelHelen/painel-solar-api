<?php
// Recebe JSON do POST
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Conexão com MySQL
$conn = new mysqli('localhost', 'root', '', 'painel_solar');
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['erro' => 'Falha na conexão']);
    exit;
}

// Insere dados na tabela medicoes
$stmt = $conn->prepare("INSERT INTO medicoes (projeto_id, energia_gerada, irradiancia, temperatura, data_medicao) VALUES (?, ?, ?, ?, NOW())");
$projeto_id = 1; // Defina conforme seu contexto
$stmt->bind_param("iddd", $projeto_id, $data['energia_gerada'], $data['irradiancia'], $data['temperatura']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['sucesso' => true, 'id' => $stmt->insert_id]);
} else {
    http_response_code(400);
    echo json_encode(['erro' => 'Falha ao inserir']);
}

$stmt->close();
$conn->close();
?>