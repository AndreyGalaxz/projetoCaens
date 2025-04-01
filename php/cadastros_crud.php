<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../lib/vendor/autoload.php';
include 'login_validacao.php';


function cadastrar_usuario($nome, $email, $senha)
{
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    try {
        $conn = conectar();
    
        $sql = "INSERT INTO usuarios (nome, email, senha, chave) VALUES (:nome, :email, :senha, :chave)";
        $instrucao = $conn->prepare($sql);

        $instrucao->bindParam(":nome", $nome);
        $instrucao->bindParam(":email", $email);
        $instrucao->bindParam(":senha", $senha);
        $chave = password_hash($dados['email'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $instrucao->bindParam(':chave', $chave, PDO::PARAM_STR);


        $instrucao->execute();
        if($instrucao->rowCount()) {
            
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                // Looking to send emails in production? Check out our Email API/SMTP product!
                $mail->CharSet = 'UTF-8';
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = 'fe2bb66ef29b77';
                $mail->Password = '3fe63e06c3f396';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                //Recipients
                $mail->setFrom('andreyoliveira.dev@gmail.com', 'Andrey Oliveira');
                $mail->addAddress($dados['email'], $dados['nome']);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Confirma o e-mail';
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';

                $mail->Body    = "Prezado(a) " . $dados['nome'] . ".<br><br>Agradecemos a sua solicitação de cadastramento em nosso site!<br><br>Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br> <a href='http://localhost/projetoCaens/php/confirmar_email.php?chave=$chave'>Clique aqui</a><br><br>Esta mensagem foi enviada a você pela CAENS.<br>Você está recebendo porque está cadastrado no banco de dados de achados e perdidos da CAENS. Nenhum e-mail enviado tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>" ;
                $mail->AltBody = "Prezado(a) " . $dados['nome'] . ".\n\nAgradecemos a sua solicitação de cadastramento em nosso site!\n\nPara que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n http://localhost/projetoCaens/php/confirmar_email.php?chave=$chave \n\nEsta mensagem foi enviada a você pela CAENS.\nVocê está recebendo porque está cadastrado no banco de dados de achados e perdidos da CAENS. Nenhum e-mail enviado tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";

                $mail->send();

                $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso! Confirme o e-mail para liberar o acesso.</div>"];

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