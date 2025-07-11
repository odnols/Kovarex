<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Fornecedores</title>
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

            $id_fornecedor = $_POST["id_fornecedor"];
            $dados = $conexao->query("SELECT * FROM empresa WHERE id = $id_fornecedor");

            // Coletando os dados do fornecedor para edição
            $dados_fornecedor = $dados->fetch_assoc();

            $cnpj = $dados_fornecedor["cnpj"];
            $razao = $dados_fornecedor["razao_social"]; ?>

            <a href="../../pages/moderacao/fornecedores.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando o Fornecedor</h2>

            <div class="lista_fornecedores">

                <form id="cadastro_fornecedor" action="../functions/atualizar_fornecedor.php" method="post">

                    <h3>Atualize os dados do fornecedor abaixo</h3>
                    <br>

                    <input type="text" class="input invisible" name="input_id" value="<?php echo $id_fornecedor ?>">

                    <span>CNPJ</span><br>
                    <input type="text" class="input" name="input_cnpj" required maxlength="18" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})" value="<?php echo $cnpj ?>">

                    <br><br>
                    <span>Razão social</span><br>
                    <input type="text" class="input" name="input_razao_social" required maxlength="255" value="<?php echo $razao ?>">

                    <br><br>
                    <button class="button_form_cadastro bttn_salvar">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>