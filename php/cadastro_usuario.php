<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>
    <link rel="stylesheet" href="../css/cadastro_usuario.css">
</head>
<body>
    <div class="container">
        <?php
        echo '<h2>Dados do Cadastro</h2>';

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];       

        echo '<p><strong>Nome:</strong> ' . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>';

        include 'cadastros_crud.php';
        
        cadastrar_usuario($nome, $email, $senha);
        echo '<p class="verificacao">Verifique o e-mail para ativar a conta.</p>';
        ?>
    </div>
</body>
</html>
