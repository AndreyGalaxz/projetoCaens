<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="../css/defaultStyles.css">
    <link rel="stylesheet" href="../css/home.css">

    <title>Projeto CAENS - FEED</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="../html/home.html"><img src="../src-images/logo_ifba_branco.png" alt="Instituto Federal Bahia"></a>
        </div>

        <nav>
            <button id="todos">TODOS</button>    
            <button id="achados">ACHADOS</button>
            <button id="perdidos">PERDIDOS</button>
            <button id="perdidos">REQUEST</button>
            <form action="../php/logout.php" method="post">
                <a href="#"> <input type="submit" value="LOGOUT" id="logout"> </a>
            </form>
        </nav>



    </header>   

    <main>
        <!-- Formulário de publicação -->
        <section class="post-section">
            <form action="../php/create_formulario.php" method="POST" id="internoBranco">
                <h2>COMPARTILHE AQUI:</h2>
                <input id="descricao" placeholder="Descreva o item perdido..." type="text" name="descricao" required>
                <input type="date" name="dataHora" id="dataHora" required>
                <select name="tipo" id="tipo" required>
                    <option value="1">Achado</option>
                    <option value="2">Perdido</option>
                </select>
                <button class="postButton" type="submit" name="create">ENVIAR</button>
            </form>
        </section>

        <!-- Produtos cadastrados -->
        <section class="produtos-cadastrados">
            <h2 id=titulo_produtos_cadastrados>PRODUTOS</h2>
            <div>
            <table class="container_produtos_home">                                                                                 
                <thead>
                <tr class="linha_produtos_home">
                <th class="item_titulo_home">Código</th>
                <th class="item_titulo_home">Descrição</th>
                <th class="item_titulo_home">Data e Hora</th>
                <th class="item_titulo_home">Tipo</th>
                <th class="item_titulo_home">aceitar</th>
                <th class="item_titulo_home">remover</th>
                </tr>   
                </thead>


                <?php
                session_start();
                include '../php/funcoes_produtos.php';

                $tipo_consulta = $tipo_consulta ?? 3;
                echo 'email usuario:' . htmlspecialchars($_SESSION['email']) . '';
                echo 'nome usuario:' . htmlspecialchars($_SESSION['nome']) . '';
                $result = get_produtos($tipo_consulta);   

                foreach ($result as $linha) {
                $tipoTexto = match ($linha["tipo"]) {
                    1 => 'Achado',
                    2 => 'Perdido',
                    default => 'Desconhecido',
                };
                
                echo '<tr class="linha_produtos_home">';
                echo '<td class="produto_home">' . htmlspecialchars($linha["id_produto"]) . '</td>';
                echo '<td class="produto_home">' . htmlspecialchars($linha["descricao"]) . '</td>';
                echo '<td class="produto_home">' . htmlspecialchars($linha["dataHora"]) . '</td>';
                echo '<td class="produto_home">' . $tipoTexto . '</td>';
                
                echo '<td class="produto_home"><a class="btnAceitar" href="../php/aceitar_produto.php?id_produto=' 
                    . htmlspecialchars($linha["id_produto"]) 
                    . '" onclick="return confirm(\'Tem certeza que deseja aceitar este produto?\');">Aceitar</a></td>';

                echo '<td class="produto_home"><a class="btnExcluir" href="../php/delete_produto.php?id_produto=' 
                    . htmlspecialchars($linha["id_produto"]) 
                    . '" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\');">Excluir</a></td>';
                    /*                                                                                                                                              
                    btnAceitar
                    btnExcluir
                    se o usuário for membro
                    não mostrar os botões de aceitar e excluir                                                       
                    
                    */
                echo '</tr>';
                }   
                ?>
                </div>
            </table>
        </section>
    </main>
    
    <script src="../javascript/home.js"></script>
</body>

</html>
