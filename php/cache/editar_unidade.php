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

            $id_unidade = $_POST["id_unidade"];
            $dados = $conexao->query("SELECT * FROM unidade WHERE id = $id_unidade");

            // Coletando os dados da unidade para edição
            $dados_unidade = $dados->fetch_assoc();

            $nome = $dados_unidade["nome"];
            $sigla = $dados_unidade["sigla"]; ?>

            <a href="../../pages/moderacao/unidades.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando a Unidade</h2>

            <div class="lista_fornecedores">
                <form id="cadastro_fornecedor" action="../functions/atualizar_unidade.php" method="post">

                    <h3>Atualize os dados da unidade de medida abaixo</h3>
                    <br>

                    <input type="text" class="input invisible" name="input_id" value="<?php echo $id_unidade ?>">

                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome" required maxlength="50" value="<?php echo $nome ?>">

                    <br><br>
                    <span>Sigla</span><br>
                    <input type="text" class="input" name="input_sigla" required maxlength="10" value="<?php echo $sigla ?>">
            </div>

            <br><br>
            <button class="button_form_cadastro bttn_salvar">Atualizar</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>