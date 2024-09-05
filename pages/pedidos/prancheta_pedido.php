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

    <div id="quadro_fundo_total">

        <a href="./criar_pedido.php" class="btn_voltar_pedidos"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

        <div id="buttons_navegacao_index">

            <div class="quadro_pag pilula_l sombra_quadro">

                <h3><i class="fa fa-solid fa-plus"></i> Selecione o tipo do pedido</h3>
                <hr>
                <p>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</p>

                <select id="filtro_tipo_item_pedido" onchange="filtra_fornecedor(true)">
                    <option value="generos_alimenticios">Gêneros Alimentícios</option>
                    <option value="materiais_de_limpeza">Materiais de limpeza</option>
                    <option value="materiais_de_escritorio">Materiais de escritório</option>
                    <option value="medicamentos">Medicamentos</option>
                </select>

                <br><br>

                <fieldset id="lista_itens_pedido">

                    <input id="input_filtro_fornecedor" type="text" name="text" class="input" style="width: 100%;" placeholder="Pesquise por um item" onkeyup="filtra_fornecedor()">

                    <br><br>

                    <div class="item_selecionar_lista_pedido">
                        <span>Item</span>
                        <span>Descrição</span>
                        <span>Expiração</span>
                        <span>Saldo</span>
                        <span>Solicitar</span>
                    </div>

                    <div class="lista_grid_selecionar_item">

                        <div class="item_selecionar_lista_pedido item_fornecedor generos_alimenticios">
                            <span>Arroz</span>
                            <span>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</span>
                            <span class="label">09/10/2025</span>
                            <span>10 / 900</span>
                            <input class="quantidade_item" name="quantidade_item" required placeholder="Quantidade">
                            <button class="btn_gerenciar_item_pedido"><i class="fa fa-solid fa-plus"></i></button>
                        </div>
                    </div>

                    <h3 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem itens para essa pesquisa...</h3>
                </fieldset>
            </div>

            <div class="quadro_pag pilula_r sombra_quadro">

                <button style="float: right;">Confirmar pedido <i class="fa fa-solid fa-caret-right"></i></button>

                <h3><i class="fa fa-solid fa-cart-arrow-down"></i> Resumo do pedido</h3>
                <hr>
                <p>Defina as quantidades de cada item abaixo.</p>

                <br>

                <fieldset id="lista_itens_pedido">

                    <div class="item_selecionar_lista_pedido">
                        <span>Item</span>
                        <span>Descrição</span>
                        <span>Expiração</span>
                        <span>Consumido da licitação</span>
                        <span>Solicitar</span>
                    </div>

                    <div class="item_selecionar_lista_pedido">
                        <span>Arroz</span>
                        <span>10 / 900</span>
                        <input class="quantidade_item" name="quantidade_item" required placeholder="Quantidade a solicitar">
                        <button class="btn_gerenciar_item_pedido"><i class="fa fa-solid fa-minus"></i></button>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>