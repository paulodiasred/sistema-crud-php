<?php
session_start();

// Lógica de logout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}
?>


<?php
include 'db_config.php'; // Conecta ao banco
$registros_por_pagina = 10; // Alterar se quiser mais ou menos registros por página
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $registros_por_pagina;
// Conta o total de registros no banco de dados
$total_registros_query = $conn->query("SELECT COUNT(*) AS total FROM usuarios");
$total_registros = $total_registros_query->fetch_assoc()['total'];
// Calcula o total de páginas necessárias
$total_paginas = ceil($total_registros / $registros_por_pagina);

$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$sql = "SELECT * FROM usuarios WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' LIMIT $registros_por_pagina OFFSET $offset";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Lista de Usuários</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>

    <h1>Lista de Usuários</h1>
    <a href="create.php" class="btn-create">
        <i class="fas fa-user-plus"></i> Criar Novo Usuário
    </a>

    <div class="logout-container">
        <form method="POST" action="index.php" class="logout-form">
            <button type="submit" name="logout" class="btn-logout">
                Logout
            </button>
        </form>
    </div>

    <form method="GET" action="index.php">
        <input type="text" name="busca" placeholder="Buscar por nome ou email" value="<?= isset($_GET['busca']) ? $_GET['busca'] : '' ?>">
        <button type="submit">Buscar</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['telefone'] ?></td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <a href="index.php?pagina=<?= $i ?>"
                class="<?= $i == $pagina_atual ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</body>

</html>