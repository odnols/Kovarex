<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Editar Usuário</title>
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

    <?php
    include_once "../../modules/barra_funcoes.php";
    
    if (!isset($_SESSION["id_user"]) || !$_SESSION["hierarquia"]) {
        header("Location: ../../index.php?ERROR=401");
        exit;
    }

    $id_usuario = (int) ($_POST["id_usuario"] ?? 0);
    
    if (!$id_usuario) {
        header("Location: ../../pages/moderacao/usuarios.php?ERROR=invalid");
        exit;
    }

    $stmt = $conexao->prepare("SELECT id, nome, email FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $dados = $stmt->get_result();
    $stmt->close();

    if (!$dados->num_rows) {
        header("Location: ../../pages/moderacao/usuarios.php?ERROR=notfound");
        exit;
    }

    $dados_usuario = $dados->fetch_assoc();
    $nome = htmlspecialchars($dados_usuario["nome"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($dados_usuario["email"], ENT_QUOTES, 'UTF-8');
    ?>

    <div id="quadro_fundo_total" class="cinza_escuro_fundo">
        <div class="detalhes_fornecedor">

            <a href="../../pages/moderacao/usuarios.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>

            <br>
            <h2>Editando o Usuário</h2>

            <div class="lista_fornecedores">
                <form id="cadastro_fornecedor" action="../../php/functions/atualizar_usuario.php" method="post">

                    <button class="cadastrar_novo bttn_editar" onclick="abrir_popup()" type="button"><i class="fa fa-solid fa-key"></i> Redefinir senha</button>

                    <h3>Atualize os dados do usuário abaixo</h3>
                    <br>

                    <input type="hidden" name="input_id" value="<?php echo (int)$id_usuario ?>">

                    <span>Nome</span><br>
                    <input type="text" class="input" name="input_nome" required maxlength="250" value="<?php echo $nome ?>">

                    <br><br>
                    <span>E-mail</span><br>
                    <input type="email" class="input" name="input_email" required maxlength="100" value="<?php echo $email ?>">

                    <br><br>

                    <div class="select_destaque">
                        <h4>Departamentos vinculados</h4>

                        <input id="input_filtro_fornecedor" style="width: 100%;" type="text" name="text" class="input" placeholder="Pesquise por um departamento" onkeyup="filtra_fornecedor()">

                        <br><br>
                        <div class="lista_grid">

                            <?php
                            $stmtDept = $conexao->prepare("SELECT id, nome, cor_destaque FROM departamento ORDER BY nome ASC");
                            $stmtDept->execute();
                            $dados_departamentos = $stmtDept->get_result();
                            $stmtDept->close();

                            $stmtAtrib = $conexao->prepare("SELECT id_departamento FROM atribuicao WHERE id_usuario = ?");
                            $stmtAtrib->bind_param("i", $id_usuario);
                            $stmtAtrib->execute();
                            $dados_atribuicao = $stmtAtrib->get_result();
                            $stmtAtrib->close();

                            $atribuicoes = [];

                            if ($dados_atribuicao->num_rows) {
                                while ($dados_atr_interno = $dados_atribuicao->fetch_assoc()) {
                                    $atribuicoes[] = (int) $dados_atr_interno["id_departamento"];
                                }
                            }

                            if ($dados_departamentos->num_rows) {
                                while ($dados_dpt_interno = $dados_departamentos->fetch_assoc()) {

                                    $id_departamento = (int) $dados_dpt_interno["id"];
                                    $nome_departamento = htmlspecialchars($dados_dpt_interno["nome"], ENT_QUOTES, 'UTF-8');
                                    $cor_destaque = preg_match('/^#[0-9a-fA-F]{6}$/', $dados_dpt_interno["cor_destaque"]) 
                                        ? htmlspecialchars($dados_dpt_interno["cor_destaque"], ENT_QUOTES, 'UTF-8') 
                                        : '#cccccc';

                                    $atribuido = in_array($id_departamento, $atribuicoes) ? "checked" : "";
                                    $nome_min = strtolower($nome_departamento);

                                    echo "<span class='item_fornecedor item_min $nome_min'>
                                            <input name='input_atribuicoes[]' value='" . (int)$id_departamento . "' type='checkbox' $atribuido> 
                                            <div class='label espacador_label' style='background-color: $cor_destaque'>$nome_departamento</div>
                                        </span>";
                                }
                            }
                            ?>
                        </div>
                    </div>
            </div>

            <br><br>
            <button class="button_form_cadastro bttn_salvar" type="submit">Atualizar</button>
            </form>
        </div>
    </div>

    <!-- Tela popup para alteração de senha do usuário -->
    <div class="cadastro_popup">
        <form id="cadastro_fornecedor" action="../../php/functions/usuario_redefinir_senha.php" method="post">

            <h3>Redefinir senha do usuário</h3>
            <br>

            <p>O usuário será direcionado até a tela para realizar a troca de senha assim que fizer login novamente.</p>
            <hr>

            <input type="hidden" name="id_user" value="<?php echo (int)$id_usuario ?>">

            <span>Nova senha (mínimo 8 caracteres)</span><br>
            <input type="password" class="input" name="senha" required maxlength="255" minlength="8">

            <br><br>
            <button class="button_form_cadastro bttn_salvar" type="submit">Redefinir</button> <br><br>
            <button class="button_form_cadastro bttn_cancelar" onclick="fechar_popup()" type="button">Fechar janela</button>
        </form>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>