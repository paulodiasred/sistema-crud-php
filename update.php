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

// Busca os dados do usuário no banco de dados
$result = $conn->query("SELECT * FROM usuarios WHERE id = $id");
if ($result->num_rows == 0) {
    die("Usuário não encontrado.");
}

$usuario = $result->fetch_assoc(); // Obtém os dados do usuário como um array associativo

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    // Validações no servidor
    if (strlen($nome) < 3) {
        die("O nome deve ter pelo menos 3 caracteres.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido.");
    }

    if (!empty($telefone) && (!is_numeric($telefone) || strlen($telefone) < 10 || strlen($telefone) > 15)) {
        die("Telefone inválido. Deve conter entre 10 e 15 dígitos.");
    }

    // Atualiza os dados no banco
    $sql = "UPDATE usuarios SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Usuário</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <h1>Editar Usuário</h1>
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= $usuario['nome'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $usuario['email'] ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= $usuario['telefone'] ?>"><br><br>

        <button type="submit">
            <i class="fas fa-save"></i> Salvar Alterações
        </button>

        <a href="index.php">Cancelar</a>
    </form>
</body>

</html>