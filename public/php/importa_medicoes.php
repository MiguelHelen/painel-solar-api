<?php
require_once "Conexao.php";

// Pasta onde estão os arquivos TXT
$pasta = __DIR__ . "/processar/";
$arquivos = glob($pasta . "projeto_*.txt");

// Verifica se há arquivos para processar

if (!$arquivos) {
    echo "Nenhum arquivo TXT encontrado.\n";
    exit;
}

// Conexão com o banco

$pdo = Conectar::getInstance();
$stmt = $pdo->prepare("
    INSERT INTO medicoes (projeto_id, energia_gerada, irradiancia, temperatura, data_medicao) 
    VALUES (?, ?, ?, ?, ?)
");

// Processa cada arquivo

foreach ($arquivos as $arquivo) {
    preg_match("/projeto_(\d+)\.txt$/", basename($arquivo), $match);
    $projeto_id = intval($match[1]); // pega o ID do projeto do nome do arquivo


    echo "Importando dados do Projeto $projeto_id...\n";

    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    

    foreach ($linhas as $linha) {
        $dados = explode(";", $linha);
        if (count($dados) == 4) {
            $energia = floatval($dados[0]);
            $irradiancia = floatval($dados[1]);
            $temperatura = floatval($dados[2]);
            $data = $dados[3];

            $stmt->execute([$projeto_id, $energia, $irradiancia, $temperatura, $data]);
        }
    }

    // mover para pasta processados
    rename($arquivo, $pasta . "processados/" . basename($arquivo));
}

echo "Importação concluída.\n";
$pdo = null;
?>