<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro</title>
</head>
<body>
<?php
include '../php/funcoes_produtos.php';


echo '<h2>Dados no arquivo formulario.php</h2>';

$descricao = $_POST['descricao'];
$dataHora = $_POST['dataHora'];
$tipo = $_POST['tipo'];
$email = $_SESSION['email']; // Pega o e-mail do usuário logado
$imagem = $_FILES['imagem']; // Obtém o arquivo enviado

echo 'descricao: ' . $descricao . '<br>';
echo 'dataHora: ' . $dataHora . '<br>';
echo 'tipo: ' . $tipo . '<br>'; // tipo 1 == comum, tipo 0 == admin
echo 'email: ' . $email . '<br>';
echo 'Imagem recebida: ' . $imagem['name'] . '<br>';

cadastrar_produto($descricao, $dataHora, $tipo, $email, $imagem);
?>

    

   
</body>
</html>