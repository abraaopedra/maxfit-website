<?php
require_once 'db_config.php';

    try {
        $stmt = $pdo->query("SELECT DATABASE()");
        $dbName = $stmt->fetchColumn();
        echo "Conectado com sucesso à base de dados: " . $dbName;
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
?>