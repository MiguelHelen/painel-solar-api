<?php
require_once "Conexao.php";

$intervalo = 60; // segundos entre cada ciclo
$pasta = __DIR__ . "/processar/";

// Loop infinito

while (true) {
    echo "\nVerificando arquivos em: $pasta\n";
    $arquivos = glob($pasta . "projeto_*.txt");
    if ($arquivos) {
        $pdo = Conectar::getInstance();
        $stmt = $pdo->prepare("INSERT INTO medicoes (projeto_id, energia_gerada, irradiancia, temperatura, data_medicao) VALUES (?, ?, ?, ?, ?)");
        foreach ($arquivos as $arquivo) {
            preg_match("/projeto_(\d+)\.txt$/", basename($arquivo), $match);
            $projeto_id = intval($match[1]);
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
            $destino = $pasta . "processados";
            if (!is_dir($destino)) {
                mkdir($destino, 0777, true);
            }
            rename($arquivo, $destino . "/" . basename($arquivo));
        }
        $pdo = null;
        echo "Importação concluída.\n";
    } else {
        echo "Nenhum arquivo TXT encontrado.\n";
    }
    echo "Aguardando $intervalo segundos...\n";
    sleep($intervalo);
}
?>
