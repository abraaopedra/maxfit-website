<?php
$host = 'localhost';  // O servidor de banco de dados MySQL estará rodando localmente
$dbname = 'fittrack_pro';  // Nome da base de dados que você criou
$username = 'root';  // Usuário padrão do MySQL no XAMPP
$password = '';  // No XAMPP, o usuário 'root' não tem senha por padrão

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>