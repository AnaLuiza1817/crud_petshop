<?php
require_once "../config/conexao.php";

$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $telefone = trim($_POST["telefone"]);
    $email = trim($_POST["email"]);

    if (empty($nome) || empty($telefone)) {
        $mensagem = "Preencha os campos obrigatórios.";
    } else {
        try {
            $sql = "INSERT INTO clientes (nome, telefone, email)
                    VALUES (:nome, :telefone, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":nome" => $nome,
                ":telefone" => $telefone,
                ":email" => $email
            ]);
            $mensagem = "Cliente cadastrado com sucesso!";
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar cliente.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente - AUmigos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">

        <h1>Cadastrar Cliente</h1>
        <p class="subtitulo">
            Cadastre o responsável pelo animal
        </p>
        <?php if (!empty($mensagem)): ?>
            <div class="mensagem">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="campo">
                <label for="nome">
                    Nome *
                </label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Digite o nome do cliente"
                    required
                >

            </div>
            <div class="campo">
                <label for="telefone">
                    Telefone *
                </label>
                <input>
                    type="text"
                    id="telefone"
                    name="telefone"
                    placeholder="(47) 99999-9999"
                    required
                >

            </div>
            <div class="campo">

                <label for="email">
                    E-mail
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="cliente@email.com"
                >
            </div>
            <button
                type="submit"
                class="botao"
            >
                Cadastrar Cliente
            </button>
        </form>
    </div>
</body>
</html>