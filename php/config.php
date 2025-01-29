<?php
// Arquivo config.php
function conectar()
{
    try {
        $host = 'localhost';
        $dbname = 'caens';
        $username = 'root';
        $password = '';     
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;

        
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>
