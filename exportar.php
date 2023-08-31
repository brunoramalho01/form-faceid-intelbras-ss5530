<?php
// Caminho para o arquivo de banco de dados SQLite
$dbFile = 'data/usuarios.db';

// Nome da tabela da qual você deseja exportar dados
$tableName = 'usuarios';

// Conectar ao banco de dados SQLite
$pdo = new PDO("sqlite:$dbFile");

// Consulta SQL para selecionar todos os dados da tabela
$query = "SELECT * FROM $tableName";
$stmt = $pdo->query($query);

// Recuperar todos os resultados da consulta
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Caminho para a pasta onde você deseja salvar o arquivo CSV
$folderPath = 'export/';

// Nome do arquivo CSV que será gerado
$csvFileName = 'usuarios.csv';

// Caminho completo para o arquivo CSV
$csvFilePath = $folderPath . $csvFileName;

// Verificar se o arquivo CSV já existe
if (file_exists($csvFilePath)) {
    // Ler o conteúdo do arquivo CSV existente
    $existingData = file_get_contents($csvFilePath);

    // Transformar os dados do banco de dados em um formato CSV
    ob_start();
    $csvFile = fopen('php://output', 'w');
    $delimiter = ';';

    // Escrever o cabeçalho do CSV (nomes das colunas)
    if (!empty($results) && strpos($existingData, ';') === false) {
        $header = array_keys($results[0]);
        fputcsv($csvFile, $header, $delimiter);
    }

    foreach ($results as $row) {
        fputcsv($csvFile, $row, $delimiter);
    }

    fclose($csvFile);
    $dbCsvData = ob_get_clean();

    // Verificar se os dados são diferentes
    if ($existingData !== $dbCsvData) {
        // Atualizar o arquivo CSV com os novos dados
        file_put_contents($csvFilePath, $dbCsvData);

        echo "Arquivo CSV atualizado com sucesso.";
    } else {
        echo "Os dados do CSV estão atualizados.";
    }
} else {
    // Arquivo CSV não existe, criar o arquivo com os dados do banco de dados
    $csvFile = fopen($csvFilePath, 'w');

    // Definir o delimitador como ponto-e-vírgula
    $delimiter = ';';

    // Escrever o cabeçalho do CSV (nomes das colunas)
    if (!empty($results)) {
        $header = array_keys($results[0]);
        fputcsv($csvFile, $header, $delimiter);
    }

    // Escrever os dados no arquivo CSV
    foreach ($results as $row) {
        fputcsv($csvFile, $row, $delimiter);
    }

    fclose($csvFile);

    echo "Arquivo CSV gerado e salvo em: $csvFilePath";
}
?>