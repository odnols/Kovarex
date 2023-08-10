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
    <script type="text/javascript" src="../js/engine.js"></script>
</head>

<body>
    <div class="banner_topo">
        <h2 id="titulo"><?php if (isset($_SESSION["nome_user"])) {
                            echo "Olá " + $_SESSION["nome_user"];
                        } ?></h2>

        <img id="perfil_sm" src="<?php if (isset($_SESSION["nome_user"])) {
                                        echo $_SESSION["foto_perfil"];
                                    } else {
                                        echo "../files/img/icons/avatar.png";
                                    } ?>" onclick="<?php if (!isset($_SESSION["id_usuario"])) { ?> login()<?php } ?>">

        <div id="nav_links">
            <h2><a href="panel"><img src="../files/img/icons/logo.png"></a></h2>

            <h2><a href="itens">Itens</a></h2>
            <h2><a href="pedidos">Pedidos</a></h2>
            <h2><a href="licitacoes">Licitações</a></h2>
        </div>
    </div>

    <div id="quadro_pag" class="sombra_quadro"></div>
    <div id="quadro_pag" class="sombra_quadro"></div>
    <div id="quadro_pag" class="sombra_quadro"></div>
    <div id="quadro_pag" class="sombra_quadro"></div>
    <div id="quadro_pag" class="sombra_quadro"></div>
</body>

</html>