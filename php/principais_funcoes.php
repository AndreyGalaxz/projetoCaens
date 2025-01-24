<?php
include 'config.php';

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

function get_produtos() {
    $conn = conectar();
    $sql = "SELECT id_produto, descricao, dataHora, tipo FROM produtos";

    try {
        $stmt = $conn->query($sql);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém os dados como um array associativo
        return $produtos;
    } catch (PDOException $e) {
        die("Erro na consulta: " . $e->getMessage());
    } finally {
        // Encerrar a conexão explicitamente é opcional, o PDO gerencia isso automaticamente.
        $conn = null;
    }
}

function excluir_produto($id_produto)
{
    try {
        $conn = conectar();
        $sql = "DELETE FROM produtos WHERE id_produto = :ID_PRODUTO";
        $instrucao = $conn->prepare($sql);
        $instrucao->bindParam(":ID_PRODUTO", $id_produto);
        $instrucao->execute();
        header('Location: create_read_home.php');
    } catch (PDOException $e) {
        die("Erro ao excluir produto: " . $e->getMessage());
    }
}
?>
            