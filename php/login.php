<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro usuário</title>
</head>
<body>
    <?php
    echo '<h2>Dados no arquivo cadastro_usuario.php</h2>';

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    echo 'email: '.$email.'<br>';
    echo 'senha: '.$senha.'<br>';
    include 'login_validacao.php';

    login($email, $senha);
    
    ?>

   
</body>
</html>