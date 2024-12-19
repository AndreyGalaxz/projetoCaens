<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/defaultStyles.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/home.css">

    <title>Projeto CAENS - Produtos</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../html/home.html">
                <img src="../src-images/logo_ifba_branco.png" alt="Instituto Federal Bahia">
            </a>
        </div>
        <nav>
            <a href="../html/meusAchados.html">MEUS ACHADOS</a>
            <a href="../html/meusPerdidos.html">MEUS PERDIDOS</a>
            <input id="pesquisar" type="text" placeholder="PESQUISAR...">
            <a href="#" id="openPopup">  
                <div class="icon" id="filter">
                    <svg width="44" height="45" viewBox="0 0 44 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40.3332 5.625H3.6665L18.3332 23.3625V35.625L25.6665 39.375V23.3625L40.3332 5.625Z" 
                              stroke="#F2E8CF" 
                              stroke-width="4" 
                              stroke-linecap="round" 
                              stroke-linejoin="round"/>
                    </svg> 
                </div>
            </a>    
        </nav>
        <a href="../requestsModerador.html" class="requests">REQUESTS</a>
    </header>
    
    <main>
        <section class="post-section">
            <form action="../php/formulario.php" method="POST" id="internoBranco">
                <h2>COMPARTILHE AQUI:</h2>
                <input id="descricao" placeholder="Descreva o item perdido..." type="text" name="descricao" required>
                <input type="date" name="dataHora" id="dataHora" required>
                <button class="postButton" type="submit" name="create">ENVIAR</button>
            </form>
        </section>

        <section class="produtos-cadastrados">
            <h2>Produtos Cadastrados</h2>
            <div>
                <?php
                include '../php/banco.php';

                // Função para obter os produtos cadastrados
                $result = get_produtos();

                echo '<table>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Descrição</th>';
                echo '<th>Data e Hora</th>';
                echo "<th colspan='2' style='text-align: center'>Ações</th>";
                echo '</tr>';

                foreach ($result as $linha) {
                    echo '<tr>';
                    echo '<td>' . $linha["id_produto"] . '</td>';
                    echo '<td>' . $linha["descricao"] . '</td>';
                    echo '<td>' . $linha["dataHora"] . '</td>';

                    $id = $linha["id_produto"];

                    echo '<td><a class="btnExcluir" href="../php/excluir_produto.php?id_produto=' . $id . '" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\');">Excluir</a></td>';
                    echo '</tr>';
                }
                
                echo '</table>';
                ?>
            </div>
        </section>
    </main>

    <script src="../javascript/home.js"></script>
</body>
</html>
