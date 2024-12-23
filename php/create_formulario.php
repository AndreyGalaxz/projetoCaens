<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro</title>
</head>
<body>

   <?php
   

   echo '<h2>Dados no arquivo formulario.php</h2>';

   $descricao = $_POST['descricao'];
   $dataHora = $_POST['dataHora'];

   echo 'descricao: '.$descricao.'<br>';
   echo 'dataHora: '.$dataHora.'<br>';
   include 'principais_funcoes.php';
   cadastrar_produto($descricao,$dataHora);
   ?>

   
</body>
</html>