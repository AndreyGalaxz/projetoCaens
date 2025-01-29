<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro usuário</title>
</head>
<body>
    <?php
    echo '<h2>Dados no arquivo cadastro_usuario.php</h2>';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];



    echo 'nome: '.$nome.'<br>';
    echo 'email: '.$email.'<br>';
    echo 'senha: '.$senha.'<br>';
    include 'cadastros_crud.php';



    cadastrar_usuario($nome,$email,$senha);
    ?>

   
</body>
</html>