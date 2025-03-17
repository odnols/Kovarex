<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Unidades</title>
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

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php"; ?>

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
            <h2><a href="../../pages/panel.php"><img src="../../files/img/icons/logo.png"></a></h2>

            <h2><a href="../../pages/licitacoes.php">Licitações</a></h2>
            <h2><a href="../../pages/pedidos.php">Pedidos</a></h2>
            <h2><a href="../../pages/autorizacoes.php">Autorizações</a></h2>
            <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="../../pages/moderacao.php">Moderação</a></h2> <?php } ?>
        </div>
    </div>

    <div id="quadro_fundo_total" class="cinza_escuro">
        <div class="detalhes_fornecedor">

            <?php

            $id_tipo = $_POST["id_tipo"];
            $dados = $conexao->query("SELECT * FROM tipo_item WHERE id = $id_tipo");

            // Coletando os dados do tipo de item para edição
            $dados_unidade = $dados->fetch_assoc();

            $nome = $dados_unidade["nome"]; ?>

            <a href="../../pages/moderacao/unidades.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando o Tipo de Item</h2>

            <div class="lista_fornecedores">
                <form id="cadastro_fornecedor" action="../functions/atualizar_tipo_item.php" method="post">

                    <h3>Atualize os dados do tipo de item abaixo</h3>
                    <br>

                    <input type="text" class="input invisible" name="input_id" value="<?php echo $id_tipo ?>">

                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome" required maxlength="50" value="<?php echo $nome ?>">
            </div>

            <br><br>
            <button class="button_form_cadastro">Atualizar</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>