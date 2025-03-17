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

    <div id="quadro_fundo_total" class="cinza_escuro grid_unidades">
        <div class="detalhes_fornecedor">

            <a href="../moderacao.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>
            <br><br>

            <?php
            $dados = $conexao->query("SELECT * FROM unidade order by id"); ?>

            <br>
            <h4>Unidades</h4>

            <button class="cadastrar_novo" onclick="abrir_popup('unidade_item')"><i class="fa fa-solid fa-plus"></i> Cadastrar</button>
            <br><br>

            <?php if ($dados->num_rows > 0) { ?>

                <div class="lista_fornecedores">

                    <?php // Listando todos os usuarios
                    while ($dados_unidades = $dados->fetch_assoc()) {

                        $id = $dados_unidades["id"];
                        $nome = $dados_unidades["nome"];
                        $sigla = $dados_unidades["sigla"];

                        $dados_atribuicao = $conexao->query("SELECT * FROM item WHERE id_unidade = $id");
                        $destaque = "";
                        $exclusao = "";

                        if ($dados_atribuicao->num_rows > 0) $destaque = "<div class='label azul'>Há itens vinculados</div>";
                        else {

                            $exclusao = "<button type='button' onclick=\"confirmar_exclusao('unidade', $id)\"><i class='fa fa-solid fa-trash'></i> Excluir</button>";
                            $destaque = "<div class='label'>Nenhum item vinculado</div>";
                        }

                        $nome_min = strtolower($nome);

                        echo "<form class='item_fornecedor $nome_min $id' action='../../php/cache/editar_unidade.php' method='POST'>
                                <span class='label'>$id</span> $nome <br>

                                <div class='label verde'>$sigla</div> $destaque

                                <input name='id_unidade' value='$id' class='invisible'>

                                <button><i class='fa fa-solid fa-pen'></i> Editar</button>
                                $exclusao
                        </form>";
                    } ?>
                </div>

            <?php } else { ?>

                <h3>Não há nenhuma unidade cadastrada ainda...</h3>
                <hr>

            <?php } ?>
        </div>

        <div class="detalhes_fornecedor" style="margin-top: 46px;">

            <?php
            $dados = $conexao->query("SELECT * FROM tipo_item order by id"); ?>

            <br>
            <h4>Tipo de item</h4>

            <button class="cadastrar_novo" onclick="abrir_popup('tipo_item')"><i class="fa fa-solid fa-plus"></i> Cadastrar</button>
            <br><br>

            <?php if ($dados->num_rows > 0) { ?>

                <div class="lista_fornecedores">

                    <?php // Listando todos os usuarios
                    while ($dados_tipo_item = $dados->fetch_assoc()) {

                        $id = $dados_tipo_item["id"];
                        $nome = $dados_tipo_item["nome"];

                        $dados_atribuicao = $conexao->query("SELECT * FROM item WHERE id_tipo_item = $id");
                        $destaque = "";
                        $exclusao = "";

                        if ($dados_atribuicao->num_rows > 0) $destaque = "<div class='label azul'>Há itens vinculados</div>";
                        else {
                            $exclusao = "<button type='button' onclick=\"confirmar_exclusao('tipo_item', $id)\"><i class='fa fa-solid fa-trash'></i> Excluir</button>";
                            $destaque = "<div class='label'>Nenhum item vinculado</div>";
                        }

                        $nome_min = strtolower($nome);

                        echo "<form class='item_fornecedor $nome_min $id' action='../../php/cache/editar_tipo_item.php' method='POST'>
                                <span class='label'>$id</span> $nome <br>

                                $destaque

                                <input name='id_tipo' value='$id' class='invisible'>

                                <button><i class='fa fa-solid fa-pen'></i> Editar</button>
                                $exclusao
                        </form>";
                    } ?>

                    <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem usuários para essa pesquisa...</h2>
                </div>

            <?php } else { ?>

                <h3>Não há nenhum tipo de item cadastrado ainda...</h3>
                <hr>

            <?php } ?>


            <div class="cadastro_popup unidade_item">
                <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_unidade.php" method="post">

                    <h3>Cadastrar unidade</h3>
                    <br>

                    <br><br>
                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome_unidade" required maxlength="50">

                    <br><br>
                    <span>Sigla</span><br>
                    <input type="text" class="input" name="input_sigla_unidade" required maxlength="10">

                    <br><br>
                    <button class="button_form_cadastro">Cadastrar</button> <br><br>
                    <button class="button_form_cadastro" onclick="fechar_popup('unidade_item')" type="button">Fechar janela</button>
                </form>
            </div>

            <div class="cadastro_popup tipo_item">
                <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_tipo_item.php" method="post">

                    <h3>Cadastrar Tipo de Item</h3>
                    <br>

                    <br><br>
                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome_tipo_item" required maxlength="50">

                    <br><br>
                    <button class="button_form_cadastro">Cadastrar</button> <br><br>
                    <button class="button_form_cadastro" onclick="fechar_popup('tipo_item')" type="button">Fechar janela</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>