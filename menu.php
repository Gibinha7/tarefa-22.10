<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .menu {
            display: flex;
            justify-content: space-around;
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .menu button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function goToPage(page) {
            window.location.href = page;
        }
    </script>
</head>
<body>

<div class="menu">
    <button onclick="goToPage('departamento.php')">Departamento</button>
    <button onclick="goToPage('funcionario.php')">Funcionário</button>
    <button onclick="goToPage('fornecedor.php')">Fornecedor</button>
    <button onclick="goToPage('pecas.php')">Peças</button>
    <button onclick="goToPage('projeto.php')">Projeto</button>
    <button onclick="goToPage('deposito.php')">Depósito</button>
</div>

</body>
</html>
