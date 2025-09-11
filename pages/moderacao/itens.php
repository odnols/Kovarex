<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Itens</title>
    <link rel="shortcut icon" href="../../files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<body>

    <?php // Importando a barra lateral de funções
    include_once "../../modules/barra_funcoes.php" ?>

    <div id="quadro_fundo_total" class="cinza_escuro_fundo">
        <div class="detalhes_fornecedor">

            <a href="../moderacao.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>
            <br><br>

            <input id="input_filtro_fornecedor" type="text" name="text" class="input" placeholder="Pesquise por um nome, tipo de item ou unidade" onkeyup="filtra_fornecedor()">

            <button class="cadastrar_novo bttn_editar" onclick="abrir_popup('cadastrar_item')"><i class="fa fa-solid fa-plus"></i> Cadastrar novo</button>

            <?php $dados = $conexao->query("SELECT * FROM item ORDER BY nome"); ?>

            <br><br>
            <h4>Gerenciando itens</h4>

            <?php if ($dados->num_rows) { ?>

                <div class="lista_fornecedores">
                    <?php // Listando todos os itens
                    while ($dados_item = $dados->fetch_assoc()) {

                        $id = $dados_item["id"];
                        $nome = $dados_item["nome"];
                        $descricao = $dados_item["descricao"];
                        $id_unidade = $dados_item["id_unidade"];
                        $id_tipo_item = $dados_item["id_tipo_item"];

                        $unidade_item = $conexao->query("SELECT * FROM unidade WHERE id = $id_unidade");
                        $unidade_item = $unidade_item->fetch_assoc();
                        $unidade_item = $unidade_item["nome"];

                        $tipo_item = $conexao->query("SELECT * FROM tipo_item WHERE id = $id_tipo_item");
                        $tipo_item = $tipo_item->fetch_assoc();
                        $tipo_item = $tipo_item["nome"];

                        $dados_atribuicao = $conexao->query("SELECT * FROM item_pedido WHERE id_item = $id");
                        $destaque = "";
                        $exclusao = "";

                        if ($dados_atribuicao->num_rows) $destaque = "<div class='label azul'>Há $dados_atribuicao->num_rows processos vinculados a este item</div>";
                        else {

                            $exclusao = "<button type='button' class='bttn_cancelar' onclick=\"confirmar_exclusao('item', $id)\"><i class='fa fa-solid fa-trash'></i> Excluir</button>";
                            $destaque = "<div class='label'>Não utilizado em nenhum processo</div>";
                        }

                        $nome_min = strtolower($nome);

                        echo "<form class='item_fornecedor $nome_min $tipo_item $unidade_item $id' action='../../php/cache/editar_item.php' method='POST'>
                                <span class='label'>$id</span> $nome <br>

                                <textarea>Descrição: $descricao</textarea> <br>

                                <a class='label verde' href='./unidades.php'>$unidade_item</a> <a class='label' href='./unidades.php'>$tipo_item</a> $destaque

                                <input name='id_item' value='$id' class='invisible'>

                                <button class='bttn_editar'><i class='fa fa-solid fa-pen'></i> Editar</button>
                                $exclusao
                        </form>";
                    } ?>

                    <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem itens para essa pesquisa...</h2>
                </div>

            <?php } else { ?>
                <h1 class="cadastro_zerado"><i class="fa fa-solid fa-ban"></i> Não há nenhum item cadastrado ainda...</h1>
                <hr>
            <?php } ?>
        </div>

        <br><br>
        <div class="cadastro_popup cadastrar_item">
            <form id="cadastrar_item" action="../../php/functions/cadastrar_item.php" method="post">

                <h3>Cadastrar Item</h3>
                <br>

                <br><br>
                <span>Nome</span><br>
                <input type="text" class="input" name="input_nome_item" required maxlength="50" style="color: black;">

                <br><br>
                <span>Descrição</span><br>
                <input type="text" class="input" name="input_descricao_item" maxlength="150" style="color: black;">

                <br><br>
                <span>Unidade de medida</span><br>
                <select id="input_unidade_medida" type="select" class="input cadastro_select" name="input_unidade_medida" required style="color: black;">
                    <?php

                    $unidades_medida = $conexao->query("SELECT * FROM unidade ORDER BY nome");
                    if ($unidades_medida->num_rows) {
                        while ($unidade = $unidades_medida->fetch_assoc()) {

                            $id_unidade = $unidade["id"];
                            $nome_unidade = $unidade["nome"];

                            echo "<option value='$id_unidade'>$nome_unidade</option>";
                        }
                    } ?>
                </select>

                <a href="#" class="button_cadastro_select verde-claro">+</a>

                <br><br>
                <span>Tipo de item</span><br>
                <select id="input_tipo_item" type="select" class="input cadastro_select" name="input_tipo_item" required style="color: black;">
                    <?php

                    $unidades_medida = $conexao->query("SELECT * FROM tipo_item ORDER BY nome");
                    if ($unidades_medida->num_rows) {
                        while ($unidade = $unidades_medida->fetch_assoc()) {

                            $id_unidade = $unidade["id"];
                            $nome_unidade = $unidade["nome"];

                            echo "<option value='$id_unidade'>$nome_unidade</option>";
                        }
                    } ?>
                </select>

                <a href="#" class="button_cadastro_select verde-claro">+</a>

                <br><br><br>
                <button class="button_form_cadastro bttn_salvar">Cadastrar</button> <br><br>
                <button class="button_form_cadastro bttn_cancelar" onclick="fechar_popup('cadastrar_item')" type="button">Fechar janela</button>
            </form>
        </div>
    </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>