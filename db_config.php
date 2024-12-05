<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sistema_crud";

// Cria conexão
$conn = new mysqli($host, $username, $password, $database);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
