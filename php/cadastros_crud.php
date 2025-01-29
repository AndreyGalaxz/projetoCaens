<?php 
include 'config.php';
function cadastrar_usuario($nome, $email, $senha)
{
    try {
        $conn = conectar();
        $sql = "INSERT INTO usuario(nome, email, senha) VALUES (:NOME, :EMAIL, :SENHA)";
        $instrucao = $conn->prepare($sql);

        $instrucao->bindParam(":NOME", $nome);
        $instrucao->bindParam(":EMAIL", $email);
        $instrucao->bindParam(":SENHA", $senha);

        $instrucao->execute();
        header('Location: create_read_home.php');
    } catch (PDOException $e) {
        die("Erro ao cadastrar usuário: " . $e->getMessage());
    }
}


function cadastrar_produto($descricao, $dataHora, $tipo)
{
    try {
        $conn = conectar();
        $sql = "INSERT INTO produtos(descricao, dataHora, tipo) VALUES (:DESCRICAO, :DATAHORA, :TIPO)";
        $instrucao = $conn->prepare($sql);
        $instrucao->bindParam(":DESCRICAO", $descricao);
        $instrucao->bindParam(":DATAHORA", $dataHora);
        $instrucao->bindParam(":TIPO", $tipo);
        $instrucao->execute();
        header('Location: create_read_home.php');
    } catch (PDOException $e) {
        die("Erro ao cadastrar produto: " . $e->getMessage());
    }
}

?>