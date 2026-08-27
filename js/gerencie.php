<?php

require_once '../infra/conexao.php';

try {

    /*
     * Busca os clientes, seus pets e o último atendimento
     * cadastrado para cada cliente.
     */

    $sql = "SELECT
                c.id_cliente,
                c.nome AS nome_cliente,
                c.telefone,
                c.email,

                a.id_animal,
                a.nome AS nome_animal,
                a.especie,
                a.raca,
                a.idade,
                a.peso,

                at.id AS id_atendimento,
                at.procedimento,
                at.data_atendimento,
                at.horario,
                at.observacao,
                at.status

            FROM clientes c

            LEFT JOIN animais a
                ON a.id_cliente = c.id_cliente

            LEFT JOIN atendimentos at
                ON at.id = (
                    SELECT MAX(at2.id)
                    FROM atendimentos at2
                    WHERE at2.id_cliente = c.id_cliente
                )

            ORDER BY c.id_cliente DESC";


    $stmt = $pdo->query($sql);

    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {

    $clientes = [];

    $erro = "Erro ao carregar os clientes.";

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

    <title>Gerenciamento - Pet Shop</title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {

            font-family: Arial, sans-serif;

            background-color: #f5f5f5;

            padding: 30px;

        }


        .container {

            width: 100%;

            max-width: 1300px;

            margin: auto;

            background-color: white;

            padding: 30px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px
                rgba(0, 0, 0, 0.1);

        }


        .topo {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 15px;

            margin-bottom: 25px;

        }


        h1 {

            font-size: 30px;

        }


        .subtitulo {

            color: #666;

            margin-top: 5px;

        }


        .botao {

            background-color: #333;

            color: white;

            padding: 12px 18px;

            border-radius: 8px;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;

            white-space: nowrap;

        }


        .botao:hover {

            background-color: #555;

        }


        .tabela-container {

            overflow-x: auto;

        }


        table {

            width: 100%;

            border-collapse: collapse;

            margin-top: 10px;

        }


        th {

            background-color: #333;

            color: white;

            padding: 14px;

            text-align: left;

            white-space: nowrap;

        }


        td {

            padding: 14px;

            border-bottom: 1px solid #eee;

            vertical-align: middle;

        }


        tr:hover {

            background-color: #fafafa;

        }


        .pet {

            font-size: 14px;

        }


        .pet strong {

            display: block;

            margin-bottom: 4px;

        }


        .pet small {

            color: #666;

        }


        .atendimento {

            font-size: 14px;

        }


        .atendimento strong {

            display: block;

            margin-bottom: 4px;

        }


        .data {

            font-size: 13px;

            color: #555;

        }


        .status {

            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            background-color: #e8f5e9;

            color: #2e7d32;

            font-size: 12px;

            font-weight: bold;

        }


        .sem-atendimento {

            color: #999;

            font-size: 13px;

        }


        .botao-atendimento {

            display: inline-block;

            background-color: #333;

            color: white;

            padding: 8px 12px;

            border-radius: 7px;

            text-decoration: none;

            font-size: 13px;

            font-weight: bold;

        }


        .botao-atendimento:hover {

            background-color: #555;

        }


        .vazio {

            text-align: center;

            padding: 30px;

            color: #777;

        }


        .erro {

            padding: 15px;

            margin-bottom: 20px;

            background-color: #ffebee;

            color: #c62828;

            border-radius: 8px;

            text-align: center;

        }


        @media (max-width: 700px) {

            body {
                padding: 15px;
            }


            .container {
                padding: 20px;
            }


            .topo {

                flex-direction: column;

                align-items: flex-start;

            }

        }

    </style>

</head>


<body>


<div class="container">


    <div class="topo">


        <div>

            <h1>
                Gerenciamento
            </h1>


            <p class="subtitulo">

                Clientes, pets e atendimentos cadastrados

            </p>

        </div>


        <a
            href="cadastrar.php"
            class="botao"
        >

            + Novo Cliente

        </a>


    </div>

    <?php if (!empty($erro)): ?>

        <div class="erro">

            <?= htmlspecialchars($erro) ?>

        </div>

    <?php endif; ?>

    <div class="tabela-container">


        <table>


            <thead>

                <tr>

                    <th>
                        Cliente
                    </th>


                    <th>
                        Telefone
                    </th>


                    <th>
                        E-mail
                    </th>


                    <th>
                        Pet
                    </th>


                    <th>
                        Atendimento
                    </th>


                    <th>
                        Data / Horário
                    </th>


                    <th>
                        Status
                    </th>


                    <th>
                        Ação
                    </th>

                </tr>

            </thead>


            <tbody>


                <?php if (empty($clientes)): ?>


                    <tr>

                        <td
                            colspan="8"
                            class="vazio"
                        >

                            Nenhum cliente cadastrado.

                        </td>

                    </tr>


                <?php else: ?>


                    <?php foreach ($clientes as $cliente): ?>


                        <tr>
                            <td>

                                <?= htmlspecialchars(
                                    $cliente['nome_cliente']
                                ) ?>

                            </td>
                            <td>

                                <?= htmlspecialchars(
                                    $cliente['telefone']
                                ) ?>

                            </td>

                            <td>

                                <?php if (!empty($cliente['email'])): ?>

                                    <?= htmlspecialchars(
                                        $cliente['email']
                                    ) ?>

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>
                            <td>


                                <?php if ($cliente['id_animal']): ?>


                                    <div class="pet">


                                        <strong>

                                            <?= htmlspecialchars(
                                                $cliente['nome_animal']
                                            ) ?>

                                        </strong>


                                        <small>

                                            <?= htmlspecialchars(
                                                $cliente['especie']
                                            ) ?>


                                            <?php if (!empty($cliente['raca'])): ?>

                                                ,
                                                <?= htmlspecialchars(
                                                    $cliente['raca']
                                                ) ?>

                                            <?php endif; ?>


                                            ,
                                            <?= htmlspecialchars(
                                                $cliente['idade']
                                            ) ?>

                                            ano(s)

                                        </small>


                                    </div>


                                <?php else: ?>


                                    <span class="sem-atendimento">

                                        Nenhum pet

                                    </span>


                                <?php endif; ?>


                            </td>
                            <td>


                                <?php if (!empty($cliente['id_atendimento'])): ?>


                                    <div class="atendimento">


                                        <strong>

                                            <?= htmlspecialchars(
                                                $cliente['procedimento']
                                            ) ?>

                                        </strong>


                                        <?php if (!empty($cliente['observacao'])): ?>

                                            <small>

                                                <?= htmlspecialchars(
                                                    $cliente['observacao']
                                                ) ?>

                                            </small>

                                        <?php endif; ?>


                                    </div>


                                <?php else: ?>


                                    <span class="sem-atendimento">

                                        Nenhum atendimento

                                    </span>


                                <?php endif; ?>


                            </td>
                            <td>


                                <?php if (!empty($cliente['data_atendimento'])): ?>


                                    <div class="data">


                                        <?= date(
                                            'd/m/Y',
                                            strtotime(
                                                $cliente['data_atendimento']
                                            )
                                        ) ?>


                                        <br>


                                        <?= date(
                                            'H:i',
                                            strtotime(
                                                $cliente['horario']
                                            )
                                        ) ?>


                                    </div>


                                <?php else: ?>


                                    -

                                <?php endif; ?>


                            </td>
                            <td>


                                <?php if (!empty($cliente['status'])): ?>


                                    <span class="status">

                                        <?= htmlspecialchars(
                                            $cliente['status']
                                        ) ?>

                                    </span>


                                <?php else: ?>


                                    <span class="sem-atendimento">

                                        -

                                    </span>


                                <?php endif; ?>


                            </td>


                            <!-- AÇÃO -->

                            <td>


                                <a
                                    href="atendimento.php?id_cliente=<?= $cliente['id_cliente'] ?>"
                                    class="botao-atendimento"
                                >

                                    + Atendimento

                                </a>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                <?php endif; ?>


            </tbody>


        </table>


    </div>


</div>


</body>

</html>