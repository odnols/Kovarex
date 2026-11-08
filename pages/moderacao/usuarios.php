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

    <?php
    include_once "../../modules/barra_funcoes.php";
    
    if (!isset($_SESSION["id_user"]) || !$_SESSION["hierarquia"]) {
        header("Location: ../../index.php?ERROR=401");
        exit;
    }
    ?>

    <div id="quadro_fundo_total" class="cinza_escuro_fundo">
        <div class="detalhes_fornecedor">

            <a href="../moderacao.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>
            <br><br>

            <?php
            $stmt = $conexao->prepare("SELECT id, nome, hierarquia, alterar_psw FROM usuario ORDER BY nome ASC");
            $stmt->execute();
            $dados = $stmt->get_result();

            if ($dados->num_rows) { ?>

                <input id="input_filtro_fornecedor" style="width: 100%;" type="text" name="text" class="input" placeholder="Pesquise por nome ou departamento" onkeyup="filtra_fornecedor()">

                <br><br>
                <h4>Usuários cadastrados</h4>

                <div class="lista_fornecedores">

                    <?php
                    while ($dados_usuario = $dados->fetch_assoc()) {
                        $id = (int) $dados_usuario["id"];
                        $nome = htmlspecialchars($dados_usuario["nome"], ENT_QUOTES, 'UTF-8');
                        $hierarquia = (int) $dados_usuario["hierarquia"];
                        $alterar_psw = (int) $dados_usuario["alterar_psw"];

                        $stmtAtrib = $conexao->prepare("SELECT id_departamento FROM atribuicao WHERE id_usuario = ?");
                        $stmtAtrib->bind_param("i", $id);
                        $stmtAtrib->execute();
                        $dados_atribuicao = $stmtAtrib->get_result();

                        $departamentos = "";
                        $nome_departamentos = "";

                        if ($dados_atribuicao->num_rows) {
                            while ($dados_dpt_interno = $dados_atribuicao->fetch_assoc()) {
                                $id_departamento = (int) $dados_dpt_interno["id_departamento"];
                                
                                $stmtDept = $conexao->prepare("SELECT nome, cor_destaque FROM departamento WHERE id = ?");
                                $stmtDept->bind_param("i", $id_departamento);
                                $stmtDept->execute();
                                $resultDept = $stmtDept->get_result();
                                
                                if ($resultDept->num_rows) {
                                    $dados_dpt = $resultDept->fetch_assoc();
                                    $nome_departamento = htmlspecialchars($dados_dpt["nome"], ENT_QUOTES, 'UTF-8');
                                    $cor_destaque = preg_match('/^#[0-9a-fA-F]{6}$/', $dados_dpt["cor_destaque"]) 
                                        ? htmlspecialchars($dados_dpt["cor_destaque"], ENT_QUOTES, 'UTF-8') 
                                        : '#cccccc';
                                    
                                    $departamentos .= "<a class='label espacador_label' style='background-color: $cor_destaque' href='./departamentos.php'>" 
                                        . $nome_departamento . "</a>";
                                    $nome_departamentos .= $nome_departamento . " ";
                                }
                                $stmtDept->close();
                            }
                        } else if (!$hierarquia) {
                            $departamentos = "<div class='label vermelho'>Sem acesso ao sistema</div> <a class='label' href='./departamentos.php'>Sem departamento vinculado</a>";
                        }

                        if ($hierarquia) {
                            $departamentos .= "<div class='label azul'>💂‍♂️ Moderador</div>";
                        }

                        $nome_departamentos = strtolower($nome_departamentos);
                        $nome_min = strtolower($nome);

                        $alterar_psw_label = "";
                        if ($alterar_psw == 1) {
                            $alterar_psw_label = "<div class='label vermelho'><i class='fa fa-solid fa-key'></i> Senha a ser alterada</div>";
                        }

                        echo "<form class='item_fornecedor $nome_min " . (int)$id . " $nome_departamentos' action='../../php/cache/editar_usuario.php' method='POST'>
                                <span class='label'>" . (int)$id . "</span> $nome <br>
                                $departamentos $alterar_psw_label
                                <input name='id_usuario' value='" . (int)$id . "' class='invisible' type='hidden'>
                                <button class='bttn_editar' type='submit'><i class='fa fa-solid fa-pen'></i> Editar</button>
                        </form>";
                    }
                    $stmt->close();
                    ?>

                    <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem usuários para essa pesquisa...</h2>
                </div>

            <?php } else {
                $stmt->close();
            ?>

                <h1><i class="fa fa-solid fa-ban"></i> Não há nenhum usuário cadastrado ainda...</h1>
                <hr>

            <?php } ?>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>