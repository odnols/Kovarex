<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex</title>
    <link rel="shortcut icon" href="files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="js/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="js/slick/slick-theme.css" />

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/engine.js"></script>
</head>

<body>
    <div id="banner_topo">
        <h2 id="titulo"><?php if (isset($_SESSION["nome_user"])) {
                            echo "Olá " + $_SESSION["nome_user"];
                        } else {
                            echo "Kovarex";
                        } ?></h2>

        <img id="perfil_sm" src="<?php if (isset($_SESSION["nome_user"])) {
                                        echo $_SESSION["foto_perfil"];
                                    } else {
                                        echo "files/img/icons/avatar.png";
                                    } ?>" onclick="<?php if (!isset($_SESSION["id_usuario"])) { ?> login()<?php } ?>">
    </div>

    <div id="formulario_login">
        <h1 style="color: white;">Faça login para continuar</h1>
        <hr id="hr_login">

        <!-- Formulários de Login -->
        <div id="formularios_lg">
            <form name="loga" class="logah" action="php/session/usuario_confirmar_login.php" method="post">
                <h2>
                    <input type="text" name="gamertag" required placeholder="ID" maxlength="100"><br><br>

                    <input type="password" name="senha" required placeholder="Senha" maxlength="50"><br><br>
                </h2>

                <div class="buttons_login">
                    <a class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: left">Primeiro acesso</a>

                    <button class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: right">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>