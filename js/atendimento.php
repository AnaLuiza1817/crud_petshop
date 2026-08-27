<?php
require_once '../infra/conexao.php';

$mensagem = "";
$idCliente = $_GET['id_cliente'] ?? null;

if (!$idCliente) {
    die("Cliente não informado.");
}


$sqlCliente = "SELECT
                    id_cliente,
                    nome,
                    telefone,
                    email
               FROM clientes
               WHERE id_cliente = :id_cliente";

$stmtCliente = $pdo->prepare($sqlCliente);

$stmtCliente->execute([
    ':id_cliente' => $idCliente
]);

$cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);


if (!$cliente) {
    die("Cliente não encontrado.");
}


$sqlAnimais = "SELECT
                    id_animal,
                    nome,
                    especie,
                    raca,
                    idade,
                    peso
               FROM animais
               WHERE id_cliente = :id_cliente
               ORDER BY nome";

$stmtAnimais = $pdo->prepare($sqlAnimais);

$stmtAnimais->execute([
    ':id_cliente' => $idCliente
]);

$animais = $stmtAnimais->fetchAll(PDO::FETCH_ASSOC);




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idAnimal = $_POST['id_animal'] ?? null;
    $procedimento = $_POST['procedimento'] ?? null;
    $dataAtendimento = $_POST['data_atendimento'] ?? null;
    $horario = $_POST['horario'] ?? null;
    $observacao = $_POST['observacao'] ?? null;


    if (
        empty($idAnimal) ||
        empty($procedimento) ||
        empty($dataAtendimento) ||
        empty($horario)
    ) {

        $mensagem = "Preencha todos os campos obrigatórios.";

    } else {

        try {


            $sqlVerificaPet = "SELECT id_animal
                               FROM animais
                               WHERE id_animal = :id_animal
                               AND id_cliente = :id_cliente";

            $stmtVerificaPet = $pdo->prepare($sqlVerificaPet);

            $stmtVerificaPet->execute([
                ':id_animal' => $idAnimal,
                ':id_cliente' => $idCliente
            ]);

            $petExiste = $stmtVerificaPet->fetch(PDO::FETCH_ASSOC);


            if (!$petExiste) {

                $mensagem = "O pet selecionado não pertence a este cliente.";

            } else {

                $sqlAtendimento = "INSERT INTO atendimentos
                                    (
                                        id_cliente,
                                        id_animal,
                                        procedimento,
                                        data_atendimento,
                                        horario,
                                        observacao,
                                        status
                                    )
                                   VALUES
                                    (
                                        :id_cliente,
                                        :id_animal,
                                        :procedimento,
                                        :data_atendimento,
                                        :horario,
                                        :observacao,
                                        'Agendado'
                                    )";

                $stmtAtendimento = $pdo->prepare($sqlAtendimento);

                $stmtAtendimento->execute([
                    ':id_cliente' => $idCliente,
                    ':id_animal' => $idAnimal,
                    ':procedimento' => $procedimento,
                    ':data_atendimento' => $dataAtendimento,
                    ':horario' => $horario,
                    ':observacao' => $observacao
                ]);


                $mensagem = "Atendimento agendado com sucesso!";
            }


        } catch (PDOException $e) {

            $mensagem = "Erro ao agendar o atendimento.";

        }

    }

}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Atendimento - Pet Shop</title>


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

            max-width: 550px;

            padding: 35px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px
                rgba(0, 0, 0, 0.1);

        }


        .topo {

            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            gap: 15px;

            margin-bottom: 8px;

        }


        h1 {

            font-size: 24px;

            color: #222;

        }


        .subtitulo {

            color: #666;

            margin-top: 8px;

            margin-bottom: 25px;

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


        .cliente-info {

            background-color: #f5f5f5;

            padding: 15px;

            border-radius: 10px;

            margin-bottom: 20px;

        }


        .cliente-info strong {

            display: block;

            margin-bottom: 5px;

        }


        .secao {

            font-size: 15px;

            color: #333;

            margin: 22px 0 15px;

            padding-top: 15px;

            border-top: 1px solid #eee;

        }


        .campo {

            margin-bottom: 18px;

        }


        label {

            display: block;

            margin-bottom: 7px;

            font-weight: bold;

            font-size: 14px;

        }


        input,
        select,
        textarea {

            width: 100%;

            padding: 12px;

            border: 1px solid #ccc;

            border-radius: 8px;

            font-size: 15px;

            font-family: inherit;

        }


        textarea {

            resize: vertical;

        }


        input:focus,
        select:focus,
        textarea:focus {

            outline: none;

            border-color: #555;

        }


        .linha-dupla {

            display: flex;

            gap: 15px;

        }


        .linha-dupla .campo {

            flex: 1;

        }


        .botao {

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

        }


        .botao:hover {

            background-color: #555;

        }


        .mensagem {

            margin-bottom: 20px;

            padding: 12px;

            border-radius: 8px;

            text-align: center;

        }


        .mensagem.sucesso {

            background-color: #e8f5e9;

            color: #2e7d32;

        }


        .mensagem.erro {

            background-color: #ffebee;

            color: #c62828;

        }


        .pet-vazio {

            padding: 15px;

            background-color: #fff3cd;

            color: #856404;

            border-radius: 8px;

            margin-bottom: 20px;

        }


        @media (max-width: 600px) {

            .linha-dupla {

                flex-direction: column;

                gap: 0;

            }


            .topo {

                flex-direction: column;

            }


            .link-voltar {

                align-self: flex-start;

            }

        }

    </style>

</head>


<body>


<div class="container">


    <!-- ==================================================
         TOPO
         ================================================== -->

    <div class="topo">

        <div>

            <h1>

                Bem-vinda(o),
                <?= htmlspecialchars($cliente['nome']) ?>!

            </h1>

        </div>


        <a
            href="gerencie.php"
            class="link-voltar"
        >
            Gerenciamento
        </a>

    </div>


    <p class="subtitulo">

        Qual procedimento você deseja ter com seu pet?

    </p>


    <!-- ==================================================
         INFORMAÇÕES DO CLIENTE
         ================================================== -->

    <div class="cliente-info">

        <strong>
            Cliente
        </strong>

        <?= htmlspecialchars($cliente['nome']) ?>

        <br>

        <small>

            Telefone:
            <?= htmlspecialchars($cliente['telefone']) ?>

        </small>

        <?php if (!empty($cliente['email'])): ?>

            <br>

            <small>

                E-mail:
                <?= htmlspecialchars($cliente['email']) ?>

            </small>

        <?php endif; ?>

    </div>


    <!-- ==================================================
         MENSAGEM
         ================================================== -->

    <?php if (!empty($mensagem)): ?>

        <div
            class="mensagem
            <?= strpos($mensagem, 'sucesso') !== false
                ? 'sucesso'
                : 'erro'
            ?>"
        >

            <?= htmlspecialchars($mensagem) ?>

        </div>

    <?php endif; ?>


    <!-- ==================================================
         VERIFICA SE EXISTE PET
         ================================================== -->

    <?php if (empty($animais)): ?>

        <div class="pet-vazio">

            Este cliente ainda não possui nenhum pet cadastrado.

        </div>


    <?php else: ?>


        <!-- ==================================================
             FORMULÁRIO
             ================================================== -->

        <form method="POST">


            <!-- PET -->

            <h2 class="secao">

                Escolha o Pet

            </h2>


            <div class="campo">

                <label for="id_animal">

                    Pet *

                </label>


                <select
                    id="id_animal"
                    name="id_animal"
                    required
                >

                    <option
                        value=""
                        disabled
                        selected
                    >

                        Selecione o pet

                    </option>


                    <?php foreach ($animais as $animal): ?>

                        <option
                            value="<?= $animal['id_animal'] ?>"
                        >

                            <?= htmlspecialchars($animal['nome']) ?>

                            -

                            <?= htmlspecialchars($animal['especie']) ?>

                            <?php if (!empty($animal['raca'])): ?>

                                -
                                <?= htmlspecialchars($animal['raca']) ?>

                            <?php endif; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- PROCEDIMENTO -->

            <h2 class="secao">

                Qual procedimento?

            </h2>


            <div class="campo">

                <label for="procedimento">

                    Procedimento *

                </label>


                <select
                    id="procedimento"
                    name="procedimento"
                    required
                >

                    <option
                        value=""
                        disabled
                        selected
                    >

                        Selecione o procedimento

                    </option>


                    <option value="Banho">

                        Banho

                    </option>


                    <option value="Tosa">

                        Tosa

                    </option>


                    <option value="Creche">

                        Creche

                    </option>


                    <option value="Veterinário">

                        Veterinário

                    </option>


                    <option value="Farmácia">

                        Farmácia

                    </option>


                    <option value="Hotel">

                        Hotel

                    </option>

                </select>

            </div>


            <!-- DATA E HORÁRIO -->

            <div class="linha-dupla">


                <div class="campo">

                    <label for="data_atendimento">

                        Data *

                    </label>


                    <input
                        type="date"
                        id="data_atendimento"
                        name="data_atendimento"
                        required
                    >

                </div>


                <div class="campo">

                    <label for="horario">

                        Horário *

                    </label>


                    <input
                        type="time"
                        id="horario"
                        name="horario"
                        required
                    >

                </div>


            </div>


            <!-- OBSERVAÇÃO -->

            <div class="campo">

                <label for="observacao">

                    Observação

                </label>


                <textarea
                    id="observacao"
                    name="observacao"
                    rows="4"
                    placeholder="Alguma informação importante sobre o atendimento?"
                ></textarea>

            </div>


            <!-- BOTÃO -->

            <button
                type="submit"
                class="botao"
            >

                Agendar Atendimento

            </button>


        </form>


    <?php endif; ?>


</div>


</body>

</html>