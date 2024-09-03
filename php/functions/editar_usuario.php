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

            <h2><a href="../../pages/itens.php">Itens</a></h2>
            <h2><a href="../../pages/pedidos.php">Pedidos</a></h2>
            <h2><a href="../../pages/entregas.php">Entregas</a></h2>
            <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="../../pages/moderacao.php">Moderação</a></h2> <?php } ?>
        </div>
    </div>

    <div id="quadro_fundo_total">
        <div class="detalhes_fornecedor">

            <?php

            $id_usuario = $_POST["id_usuario"];
            $usuario = "SELECT * FROM usuario WHERE id = $id_usuario";
            $dados = $conexao->query($usuario);

            // Coletando os dados do usuario para edição
            $dados_usuario = $dados->fetch_assoc();

            $nome = $dados_usuario["nome"];
            $email = $dados_usuario["email"]; ?>

            <a href="../../pages/moderacao/usuarios.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando o Usuário</h2>

            <div class="lista_fornecedores">
                <form id="cadastro_fornecedor" action="./atualizar_usuario.php" method="post">

                    <h3>Atualize os dados do usuário abaixo</h3>
                    <br>

                    <input type="text" class="input invisible" name="input_id" value="<?php echo $id_usuario ?>">

                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome" required maxlength="250" value="<?php echo $nome ?>">

                    <br><br>
                    <span>E-mail</span><br>
                    <input type="text" class="input" name="input_email" required value="<?php echo $email ?>">

                    <br><br>
                    <span>Departamentos</span><br>
                    <div>

                        <?php
                        $departamentos = "SELECT * FROM departamento";
                        $dados_departamentos = $conexao->query($departamentos);

                        $dados_atribuicao = $conexao->query("SELECT * FROM atribuicao WHERE id_usuario = $id_usuario");
                        $atribuicoes = [];

                        // Listando todos os departamentos do usuário
                        if ($dados_atribuicao->num_rows > 0)
                            while ($dados_atr_interno = $dados_atribuicao->fetch_assoc())
                                array_push($atribuicoes, $dados_atr_interno["id_departamento"]);

                        // Listando todos os departamentos e ativando os que o usuário possui atribuição
                        if ($dados_departamentos->num_rows > 0) {
                            while ($dados_dpt_interno = $dados_departamentos->fetch_assoc()) {

                                $id_departamento = $dados_dpt_interno["id"];
                                $nome_departamento = $dados_dpt_interno["nome"];
                                $cor_destaque = $dados_dpt_interno["cor_destaque"];

                                $atribuido = in_array($id_departamento, $atribuicoes) ? "checked" : "";

                                echo "<input name='input_atribuicoes[]' value='$id_departamento' type='checkbox' $atribuido> <div class='label espacador_label' style='background-color: $cor_destaque'>$nome_departamento</div>";
                            }
                        }
                        ?>
                    </div>

                    <br><br>
                    <button class="button_form_cadastro">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>