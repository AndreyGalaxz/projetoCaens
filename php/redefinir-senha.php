<?php
header('Content-Type: text/html; charset=UTF-8');

// Configurações do banco de dados
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

// Obtém o token da URL
$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Token inválido ou não fornecido.");
}

// Verifica se o token existe e é válido
try {
    $stmt = $pdo->prepare("SELECT email, expiracao FROM recuperacao_senha WHERE token = :token");
    $stmt->execute(['token' => $token]);
    $recoveryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recoveryData) {
        die("Token inválido ou expirado.");
    }

    // Verifica se o token expirou
    if (new DateTime() > new DateTime($recoveryData['expiracao'])) {
        die("O token expirou. Solicite uma nova recuperação de senha.");
    }

    // Caso o token seja válido, exibe o formulário de redefinição de senha
} catch (Exception $e) {
    die("Erro ao processar a solicitação.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="path_to_your_css.css">
</head>
<body>
    <div class="form-container">
        <h1>Redefinir Senha</h1>
        <form action="processar-redefinicao.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div>
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" id="nova_senha" name="nova_senha" required>
            </div>
            <div>
                <label for="confirmar_senha">Confirmar Nova Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <button type="submit">Redefinir Senha</button>
        </form>
    </div>
</body>
</html>
