<?php
session_start();
ob_start();

include "login_validacao.php";

$chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);

if (!empty($chave)) {
    $conn = conectar();
    
    // Verifica se a chave é válida
    $query_usuario = "SELECT id, email, senha FROM usuarios WHERE chave = :chave LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
    $result_usuario->execute();

    if ($result_usuario->rowCount() > 0) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);

        // Atualiza o status do usuário e remove a chave
        $query_up_usuario = "UPDATE usuarios SET sits_usuario_id = 1, chave = NULL WHERE id = :id";
        $up_usuario = $conn->prepare($query_up_usuario);
        $up_usuario->bindParam(':id', $id, PDO::PARAM_INT);

        if ($up_usuario->execute()) {
            // Autenticação automática após ativação
            if (login($email, $senha)) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>E-mail confirmado e login realizado.</div>";
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao realizar login.</div>";
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao confirmar o e-mail.</div>";
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Endereço inválido.</div>";
    }
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Endereço inválido.</div>";
}

// Redirecionamento após a verificação
header("Location: create_read_home_user.php");
exit();
