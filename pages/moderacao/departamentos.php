<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Departamentos</title>
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

            <h2><a href="../itens.php">Itens</a></h2>
            <h2><a href="../pedidos.php">Pedidos</a></h2>
            <h2><a href="../entregas.php">Entregas</a></h2>
            <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="../moderacao.php">Moderação</a></h2> <?php } ?>
        </div>
    </div>

    <div id="quadro_fundo_total">
        <div class="detalhes_fornecedor">

            <?php

            $departamentos = "SELECT * FROM departamento";
            $dados = $conexao->query($departamentos);

            if ($dados->num_rows > 0) { ?>

                <button class="cadastrar_novo" onclick="abrir_popup()"><i class="fa fa-solid fa-plus"></i> Cadastrar um novo</button>

                <br><br>
                <h4>Departamentos</h4>

                <div class="lista_grid">

                    <?php

                    // Listando todos os fornecedores
                    while ($dados_departamento = $dados->fetch_assoc()) {

                        $id = $dados_departamento["id"];
                        $nome = $dados_departamento["nome"];
                        $cor = $dados_departamento["cor_destaque"];

                        echo "<form class='item_departamento' action='../../php/functions/editar_departamento.php' method='POST'>
                                <span class='barra_lateral_cor_destaque' style='background-color: $cor'></span>

                                <h4 class='id_label'>$nome</h4><br>

                                <input name='id_departamento' value='$id' class='invisible'>

                                <button class='btn_editar_dpt'><i class='fa fa-solid fa-pen'></i> Editar departamento</button>
                        </form>";
                    } ?>

                    <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem fornecedores para essa pesquisa...</h2>
                </div>

            <?php } else { ?>

                <h1>Não há nenhum departamento cadastrado ainda...</h1>
                <hr>

                <div class="form_primeira_interacao">
                    <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_departamento.php" method="post">

                        <h3>Cadastre um agora mesmo para começar!</h3>
                        <br>

                        <span>Nome</span><br>
                        <input type="text" class="input" name="input_nome" required maxlength="250">

                        <br><br>
                        <span>Cor de destaque</span><br>
                        <input type="color" class="input" name="input_cor_destaque" required>

                        <br><br>
                        <button class="button_form_cadastro">Cadastrar</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <div class="cadastro_popup">
            <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_departamento.php" method="post">

                <h3>Cadastro de departamento</h3>
                <br>

                <span>Nome</span><br>
                <input type="text" class="input" name="input_nome" required maxlength="250">

                <br><br>
                <span>Cor de destaque</span><br>
                <input type="color" class="input" name="input_cor_destaque" required>

                <br><br>
                <button class="button_form_cadastro">Cadastrar</button> <br><br>
                <button class="button_form_cadastro" onclick="fechar_popup()">Fechar janela</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>