<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/defaultStyles.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/user.css">
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
    <div class="feed-admin"> <!-- Container do feed -->

        <?php
        $tipo_consulta = $tipo_consulta ?? 3;
        $result = get_produtos($tipo_consulta);

        foreach ($result as $linha) {
            $tipoTexto = $linha["tipo"] == 1 ? 'Achado' : 'Perdido';
            $imagem = !empty($linha["imagem"]) ? htmlspecialchars($linha["imagem"]) : "placeholder.jpg";  
            
            echo '<div class="post-admin">';
            echo '  <div class="post-content-admin">';
            echo '      <img src="' . $imagem . '" alt="Imagem do produto" class="produto-imagem">';
            echo '      <div class="post-info-admin">';
            echo '          <p><strong>Descrição:</strong> ' . htmlspecialchars($linha["descricao"]) . '</p>';
            echo '          <p><strong>Data e Hora:</strong> ' . htmlspecialchars($linha["dataHora"]) . '</p>';
            echo '          <p class="tipo-item-admin"><strong>Tipo:</strong> ' . $tipoTexto . '</p>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }
        ?>
    </div>
</section>

    </main>
    <script src="../javascript/home.js"></script>
</body>
</html>