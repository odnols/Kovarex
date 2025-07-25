<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Departamentos</title>
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

            $id_departamento = $_POST["id_departamento"];
            $dados = $conexao->query("SELECT * FROM departamento WHERE id = $id_departamento");

            // Coletando os dados do departamento para edição
            $dados_departamento = $dados->fetch_assoc();

            $nome = $dados_departamento["nome"];
            $cor_destaque = $dados_departamento["cor_destaque"]; ?>

            <a href="../../pages/moderacao/departamentos.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando o Departamento</h2>

            <div class="lista_fornecedores">

                <form id="cadastro_fornecedor" action="../functions/atualizar_departamento.php" method="post">

                    <h3>Atualize os dados do departamento abaixo</h3>
                    <br>

                    <input type="text" class="input invisible" name="input_id" value="<?php echo $id_departamento ?>">

                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome" required maxlength="250" value="<?php echo $nome ?>">

                    <br><br>
                    <span>Cor de destaque</span><br>
                    <input type="color" class="input" name="input_cor_destaque" required value="<?php echo $cor_destaque ?>">

                    <br><br>
                    <button class="button_form_cadastro bttn_salvar">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>