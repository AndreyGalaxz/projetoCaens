<?php
include 'principais_funcoes.php';

if (isset($_GET['id_produto'])) {
    $id_produto = intval($_GET['id_produto']); // Garante que o ID seja um número inteiro

    if (aceitar_produto($id_produto)) {
        echo "<script>alert('Produto aceito com sucesso!'); window.location.href='create_read_home.php';</script>";
    } else {
        echo "<script>alert('Erro ao aceitar o produto!'); window.location.href='create_read_home.php';</script>";
    }
} else {
    echo "<script>alert('ID do produto não fornecido!'); window.location.href='create_read_home.php';</script>";
}
?>