<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Usuários</title>
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

            <?php
            $dados = $conexao->query("SELECT * FROM usuario");

            if ($dados->num_rows) { ?>

                <input id="input_filtro_fornecedor" style="width: 100%;" type="text" name="text" class="input" placeholder="Pesquise por nome ou departamento" onkeyup="filtra_fornecedor()">

                <br><br>
                <h4>Usuários cadastrados</h4>

                <div class="lista_fornecedores">

                    <?php // Listando todos os usuarios
                    while ($dados_usuario = $dados->fetch_assoc()) {

                        $id = $dados_usuario["id"];
                        $nome = $dados_usuario["nome"];
                        $hierarquia = $dados_usuario["hierarquia"];

                        $dados_atribuicao = $conexao->query("SELECT * FROM atribuicao WHERE id_usuario = $id");

                        $departamentos = "";
                        $nome_departamentos = "";

                        if ($dados_atribuicao->num_rows) {
                            while ($dados_dpt_interno = $dados_atribuicao->fetch_assoc()) {

                                $id_departamento = $dados_dpt_interno["id_departamento"];
                                $dados_departamento = $conexao->query("SELECT * FROM departamento WHERE id = $id_departamento");

                                $dados_dpt_interno = $dados_departamento->fetch_assoc();

                                $nome_departamento = $dados_dpt_interno["nome"];
                                $cor_destaque = $dados_dpt_interno["cor_destaque"];

                                $departamentos = $departamentos . "<a class='label espacador_label' style='background-color: $cor_destaque' href='./departamentos.php'>$nome_departamento</a>";
                                $nome_departamentos = $nome_departamentos . "$nome_departamento ";
                            }
                        } else if (!$hierarquia) $departamentos = "<a class='label' href='./departamentos.php'>Sem departamento vinculado</a> <div class='label vermelho'>Sem acesso ao sistema</div>";

                        if ($hierarquia) // Incluindo tag de moderador ao usuário
                            $departamentos = $departamentos . "<div class='label azul'>💂‍♂️ Moderador</div>";

                        $nome_departamentos = strtolower($nome_departamentos);
                        $nome_min = strtolower($nome);

                        $alterar_psw = "";

                        if ($dados_usuario["alterar_psw"] == 1) // Tag com informações sobre alteração de senha em andamento
                            $alterar_psw = "<div class='label vermelho'><i class='fa fa-solid fa-key'></i> Senha a ser alterada</div>";

                        echo "<form class='item_fornecedor $nome_min $id $nome_departamentos' action='../../php/cache/editar_usuario.php' method='POST'>
                                <span class='label'>$id</span> $nome <br>

                                $departamentos$alterar_psw

                                <input name='id_usuario' value='$id' class='invisible'>

                                <button class='bttn_editar'><i class='fa fa-solid fa-pen'></i> Editar</button>
                        </form>";
                    } ?>

                    <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem usuários para essa pesquisa...</h2>
                </div>

            <?php } else { ?>

                <h1><i class="fa fa-solid fa-ban"></i> Não há nenhum usuário cadastrado ainda...</h1>
                <hr>

            <?php } ?>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>