<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullName = $_POST['fullName'];

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, full_name) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $fullName]);
        
        $userId = $pdo->lastInsertId();
        $stmt = $pdo->prepare("INSERT INTO user_profiles (user_id) VALUES (?)");
        $stmt->execute([$userId]);

        echo json_encode(['success' => true, 'message' => 'Conta criada com sucesso! Faça login para continuar.']);
    } catch (PDOException $e) {
        $errorMessage = 'Erro ao criar conta. ';
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            $errorMessage .= 'Este email já está cadastrado.';
        } else {
            $errorMessage .= 'Por favor, tente novamente.';
        }
        echo json_encode(['success' => false, 'error' => $errorMessage]);
    }
}
?>