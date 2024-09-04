<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Alterar senha</title>
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

$id_user = $_SESSION["id"];

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

?>

<body>
    <div id="banner_topo">

        <h2 id="titulo">Kovarex</h2>

        <div id="caixa_entrada">
            <i class="fa fa-solid fa-envelope fa-lg icon_cinza"></i>
            <!-- <i class="fa fa-solid fa-envelope-open-text fa-lg icon_amarelo"></i> -->
        </div>

        <img id="perfil_sm" src="<?php if (isset($_SESSION["foto"])) {
                                        echo $_SESSION["foto"];
                                    } else {
                                        echo "../../files/img/icons/avatar.png";
                                    } ?>">
    </div>

    <div id="formulario_login">
        <div id="formularios_lg">
            <form name="loga" class="logah" action="../functions/usuario_alterar_senha.php" method="post">
                <h2><input type="password" name="senha" required placeholder="Insira a nova senha" maxlength="50"></h2>

                <h2><input type="password" required placeholder="Repita a senha" maxlength="50"></h2>

                <br><br>

                <div class="buttons_login">
                    <button class="btn btn-custom btn-lg page-scroll configura_perfil">Alterar senha</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>