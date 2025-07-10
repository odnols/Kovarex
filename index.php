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
</head>

<?php
$foto_user = "/kovarex/files/img/icons/avatar.png";
if (isset($_SESSION["foto"])) $foto_user = $_SESSION["foto"]; ?>

<body>
    <div id="banner_topo">
        <h2 id="titulo">Kovarex</h2>

        <!-- Redirecionando para o empenho com o código informado -->
        <?php if (isset($_GET["empenho"])) {
            $codigo = $_GET["empenho"];
            header("Location: /kovarex/pages/pedidos/consultar_empenho.php?empenho=$codigo");
        } ?>

        <img id="perfil_sm" src="<?php echo $foto_user; ?>" onclick="<?php if (!isset($_SESSION["id_usuario"])) { ?> login()<?php } ?>">
    </div>

    <div id="formulario_login">

        <!-- Formulários de Login -->
        <div id="formularios_lg">

            <h1 style="color: white;">Faça login para continuar</h1>
            <hr id="hr_login">

            <form name="loga" class="logah" action="php/session/usuario_confirmar_login.php" method="post">
                <h2>
                    <input type="text" name="email" required placeholder="E-mail" maxlength="100"><br><br>

                    <input type="password" name="senha" required placeholder="Senha" maxlength="50"><br><br>
                </h2>

                <div class="buttons_login">
                    <a class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: left" onclick="btn_login(1)">Primeiro acesso</a>

                    <button class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: right">Entrar</button>
                </div>
            </form>
        </div>

        <!-- Formulário cadastro -->
        <div id="formularios_cad">

            <h1 style="color: white;">Cadastre-se para começar</h1>
            <hr id="hr_login">

            <form name="cadastra" class="logah" action="php/session/usuario_receber_cadastro.php" method="post">
                <h2>
                    <input type="text" name="nome" required placeholder="Nome" maxlength="100"><br><br>

                    <input type="text" name="email" required placeholder="E-mail" maxlength="100"><br><br>

                    <input type="text" name="cnpj" placeholder="CNPJ" maxlength="100"><br><br>

                    <input type="password" name="senha" required placeholder="Senha" maxlength="50"><br><br>
                </h2>

                <div class="buttons_login">
                    <a class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: left" onclick="btn_login(0)">Voltar para login</a>

                    <button class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: right">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="js/engine.js"></script>

</html>