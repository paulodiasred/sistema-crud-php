<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: index.php");
    exit;
}

include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepara a consulta para evitar injeção de SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Define $admin mesmo que o resultado seja vazio
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
    } else {
        $admin = null;
    }

    // Verifica as credenciais
    if (!is_null($admin) && password_verify($password, $admin['password'])) {
        $_SESSION['logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="login-page">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Usuário:</label>
        <input type="text" name="username" value="admin" required>
        <label>Senha:</label>
        <input type="password" name="password" value="admin" required>
        <button type="submit">Entrar</button>
    </form>
</body>

</html>