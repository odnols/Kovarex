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

            <a href="../moderacao.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>
            <br><br>

            <input id="input_filtro_fornecedor" type="text" name="text" class="input" placeholder="Pesquise por um departamento" onkeyup="filtra_fornecedor()">

            <button class="cadastrar_novo bttn_editar" onclick="abrir_popup()"><i class="fa fa-solid fa-plus"></i> Cadastrar um novo</button>

            <?php
            $dados = $conexao->query("SELECT * FROM departamento");

            if ($dados->num_rows > 0) { ?>

                <br><br>
                <h4>Departamentos cadastrados</h4>

                <div class="lista_grid">

                    <?php // Listando todos os departamentos
                    while ($dados_departamento = $dados->fetch_assoc()) {

                        $id = $dados_departamento["id"];
                        $nome = $dados_departamento["nome"];
                        $cor = $dados_departamento["cor_destaque"];

                        $nome_min = strtolower($nome);

                        $vinculos = $conexao->query("SELECT * FROM atribuicao WHERE id_departamento = $id");
                        $users_vinculados = "";

                        if ($vinculos->num_rows > 0) $users_vinculados = "<a class='label azul' href='./usuarios.php'>$vinculos->num_rows usuários vinculados</a>";
                        else $users_vinculados = "<a class='label' href='./usuarios.php'>Sem usuários vinculos</a>";

                        echo "<form class='item_fornecedor item_departamento $nome_min' action='../../php/cache/editar_departamento.php' method='POST'>
                                <span class='barra_lateral_cor_destaque' style='background-color: $cor'></span>
                                <input name='id_departamento' value='$id' class='invisible'>

                                $users_vinculados

                                <br><button class='btn_editar_dpt bttn_editar'><i class='fa fa-solid fa-pen'></i> Editar</button>
                        
                                <h4 class='id_label'>$nome</h4>
                        </form>";
                    } ?>
                </div>

                <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem departamentos para essa pesquisa...</h2>

            <?php } else { ?>

                <h1><i class="fa fa-solid fa-ban"></i> Não há nenhum departamento cadastrado ainda...</h1>
                <hr>

                <div class="form_primeira_interacao">
                    <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_departamento.php" method="post">

                        <h3>Cadastre um agora mesmo para começar!</h3>
                        <br>

                        <span>Nome</span><br>
                        <input type="text" class="input" name="input_nome" required maxlength="250">

                        <br><br>
                        <span>Cor de destaque</span><br>
                        <input type="color" class="input" name="input_cor_destaque" required>

                        <br><br>
                        <button class="button_form_cadastro bttn_salvar">Cadastrar</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <div class="cadastro_popup">
            <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_departamento.php" method="post">

                <h3>Cadastro de departamento</h3>
                <br>

                <span>Nome</span><br>
                <input type="text" class="input" name="input_nome" required maxlength="250">

                <br><br>
                <span>Cor de destaque</span><br>
                <input type="color" class="input" name="input_cor_destaque" required>

                <br><br>
                <button class="button_form_cadastro bttn_salvar">Cadastrar</button> <br><br>
                <button class="button_form_cadastro bttn_cancelar" onclick="fechar_popup()" type="button">Fechar janela</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>