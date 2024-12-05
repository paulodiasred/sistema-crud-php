<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}
?>
<?php
include 'db_config.php';

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

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Criar Usuário</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <h1>Adicionar Novo Usuário</h1>
    <form method="POST" onsubmit="return validarFormulario()">
        <label>Nome:</label><br>
        <input type="text" name="nome" id="nome" required minlength="3"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" id="telefone" pattern="\d{10,15}" title="Digite um número de telefone válido (apenas números, 10 a 15 dígitos)."><br><br>

        <button type="submit">
            <i class="fas fa-save"></i> Salvar
        </button>
        <a href="index.php">Cancelar</a>
    </form>

    <script>
        function validarFormulario() {
            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefone = document.getElementById('telefone').value.trim();

            if (nome.length < 3) {
                alert('O nome deve ter pelo menos 3 caracteres.');
                return false;
            }

            if (!email.includes('@')) {
                alert('Digite um email válido.');
                return false;
            }

            if (telefone && (telefone.length < 10 || telefone.length > 15 || isNaN(telefone))) {
                alert('Digite um telefone válido com 10 a 15 dígitos.');
                return false;
            }

            return true; // Tudo está válido
        }
    </script>
</body>

</html>