<?php
include 'config.php';
include 'cadastros_crud.php';
// pegando valores do javascript 
if (isset($_GET['valor'])) {
    $tipo_consulta = $_GET['valor'];
    
} else {
    
}



function get_produtos($tipo_consulta) {
    $conn = conectar();
    if($tipo_consulta == 1) {
        $sql = "SELECT id_produto, descricao, dataHora, tipo FROM produtos WHERE tipo = 1";
    } else if($tipo_consulta == 2) {
        $sql = "SELECT id_produto, descricao, dataHora, tipo FROM produtos WHERE tipo = 2";
    } else {
        $sql = "SELECT id_produto, descricao, dataHora, tipo FROM produtos";
    }

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


function aceitar_produto($id_produto)
{
    try {
        $conn = conectar();
        $sql = "UPDATE produtos SET status = 1 WHERE id_produto = :ID_PRODUTO;";
        $instrucao = $conn->prepare($sql);
        $instrucao->bindParam(":ID_PRODUTO", $id_produto);
        $instrucao->execute();
        header('Location: create_read_home.php');
    } catch (PDOException $e) {
        die("Erro ao aceitar produto: " . $e->getMessage());
    }
}
?>
            