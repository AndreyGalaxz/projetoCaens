<?php 

include 'login_validacao.php';
function cadastrar_usuario($nome, $email, $senha)
{
    try {
        $conn = conectar();
        $sql = "INSERT INTO usuario(nome, email, senha) VALUES (:NOME, :EMAIL, :SENHA)";
        $instrucao = $conn->prepare($sql);

        $instrucao->bindParam(":NOME", $nome);
        $instrucao->bindParam(":EMAIL", $email);
        $instrucao->bindParam(":SENHA", $senha);

        $instrucao->execute();
    } catch (PDOException $e) {
        die("Erro ao cadastrar usuário: " . $e->getMessage());
    }
}


function cadastrar_produto($descricao, $dataHora, $tipo, $email, $imagem)
{
    try {
        $conn = conectar();
        $caminhoImagem = null;
        if (!empty($imagem['name'])) {
            $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
            $extensoesPermitidas = ['jpg', 'jpeg'];

            if (!in_array($extensao, $extensoesPermitidas)) {
                die("Erro: Apenas imagens JPEG são permitidas.");
            }

            // Gerar um nome único para a imagem
            $novoNome = uniqid() . "." . $extensao;
            $caminhoImagem = "../imagens/" . $novoNome;

            // Mover a imagem para o diretório
            if (!move_uploaded_file($imagem["tmp_name"], $caminhoImagem)) {
                die("Erro ao salvar a imagem.");
            }
        }

        // Inserir no banco de dados
        $sql = "INSERT INTO produtos (descricao, dataHora, tipo, email, imagem) 
                VALUES (:DESCRICAO, :DATAHORA, :TIPO, :EMAIL, :IMAGEM)";
        $instrucao = $conn->prepare($sql);
        $instrucao->bindParam(":DESCRICAO", $descricao);
        $instrucao->bindParam(":DATAHORA", $dataHora);
        $instrucao->bindParam(":TIPO", $tipo);
        $instrucao->bindParam(":EMAIL", $email);
        $instrucao->bindParam(":IMAGEM", $caminhoImagem);

        $instrucao->execute();

        // Redirecionamento pós-cadastro
        if ($_SESSION['tipo'] == 1) {
            header('Location: create_read_home_user.php');
        } else {
            header('Location: create_read_home.php');
        }

    } catch (PDOException $e) {
        die("Erro ao cadastrar produto: " . $e->getMessage());
    }
}


?>