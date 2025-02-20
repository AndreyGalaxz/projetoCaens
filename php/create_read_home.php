<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/defaultStyles.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Projeto CAENS - FEED</title>
	
    <script type="text/javascript">
        function previewFoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('foto-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
	
</head>
<body>
    <header>
        <div class="logo">
            <a href="#"><img src="../src-images/logo_ifba_branco.png" alt="Instituto Federal Bahia"></a>
        </div>
        <nav>
            <button id="todos">TODOS</button>
            <button id="achados">ACHADOS</button>
            <button id="perdidos">PERDIDOS</button>
            <button id="request">REQUEST</button>
            <form action="../php/logout.php" method="post">
                <input type="submit" value="LOGOUT" id="logout">
            </form>
            <div class="user-info">
                <i class="fas fa-user"></i>
                <span>
                    <?php
                        session_start();
                        include '../php/funcoes_produtos.php';
                        echo 'Nome do usuário: ' . htmlspecialchars($_SESSION['nome']);
                    ?>
                </span>
            </div>
        </nav>
    </header>
    <main>
        <section class="post-section">
            <form action="../php/create_formulario.php" method="POST" enctype="multipart/form-data">
                <h2>COMPARTILHE AQUI:</h2>
                <input id="descricao" placeholder="Descreva o item perdido..." type="text" name="descricao" required>
                <input type="date" name="dataHora" id="dataHora" required>
                <select name="tipo" id="tipo" required>
                    <option value="1">Achado</option>
                    <option value="2">Perdido</option>
                </select>
                <label for="foto">Foto do Item:</label>
				
                <input type="file" id="foto" name="imagem" accept="image/jpg" onchange="previewFoto(event)" required>
				
                <img id="foto-preview" src="" alt="Prévia da Foto" width="100" style="display:none;">
				
                <button class="postButton" type="submit" name="create">ENVIAR</button>
            </form>
        </section>
        <section class="produtos-cadastrados">
            <h2 id="titulo_produtos_cadastrados">PRODUTOS</h2>
            <table class="container_produtos_home">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Data e Hora</th>
                        <th>Tipo</th>
                        <th>Aceitar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tipo_consulta = $tipo_consulta ?? 3;
                    $result = get_produtos($tipo_consulta);
                    foreach ($result as $linha) {
                        $tipoTexto = $linha["tipo"] == 1 ? 'Achado' : 'Perdido';
                        echo '<tr>';
                        echo '<td><img src="' . htmlspecialchars($linha["imagem"]) . '" width="100"></td>';
                        echo '<td>' . htmlspecialchars($linha["id_produto"]) . '</td>';
                        echo '<td>' . htmlspecialchars($linha["descricao"]) . '</td>';
                        echo '<td>' . htmlspecialchars($linha["dataHora"]) . '</td>';
                        echo '<td>' . $tipoTexto . '</td>';
                        echo '<td><a class="btnAceitar" href="../php/aceitar_produto.php?id_produto=' . htmlspecialchars($linha["id_produto"]) . '" onclick="return confirm(\'Tem certeza que deseja aceitar este produto?\');">Aceitar</a></td>';
                        echo '<td><a class="btnExcluir" href="../php/delete_produto.php?id_produto=' . htmlspecialchars($linha["id_produto"]) . '" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\');">Excluir</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <script src="../javascript/home.js"></script>
</body>
</html>