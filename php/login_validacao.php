<?php
session_start(); 
include 'config.php';

function login($email, $senha) {
    try {
        $conn = conectar();

        $sql = "SELECT nome, email, senha, tipo FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email); 
        $stmt->bindParam(':senha', $senha);
       
        // Executa a consulta
        $stmt->execute();

        // Verifica se encontrou o usuário
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Extrai o resultado como array associativo
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];
            echo "Usuário encontrado!"; 
            header('Location: create_read_home.php');
            exit();   
        } else {
            echo "Email ou senha incorretos!";
        }

        
    } catch (PDOException $e) {
        die("Erro ao realizar login: " . $e->getMessage());
    }
}


?>