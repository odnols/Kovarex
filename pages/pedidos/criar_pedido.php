<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Criando um pedido</title>
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

    <div id="quadro_fundo_total" class="cinza_escuro">

        <a href="../panel.php" class="btn_voltar_pedidos"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

        <div id="buttons_navegacao_index">

            <div class="quadro_pag pilula_l sombra_quadro">

                <h3><i class="fa fa-solid fa-plus"></i> Gerar um novo</h3>
                <hr>
                <p>Crie um novo pedido do zero.</p>

                <br>
                <a href="./prancheta_pedido.php" class="button_add_pedido cinza large_button">Iniciar um novo ></a>
            </div>

            <div class="quadro_pag pilula_r sombra_quadro">

                <h3><i class="fa fa-solid fa-clock"></i> Usar um anterior como base</h3>
                <hr>
                <p>Selecione um pedido anterior e comece a partir dele.</p>

                <br>
                <a href="../pedidos.php" class="button_add_pedido cinza large_button">Escolher pedido ></a>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>