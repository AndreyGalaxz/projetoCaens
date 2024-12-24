<?php 
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'caens';
$username = 'root';
$password = 'erick270805!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar ao banco de dados']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';

if (empty($email)) {
    http_response_code(400);
    echo json_encode(['error' => 'O campo e-mail é obrigatório']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[\w\.\-]+@ifba\.edu\.br$/', $email)) {
    http_response_code(400);
    echo json_encode(['error' => 'E-mail inválido ou fora do domínio permitido']);
    exit;
}

try {
    $token = bin2hex(random_bytes(16));

    $stmt = $pdo->prepare("
        INSERT INTO recuperacao_senha (email, token, criado_em, expiracao)
        VALUES (:email, :token, NOW(), DATE_ADD(NOW(), INTERVAL 2 HOUR))
        ON DUPLICATE KEY UPDATE token = :token, criado_em = NOW(), expiracao = DATE_ADD(NOW(), INTERVAL 2 HOUR)
    ");
    $stmt->execute(['email' => $email, 'token' => $token]);

    $to = $email;
    $subject = "Recuperação de Senha";
    $message = "Clique no link para redefinir sua senha: http://localhost/projetoCaens/redefinir-senha?token=" . urlencode($token);
    $headers = "From: seu-email@ifba.edu.br\r\n" .
               "Reply-To: seu-email@ifba.edu.br\r\n" .
               "Content-Type: text/plain; charset=UTF-8";

    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo json_encode(['message' => 'E-mail enviado com sucesso']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao enviar o e-mail']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao processar a solicitação', 'details' => $e->getMessage()]);
}
?>