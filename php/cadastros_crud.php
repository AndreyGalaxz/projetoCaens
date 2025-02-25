<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'lib/vendor/autolad.php';
// require 'vendor/autoload.php';

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
        if($instrucao->rowCount()) {
            
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->CharSet = "UTF-8";
                $mail->isSMTP();
                $mail->Host       = 'smtp.mailtrap.io';
                $mail->SMTPAuth   = true;
                $mail->Username   = '91dda483e52a50';
                $mail->Password   = '28ab83bb47006d';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 2525;

                //Recipients
                $mail->setFrom('cesar@celke.com.br', 'Cesar');
                $mail->addAddress($dados['cademail'], $dados['cadnome']);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Confirma o e-mail';
                $mail->Body    = "Prezado(a) " . $dados['cadnome'] . ".<br><br>Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br> <a href='http://localhost/celke/confirmar-email.php?chave=$chave'>Clique aqui</a><br><br>Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>" ;
                $mail->AltBody = "Prezado(a) " . $dados['cadnome'] . ".\n\nAgradecemos a sua solicitação de cadastramento em nosso site!\n\nPara que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n http://localhost/celke/confirmar-email.php?chave=$chave \n\nEsta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";

                $mail->send();

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso. Necessário acessar a caixa de e-mail para confimar o e-mail!</div>"];

            } catch (Exception $e) {
                //$retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];

                $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso.</div>"];
            }

        } 
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