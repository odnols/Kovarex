<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Página inicial</title>
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

$id_user = $_SESSION["id"];

require_once "../php/session/verifica_sessao.php";
require_once "../php/session/conexao_banco.php";

// Verificando as atribuições de departamentos que o usuário possui
$status_usuario = "SELECT * FROM atribuicao WHERE id_usuario = $id_user";
$atribuicoes = $conexao->query($status_usuario);

?>

<body>
    <div id="banner_topo">

        <div id="caixa_entrada">
            <i class="fa fa-solid fa-envelope fa-lg icon_cinza"></i>
            <!-- <i class="fa fa-solid fa-envelope-open-text fa-lg icon_amarelo"></i> -->
        </div>

        <img id="perfil_sm" src="<?php if (isset($_SESSION["foto"])) {
                                        echo $_SESSION["foto"];
                                    } else {
                                        echo "../files/img/icons/avatar.png";
                                    } ?>">

        <div id="nav_links">
            <h2><a href="panel.php"><img src="../files/img/icons/logo.png"></a></h2>

            <?php if ($atribuicoes->num_rows > 0) { ?>
                <h2><a href="itens.php">Itens</a></h2>
                <h2><a href="pedidos.php">Pedidos</a></h2>
                <h2><a href="entregas.php">Entregas</a></h2>
                <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="moderacao.php">Moderação</a></h2> <?php } ?>
            <?php } ?>
        </div>
    </div>

    <div id="float_menu">

        <?php if ($atribuicoes->num_rows > 0) { ?>
            <a href="#">Perfil</a> <br>
            <a href="pedidos.php">Pedidos</a> <br>
            <a href="#">Configurações</a> <br>
        <?php } ?>

        <a href="../php/session/redireciona_logoff.php">Deslogar</a>
    </div>

    <div id="conteudo_pag">

        <?php if ($atribuicoes->num_rows > 0) { ?>

            <div id="buttons_navegacao_index">
                <div class="quadro_pag sombra_quadro">
                    <h3>Boas vindas ao Kovarex!</h3>
                    <hr>
                    <p>Crie pedidos e acompanhe o status de entregas de forma rápida.</p>

                    <br>
                    <a href="itens.php" class="button_add_pedido cinza large_button">Criar um novo pedido ></a>
                </div>

                <div class="quadro_pag sombra_quadro">

                    <?php

                    $pedidos = "SELECT * FROM pedido WHERE id_autor = $id_user order by id desc limit 5";
                    $resultado = $conexao->query($pedidos);

                    if ($resultado->num_rows > 0) {
                    } else
                        echo "<h3>Você ainda não tem pedidos para acompanhar...</h3>"; ?>
                </div>
            </div>

        <?php } else { ?>

            <div id="buttons_navegacao_aprovacao">
                <div class="quadro_pag sombra_quadro">
                    <h3>Boas vindas ao Kovarex!</h3>
                    <hr>
                    <p>Sua conta foi enviada para aprovação... Logo iremos liberar todas<br>as funcionalidades para utilização!<br><br>Uma notificação será enviada ao envelope localizado no canto superior direito.</p>
                </div>
            </div>

        <?php } ?>
    </div>
</body>

<script type="text/javascript" src="../js/engine.js"></script>

</html>