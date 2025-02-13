<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro</title>
</head>
<body>
    <?php
    include 'funcoes_produtos.php';

    echo '<h2>Dados no arquivo formulario.php</h2>';

    $descricao = $_POST['descricao'];
    $dataHora = $_POST['dataHora'];
    $tipo = $_POST['tipo'];

    echo 'descricao: '.$descricao.'<br>';
    echo 'dataHora: '.$dataHora.'<br>';
    echo 'tipo: '.$tipo.'<br>'; // tipo 1 == comum tipo 0 == admin
    echo 'email: '.$_SESSION['email'].'<br>';
    
    
    cadastrar_produto($descricao,$dataHora,$tipo, $_SESSION['email']);
    ?>

   
</body>
</html>