<?php

require_once '../infra/conexao.php';

$mensagem = "";
$idCliente = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomeCliente = $_POST['nome_cliente'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $nomeAnimal = $_POST['nome_animal'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];

    try {

        $pdo->beginTransaction();
        $sqlCliente = "INSERT INTO clientes (nome, telefone, email)
                       VALUES (:nome, :telefone, :email)";

        $stmtCliente = $pdo->prepare($sqlCliente);

        $stmtCliente->execute([
            ':nome' => $nomeCliente,
            ':telefone' => $telefone,
            ':email' => $email
        ]);

        $idCliente = $pdo->lastInsertId();


        // Cadastra o pet
        $sqlAnimal = "INSERT INTO animais
                      (nome, especie, raca, idade, peso, id_cliente)
                      VALUES
                      (:nome, :especie, :raca, :idade, :peso, :id_cliente)";

        $stmtAnimal = $pdo->prepare($sqlAnimal);

        $stmtAnimal->execute([
            ':nome' => $nomeAnimal,
            ':especie' => $especie,
            ':raca' => $raca,
            ':idade' => $idade,
            ':peso' => $peso,
            ':id_cliente' => $idCliente
        ]);

        $pdo->commit();

        $mensagem = "Cliente e pet cadastrados com sucesso!";

    } catch (PDOException $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        $mensagem = "Erro ao cadastrar. Verifique os dados e tente novamente.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Cliente - Pet Shop</title>

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
            align-items: center;
            min-height: 100vh;
            padding: 30px 15px;
        }

        .container {
            background-color: white;
            width: 100%;
            max-width: 500px;
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
            margin-bottom: 10px;
        }

        h1 {
            margin: 0;
            font-size: 22px;
        }

        .subtitulo {
            color: #666;
            margin-bottom: 25px;
        }

        .secao {
            font-size: 15px;
            color: #333;
            margin: 22px 0 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        form .secao:first-of-type {
            margin-top: 0;
            padding-top: 0;
            border-top: none;
        }

        .link-voltar {
            background-color: #333;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .link-voltar:hover {
            background-color: #555;
        }

        .campo {
            margin-bottom: 18px;
        }

        .linha-dupla {
            display: flex;
            gap: 15px;
        }

        .linha-dupla .campo {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #555;
        }

        .botao {
            display: block;
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background-color: #333;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
            text-align: center;
            text-decoration: none;
        }

        .botao:hover {
            background-color: #555;
        }

        .mensagem {
            margin-bottom: 20px;
            padding: 12px;
            background-color: #e8f5e9;
            color: #2e7d32;
            border-radius: 8px;
            text-align: center;
        }

        .botao-atendimento {
            background-color: #2e7d32;
            margin-top: 10px;
        }

        .botao-atendimento:hover {
            background-color: #256628;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="topo">

        <h1>Cadastrar Cliente e Pet</h1>

        <a href="gerencie.php" class="link-voltar">
            Ver Gerenciamento
        </a>

    </div>

    <p class="subtitulo">
        Cadastre o responsável e o animal dele
    </p>


    <?php if (!empty($mensagem)): ?>

        <div class="mensagem">
            <?= htmlspecialchars($mensagem) ?>
        </div>


        <?php if ($idCliente): ?>

            <a
                href="atendimento.php?id_cliente=<?= $idCliente ?>"
                class="botao botao-atendimento"
            >
                Agendar Atendimento
            </a>

        <?php endif; ?>

    <?php endif; ?>


    <form method="POST">

        <h2 class="secao">
            Dados do Responsável
        </h2>


        <div class="campo">

            <label for="nome_cliente">
                Nome *
            </label>

            <input
                type="text"
                id="nome_cliente"
                name="nome_cliente"
                placeholder="Digite o nome do cliente"
                required
            >

        </div>


        <div class="campo">

            <label for="telefone">
                Telefone *
            </label>

            <input
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


        <h2 class="secao">
            Dados do Pet
        </h2>


        <div class="campo">

            <label for="nome_animal">
                Nome do Pet *
            </label>

            <input
                type="text"
                id="nome_animal"
                name="nome_animal"
                placeholder="Digite o nome do pet"
                required
            >

        </div>


        <div class="campo">

            <label for="especie">
                Espécie *
            </label>

            <select
                id="especie"
                name="especie"
                required
            >

                <option value="" disabled selected>
                    Selecione
                </option>

                <option value="Cachorro">
                    Cachorro
                </option>

                <option value="Gato">
                    Gato
                </option>

            </select>

        </div>


        <div class="campo">

            <label for="raca">
                Raça
            </label>

            <input
                type="text"
                id="raca"
                name="raca"
                placeholder="Digite a raça (opcional)"
            >

        </div>


        <div class="linha-dupla">

            <div class="campo">

                <label for="idade">
                    Idade (anos) *
                </label>

                <input
                    type="number"
                    id="idade"
                    name="idade"
                    min="0"
                    placeholder="Ex: 3"
                    required
                >

            </div>


            <div class="campo">

                <label for="peso">
                    Peso (kg) *
                </label>

                <input
                    type="number"
                    id="peso"
                    name="peso"
                    min="0"
                    step="0.1"
                    placeholder="Ex: 8.5"
                    required
                >

            </div>

        </div>


        <button
            type="submit"
            class="botao"
        >
            Cadastrar
        </button>

    </form>

</div>

</body>

</html>