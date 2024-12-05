<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}
?>
<?php
include 'db_config.php'; // Conecta ao banco de dados

// Verifica se o ID foi enviado via URL
if (!isset($_GET['id'])) {
    die("ID do usuário não especificado.");
}

$id = $_GET['id']; // Captura o ID da URL

// Exclui o registro do usuário no banco de dados
$sql = "DELETE FROM usuarios WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Usuário excluído com sucesso!";
    header("Location: index.php"); // Redireciona para a página inicial
    exit;
} else {
    echo "Erro ao excluir o usuário: " . $conn->error;
}
?>
