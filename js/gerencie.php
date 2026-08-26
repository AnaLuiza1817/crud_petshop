<?php
require_once '../infra/conexao.php';

$sqlClientes = "SELECT * FROM clientes ORDER BY nome";
$stmtClientes = $pdo->query($sqlClientes);
$clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);

$sqlAnimais = "SELECT * FROM animais ORDER BY nome";
$stmtAnimais = $pdo->query($sqlAnimais);
$todosAnimais = $stmtAnimais->fetchAll(PDO::FETCH_ASSOC);

$animaisPorCliente = [];
foreach ($todosAnimais as $animal) {
    $animaisPorCliente[$animal['id_cliente']][] = $animal;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento - Pet Shop</title>
</head>

<body>
    <div class="container">
        <div class="topo">
            <h1>Gerenciamento</h1>
            <a href="cadastrar.php" class="link-voltar">+ Novo Cliente</a>
        </div>
        <p class="subtitulo">
            Clientes cadastrados e seus pets
        </p>

        <?php if (empty($clientes)): ?>
            <p class="vazio">Nenhum cliente cadastrado ainda.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Pets</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                            <td><?= !empty($cliente['email']) ? htmlspecialchars($cliente['email']) : '-' ?></td>
                            <td>
                                <?php if (!empty($animaisPorCliente[$cliente['id_cliente']])): ?>
                                    <ul class="lista-pets">
                                        <?php foreach ($animaisPorCliente[$cliente['id_cliente']] as $animal): ?>
                                            <li>
                                                <?= htmlspecialchars($animal['nome']) ?>
                                                (<?= htmlspecialchars($animal['especie']) ?><?php if (!empty($animal['raca'])): ?>, <?= htmlspecialchars($animal['raca']) ?><?php endif; ?>, <?= (int)$animal['idade'] ?> ano(s))
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <span class="sem-pets">Nenhum pet</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;

    display: flex;
    justify-content: center;
    align-items: flex-start;

    min-height: 100vh;
    padding: 40px 20px;
}

.container {
    background-color: white;

    width: 100%;
    max-width: 900px;

    padding: 35px;

    border-radius: 15px;

    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.topo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

h1 {
    margin-bottom: 10px;
}

.subtitulo {
    color: #666;
    margin-bottom: 25px;
}

.link-voltar {
    background-color: #333;
    color: white;

    padding: 10px 18px;

    border-radius: 8px;

    text-decoration: none;
    font-size: 14px;
    font-weight: bold;

    white-space: nowrap;
}

.link-voltar:hover {
    background-color: #555;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #333;
    color: white;
}

th, td {
    text-align: left;
    padding: 12px 14px;
    vertical-align: top;
}

tbody tr {
    border-bottom: 1px solid #eee;
}

tbody tr:hover {
    background-color: #fafafa;
}

.lista-pets {
    list-style: none;
}

.lista-pets li {
    padding: 3px 0;
    font-size: 14px;
    color: #333;
}

.sem-pets {
    color: #999;
    font-style: italic;
    font-size: 14px;
}

.vazio {
    text-align: center;
    color: #999;
    font-style: italic;
    padding: 20px 0;
}

</style>