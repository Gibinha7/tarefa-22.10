<?php
include 'conexao.php'; // Certifique-se de que a conexão foi estabelecida corretamente

$mensagem = ''; // Inicializa a variável mensagem

// Verifica se a variável $pdo foi definida
if (!isset($pdo)) {
    die("Erro: Conexão com o banco de dados não foi estabelecida.");
}

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = $_POST['departamento_numero'];
    $setor = $_POST['setor'];
    $action = $_POST['action'];

    try {
        if ($action === 'incluir') {
            // Inclusão
            $stmt = $pdo->prepare("INSERT INTO Departamento (departamento_numero, setor) VALUES (:numero, :setor)");
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':setor', $setor);
            $stmt->execute();
            $mensagem = "Departamento incluído com sucesso!";
        } elseif ($action === 'alterar') {
            // Alteração
            $stmt = $pdo->prepare("UPDATE Departamento SET setor = :setor WHERE departamento_numero = :numero");
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':setor', $setor);
            $stmt->execute();
            $mensagem = "Departamento alterado com sucesso!";
        } elseif ($action === 'excluir') {
            // Exclusão
            $stmt = $pdo->prepare("DELETE FROM Departamento WHERE departamento_numero = :numero");
            $stmt->bindParam(':numero', $numero);
            $stmt->execute();
            $mensagem = "Departamento excluído com sucesso!";
        }
    } catch (PDOException $e) {
        $mensagem = "Erro ao processar a solicitação: " . htmlspecialchars($e->getMessage());
    }
}

// Busca os departamentos cadastrados para exibição
$departamentos = [];
try {
    $stmt = $pdo->query("SELECT * FROM Departamento");
    $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mensagem = "Erro ao buscar departamentos: " . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Departamento</title>
    <style>
        /* Seus estilos aqui */
    </style>
</head>
<body>

    <div class="container">
        <h1>Formulário de Departamento</h1>

        <button class="back-button" onclick="window.location.href='formulário HTML.php'">Voltar ao Menu</button>

        <?php if (!empty($mensagem)): ?>
            <div class="message"><?= htmlspecialchars($mensagem); ?></div>
        <?php endif; ?>

        <form id="departamento-form" method="POST">
            <label for="departamento_numero">Número do Departamento:</label>
            <input type="number" id="departamento_numero" name="departamento_numero" required>

            <label for="setor">Setor:</label>
            <input type="text" id="setor" name="setor" maxlength="100" required>

            <div class="button-group">
                <button type="submit" name="action" value="incluir">Incluir</button>
                <button type="submit" name="action" value="alterar">Alterar</button>
                <button type="submit" name="action" value="excluir" class="delete-btn">Excluir</button>
            </div>
        </form>

        <h2>Departamentos Cadastrados</h2>
        <table id="departamento-table">
            <thead>
                <tr>
                    <th>Número do Departamento</th>
                    <th>Setor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departamentos as $departamento): ?>
                    <tr onclick="preencherFormulario(<?= htmlspecialchars($departamento['departamento_numero']); ?>, '<?= htmlspecialchars($departamento['setor']); ?>')">
                        <td><?= htmlspecialchars($departamento['departamento_numero']); ?></td>
                        <td><?= htmlspecialchars($departamento['setor']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function preencherFormulario(numero, setor) {
            document.getElementById('departamento_numero').value = numero;
            document.getElementById('setor').value = setor;
        }
    </script>

</body>
</html>
