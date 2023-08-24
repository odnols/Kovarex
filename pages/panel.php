<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex</title>
    <link rel="shortcut icon" href="../files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="../js/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../js/slick/slick-theme.css" />

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="../js/slick/slick.min.js"></script>
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
            <h2><a href="licitacoes.php">Licitações</a></h2>
        </div>
    </div>

    <div id="float_menu">
        <a href="#">Perfil</a> <br>
        <a href="pedidos.php">Pedidos</a> <br>
        <a href="#">Configurações</a> <br>
        <a href="../php/session/redireciona_logoff.php">Deslogar</a>
    </div>

    <div id="quadro_pag" class="sombra_quadro"><?php echo $_SESSION["nome"]; ?> </div>
    <div id="quadro_pag" class="sombra_quadro"></div>
    <div id="quadro_pag" class="sombra_quadro"></div>
    <div id="quadro_pag" class="sombra_quadro"></div>
    <div id="quadro_pag" class="sombra_quadro"></div>
</body>

<script type="text/javascript" src="../js/engine.js"></script>

</html>