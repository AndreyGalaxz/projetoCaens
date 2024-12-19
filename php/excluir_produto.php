<?php
include 'banco.php';

if (isset($_GET['id_produto'])) {
    $id_produto = intval($_GET['id_produto']); // Garante que o ID seja um número inteiro

    if (excluir_produto($id_produto)) {
        echo "<script>alert('Produto excluído com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o produto!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('ID do produto não fornecido!'); window.location.href='index.php';</script>";
}
?>