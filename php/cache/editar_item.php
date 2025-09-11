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

<body>

    <?php // Importando a barra lateral de funções
    include_once "../../modules/barra_funcoes.php" ?>

    <div id="quadro_fundo_total" class="cinza_escuro_fundo">
        <div class="detalhes_fornecedor">

            <?php

            $id_item = $_POST["id_item"];
            $dados = $conexao->query("SELECT * FROM item WHERE id = $id_item");

            // Coletando os dados do tipo de item para edição
            $dados_item = $dados->fetch_assoc();

            $nome = $dados_item["nome"];
            $descricao = $dados_item["descricao"];
            $id_unidade_item = $dados_item["id_unidade"];
            $id_tipo_item = $dados_item["id_tipo_item"];

            $nome_unidade_item = $conexao->query("SELECT * FROM unidade WHERE id = $id_unidade_item");
            $nome_unidade_item = $nome_unidade_item->fetch_assoc();
            $nome_unidade_item = $nome_unidade_item["nome"];

            $nome_tipo_item = $conexao->query("SELECT * FROM tipo_item WHERE id = $id_tipo_item");
            $nome_tipo_item = $nome_tipo_item->fetch_assoc();
            $nome_tipo_item = $nome_tipo_item["nome"]; ?>

            <a href="../../pages/moderacao/itens.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando o Item</h2>

            <div class="lista_fornecedores">
                <form id="cadastro_fornecedor" action="../functions/atualizar_item.php" method="post">

                    <h3>Atualize os dados do item abaixo</h3>
                    <br>

                    <input type="text" class="input invisible" name="input_id" value="<?php echo $id_item ?>">

                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome" required maxlength="50" value="<?php echo $nome ?>">

                    <br><br>
                    <span>Descrição</span><br>
                    <input type="text" class="input" name="input_descricao" maxlength="150" value="<?php echo $descricao ?>">

                    <br><br>
                    <span>Unidade de medida</span><br>
                    <select id="input_unidade_medida" type="select" class="input" name="input_unidade_medida" required style="color: black;">
                        <?php

                        echo "<option value='$id_unidade_item'>$nome_unidade_item</option>";

                        $unidades_medida = $conexao->query("SELECT * FROM unidade ORDER BY nome");
                        if ($unidades_medida->num_rows) {
                            while ($unidade = $unidades_medida->fetch_assoc()) {

                                $id_unidade = $unidade["id"];
                                $nome_unidade = $unidade["nome"];

                                if ($id_unidade !== $id_unidade_item)
                                    echo "<option value='$id_unidade'>$nome_unidade</option>";
                            }
                        } ?>
                    </select>

                    <br><br>
                    <span>Tipo de item</span><br>
                    <select id="input_tipo_item" type="select" class="input" name="input_tipo_item" required style="color: black;">
                        <?php

                        echo "<option value='$id_tipo_item'>$nome_tipo_item</option>";

                        $tipos_item = $conexao->query("SELECT * FROM tipo_item ORDER BY nome");
                        if ($tipos_item->num_rows) {
                            while ($tipo_item = $tipos_item->fetch_assoc()) {

                                $id_tipo = $tipo_item["id"];
                                $nome_tipo = $tipo_item["nome"];

                                if ($id_tipo_item !== $id_tipo)
                                    echo "<option value='$id_tipo'>$nome_tipo</option>";
                            }
                        } ?>
                    </select>
            </div>

            <br><br>
            <button class="button_form_cadastro bttn_salvar">Atualizar</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>