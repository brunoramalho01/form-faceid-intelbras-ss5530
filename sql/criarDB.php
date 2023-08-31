<?php

// Arquivo: nome_arquivo.db
$db = new SQLite3('../data/usuarios.db');

$query = "CREATE TABLE usuarios (
        uuid INTEGER PRIMARY KEY AUTOINCREMENT,
        Nome_Usuario TEXT,
        Cartao TEXT,
        Tag_uhf TEXT,
        Senha TEXT,
        Controle_remoto TEXT,
        E_mail TEXT,
        RG TEXT,
        CPF TEXT,
        Telefone_celular TEXT,
        Matricula TEXT,
        Estado TEXT,
        Data_inicial_Validade TEXT,
        Data_Final_Validade TEXT,
        Observacoes TEXT,
        Tipo_Usuario TEXT,
        num_digital TEXT,
        Biometria TEXT,
        Foto TEXT,
        modelo_digital TEXT,
        Origem TEXT,
        Cartao_quantidade_bits TEXT,
        Tag_uhf_quantidade_bits TEXT,
        Data_nascimento TEXT,
        Palestra TEXT
    )";

$db->exec($query);
$db->close();

?>