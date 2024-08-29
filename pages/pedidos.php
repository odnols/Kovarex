<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Pedidos</title>
    <link rel="shortcut icon" href="../files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<?php session_start();

require_once "../php/session/verifica_sessao.php"; ?>

<body>
    <div id="banner_topo">
        <img id="perfil_sm" src="<?php if (isset($_SESSION["foto"])) {
                                        echo $_SESSION["foto"];
                                    } else {
                                        echo "../files/img/icons/avatar.png";
                                    } ?>">

        <div id="nav_links">
            <h2><a href="panel.php"><img src="../files/img/icons/logo.png"></a></h2>

            <h2><a href="itens.php">Itens</a></h2>
            <h2><a href="pedidos.php">Pedidos</a></h2>
            <h2><a href="entregas.php">Entregas</a></h2>
            <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="moderacao.php">Moderação</a></h2> <?php } ?>
        </div>
    </div>

    <div id="buttons_navegacao_pedidos" class="sombra_quadro">
        <button class="badge button_filtro" onclick="filtra_itens('em_aberto')">Em Aberto</button>
        <button class="badge button_filtro" onclick="filtra_itens('em_andamento')">Em andamento</button>
        <button class="badge button_filtro" onclick="filtra_itens('finalizados')">Finalizados</button>
        <button class="badge button_filtro" onclick="filtra_itens()">Limpar filtro</button>
    </div>

    <div id="quadro_fundo">

        <div class="cabecalho_infos">
            <h3>Tipo do pedido</h3>
            <h3>Última atualização</h3>
            <h3>Status</h3>
        </div>

    </div>
</body>

<script type="text/javascript" src="../js/engine.js"></script>

</html>