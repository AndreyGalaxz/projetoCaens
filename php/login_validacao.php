<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';

function login($email, $senha) {
    try {
        $conn = conectar();

        // Obtém os dados do usuário pelo email e senha diretamente
        $sql = "SELECT id, nome, email, senha, tipo, sits_usuario_id FROM usuarios WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha); // Senha é comparada diretamente (não recomendado para segurança)
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se o usuário já confirmou o e-mail
            if ($usuario['sits_usuario_id'] != 1) {
                echo "<script>alert('Por favor, confirme seu e-mail antes de fazer login.');</script>";
                return false;
            }

            // Salva informações na sessão
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];

            // Redireciona com base no tipo de usuário
            if ($usuario['tipo'] == 0) {
                header('Location: create_read_home.php');
            } else {
                header('Location: create_read_home_user.php');
            }
            exit();
        } else {
            echo "<script>alert('Email ou senha incorretos!');</script>";
            return false;
        }

    } catch (PDOException $e) {
        die("Erro ao realizar login: " . $e->getMessage());
    }
}
?>
