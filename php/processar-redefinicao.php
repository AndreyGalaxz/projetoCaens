<?php
$host = 'localhost';
$dbname = 'caens';
$username = 'root';
$password = 'erick270805!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados.");
}

$token = $_POST['token'] ?? '';
$novaSenha = $_POST['nova_senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

if (empty($token) || empty($novaSenha) || empty($confirmarSenha)) {
    die("Todos os campos são obrigatórios.");
}

if ($novaSenha !== $confirmarSenha) {
    die("As senhas não coincidem.");
}

try {
    $stmt = $pdo->prepare("SELECT email FROM recuperacao_senha WHERE token = :token");
    $stmt->execute(['token' => $token]);
    $recoveryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recoveryData) {
        die("Token inválido.");
    }

    $email = $recoveryData['email'];

    // Atualiza a senha do usuário
    $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
    $stmt->execute(['senha' => $novaSenhaHash, 'email' => $email]);

    // Remove o token da tabela
    $stmt = $pdo->prepare("DELETE FROM recuperacao_senha WHERE token = :token");
    $stmt->execute(['token' => $token]);

    echo "Senha redefinida com sucesso.";
} catch (Exception $e) {
    die("Erro ao redefinir a senha.");
}
?>
