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

            <?php

            $id_usuario = $_POST["id_usuario"];
            $dados = $conexao->query("SELECT * FROM usuario WHERE id = $id_usuario");

            // Coletando os dados do usuario para edição
            $dados_usuario = $dados->fetch_assoc();

            $nome = $dados_usuario["nome"];
            $email = $dados_usuario["email"]; ?>

            <a href="../../pages/moderacao/usuarios.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando o Usuário</h2>

            <div class="lista_fornecedores">
                <form id="cadastro_fornecedor" action="../functions/atualizar_usuario.php" method="post">

                    <button class="cadastrar_novo bttn_editar" onclick="abrir_popup()" type="button"><i class="fa fa-solid fa-key"></i> Redefinir senha</button>

                    <h3>Atualize os dados do usuário abaixo</h3>
                    <br>

                    <input type="text" class="input invisible" name="input_id" value="<?php echo $id_usuario ?>">

                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome" required maxlength="250" value="<?php echo $nome ?>">

                    <br><br>
                    <span>E-mail</span><br>
                    <input type="text" class="input" name="input_email" required value="<?php echo $email ?>">

                    <br><br>

                    <div class="select_destaque">
                        <h4>Departamentos vinculados</h4>

                        <input id="input_filtro_fornecedor" style="width: 100%;" type="text" name="text" class="input" placeholder="Pesquise por um departamento" onkeyup="filtra_fornecedor()">

                        <br><br>
                        <div class="lista_grid">

                            <?php
                            $dados_departamentos = $conexao->query("SELECT * FROM departamento");
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
                                    $nome_min = strtolower($nome_departamento);

                                    echo "<span class='item_fornecedor item_min $nome_min'><input name='input_atribuicoes[]' value='$id_departamento' type='checkbox' $atribuido> <div class='label espacador_label' style='background-color: $cor_destaque'>$nome_departamento</div></span>";
                                }
                            } ?>
                        </div>
                    </div>
            </div>

            <br><br>
            <button class="button_form_cadastro bttn_salvar">Atualizar</button>
            </form>
        </div>
    </div>

    <!-- Tela popup para alteração de senha do usuário -->
    <div class="cadastro_popup">
        <form id="cadastro_fornecedor" action="../functions/usuario_redefinir_senha.php" method="post">

            <h3>Redefinir senha do usuário</h3>
            <br>

            <p>O usuário será direcionado até a tela para realizar a troca de senha assim que fizer login novamente.</p>
            <hr>

            <input type="text" class="input invisible" name="id_user" value="<?php echo $id_usuario ?>">

            <span>Nova senha</span><br>
            <input type="password" class="input" name="senha" required maxlength="50">

            <br><br>
            <button class="button_form_cadastro bttn_salvar">Redefinir</button> <br><br>
            <button class="button_form_cadastro bttn_cancelar" onclick="fechar_popup()" type="button">Fechar janela</button>
        </form>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>