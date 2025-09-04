<?php

$txtDir = "txt/"; // Diretório interno com os arquivos .txt


// Verifica se o diretório existe
if (!is_dir($txtDir)) {
    echo "Diretório interno não encontrado.";
    exit();
}


// Lista arquivos .txt do diretório
$txtFiles = glob($txtDir . "*.txt");


// Se o usuário selecionou um arquivo via GET
$selectedFileContent = '';
if (isset($_GET['file'])) {
    $requestedFile = basename($_GET['file']); // Evita path traversal
    $fullPath = $txtDir . $requestedFile;

    if (file_exists($fullPath) && pathinfo($fullPath, PATHINFO_EXTENSION) === 'txt') {
        $selectedFileContent = file_get_contents($fullPath);
    } else {
        $selectedFileContent = "Arquivo inválido ou inexistente.";
    }
}

?>