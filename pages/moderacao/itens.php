<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Itens</title>
    <link rel="shortcut icon" href="../../files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<?php session_start();

require_once "../../php/session/verifica_sessao.php";
require_once "../../php/session/conexao_banco.php"; ?>

<body>
    <div id="banner_topo">

        <div id="caixa_entrada">
            <i class="fa fa-solid fa-envelope fa-lg icon_cinza"></i>
            <!-- <i class="fa fa-solid fa-envelope-open-text fa-lg icon_amarelo"></i> -->
        </div>

        <img id="perfil_sm" src="<?php if (isset($_SESSION["foto"])) {
                                        echo $_SESSION["foto"];
                                    } else {
                                        echo "../../files/img/icons/avatar.png";
                                    } ?>">

        <div id="nav_links">
            <h2><a href="../panel.php"><img src="../../files/img/icons/logo.png"></a></h2>

            <h2><a href="../licitacoes.php">Licitações</a></h2>
            <h2><a href="../pedidos.php">Pedidos</a></h2>
            <h2><a href="../autorizacoes.php">Autorizações</a></h2>
            <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="../moderacao.php">Moderação</a></h2> <?php } ?>
        </div>
    </div>

    <div id="quadro_fundo_total" class="cinza_escuro grid_unidades">
        <div class="detalhes_fornecedor">

            <a href="../moderacao.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>
            <br><br>

            <input id="input_filtro_fornecedor" type="text" name="text" class="input" placeholder="Pesquise por um CNPJ, ID ou Razão Social" onkeyup="filtra_fornecedor()">

            <button class="cadastrar_novo" onclick="abrir_popup()"><i class="fa fa-solid fa-plus"></i> Cadastrar um novo</button>
            <br><br>

            <?php
            $dados = $conexao->query("SELECT * FROM item order by id"); ?>

            <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_item.php" method="post">

                <h3>Gerenciar Item</h3>
                <br>

                <span>ID</span><br>
                <input id="input_id_disable" type="text" class="input" name="input_id_item" onfocus="focaliza('input_id_disable')" onfocusout="disable_input()">

                <br><br>
                <span>Nome</span><br>
                <input type="text" class="input" name="input_nome_item" required maxlength="50">

                <br><br>
                <span>Unidade de medida</span><br>
                <select id="input_unidade_medida" type="select" class="input" name="input_unidade_medida" required style="color: black;">
                    <?php

                    $unidades_medida = $conexao->query("SELECT * FROM unidade order by nome");
                    if ($unidades_medida->num_rows > 0) {
                        while ($unidade = $unidades_medida->fetch_assoc()) {

                            $id_unidade = $unidade["id"];
                            $nome_unidade = $unidade["nome"];

                            echo "<option value='$id_unidade'>$nome_unidade</option>";
                        }
                    } ?>
                </select>

                <br><br>
                <span>Tipo de item</span><br>
                <select id="input_tipo_item" type="select" class="input" name="input_tipo_item" required style="color: black;">
                    <?php

                    $unidades_medida = $conexao->query("SELECT * FROM tipo_item order by nome");
                    if ($unidades_medida->num_rows > 0) {
                        while ($unidade = $unidades_medida->fetch_assoc()) {

                            $id_unidade = $unidade["id"];
                            $nome_unidade = $unidade["nome"];

                            echo "<option value='$id_unidade'>$nome_unidade</option>";
                        }
                    } ?>
                </select>

                <br><br><br>
                <button class="button_form_cadastro">Salvar</button> <br><br>
                <button class="button_form_cadastro" onclick="fechar_popup('unidade_item')" type="button">Desfazer alterações</button>
            </form>
        </div>

        <div class="detalhes_fornecedor" style="margin-top: 46px;">

            <?php
            $dados = $conexao->query("SELECT * FROM tipo_item order by id"); ?>

            <br>
            <h4>Prancheta</h4>
            <br>

            <div class="unidade_item">

                <select>
                    <option>A</option>
                </select>
            </div>

            <div class="cadastro_popup tipo_item">
                <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_tipo_item.php" method="post">

                    <h3>Cadastrar Tipo de Item</h3>
                    <br>

                    <br><br>
                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome_tipo_item" required maxlength="50">

                    <br><br>
                    <button class="button_form_cadastro">Cadastrar</button> <br><br>
                    <button class="button_form_cadastro" onclick="fechar_popup('tipo_item')" type="button">Fechar janela</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>