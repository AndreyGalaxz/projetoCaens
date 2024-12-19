<?php
// Arquivo config.php
function conectar()
{
    try {
        $host = 'localhost';
        $dbname = 'caens';
        $username = 'root'; // Substitua pelo seu usuário do MySQL
        $password = '';     // Substitua pela sua senha do MySQL (geralmente vazia no XAMPP)
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>
