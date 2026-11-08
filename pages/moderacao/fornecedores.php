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

            <input id="input_filtro_fornecedor" type="text" name="text" class="input" placeholder="Pesquise por um CNPJ, ID ou Razão Social" onkeyup="filtra_fornecedor()">

            <button class="cadastrar_novo bttn_editar" onclick="abrir_popup()"><i class="fa fa-solid fa-plus"></i> Cadastrar um novo</button>

            <?php
            $stmt = $conexao->prepare("SELECT id, cnpj, razao_social, id_vinculado FROM empresa ORDER BY razao_social ASC");
            $stmt->execute();
            $dados = $stmt->get_result();
            $stmt->close();

            if ($dados->num_rows) { ?>

                <br><br>
                <h4>Fornecedores cadastrados</h4>

                <div class="lista_fornecedores">

                    <?php
                    while ($dados_fornecedor = $dados->fetch_assoc()) {
                        $id = (int) $dados_fornecedor["id"];
                        $cnpj = htmlspecialchars($dados_fornecedor["cnpj"], ENT_QUOTES, 'UTF-8');
                        $razao = htmlspecialchars($dados_fornecedor["razao_social"], ENT_QUOTES, 'UTF-8');
                        $id_vinculado = htmlspecialchars($dados_fornecedor["id_vinculado"] ?? '', ENT_QUOTES, 'UTF-8');
                        
                        $cnpj_formatado = preg_replace('/[^0-9]/', '', $cnpj);
                        $razao_min = strtolower($razao);
                        
                        $cadastro = strlen($id_vinculado) > 0 
                            ? "<span class='label amarelo' style='float: right; margin-right: 5px; margin-top: -11px'><i class='fa fa-solid fa-id-badge'></i> Representante cadastrado</span>" 
                            : "<span class='label vermelho' style='float: right; margin-right: 5px; margin-top: -11px'><i class='fa fa-solid fa-id-badge'></i> Sem representante</span>";

                        echo "<form class='item_fornecedor $cnpj_formatado $razao_min " . (int)$id . "' action='../../php/cache/editar_fornecedor.php' method='POST'>
                                <span class='label'>" . (int)$id . "</span> $razao <br>
                                $cnpj

                                <input name='id_fornecedor' value='" . (int)$id . "' type='hidden'>

                                <button class='bttn_editar' type='submit'><i class='fa fa-solid fa-pen'></i> Editar</button>
                                $cadastro
                        </form>";
                    } ?>

                    <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem fornecedores para essa pesquisa...</h2>
                </div>

            <?php } else { ?>

                <h1><i class="fa fa-solid fa-ban"></i> Não há nenhum fornecedor cadastrado ainda...</h1>
                <hr>

                <div class="form_primeira_interacao">
                    <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_fornecedor.php" method="post">

                        <h3>Cadastre um agora mesmo para começar!</h3>
                        <br>

                        <span>CNPJ</span><br>
                        <input type="text" class="input" name="input_cnpj" required maxlength="18" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})">

                        <br><br>
                        <span>Razão social</span><br>
                        <input type="text" class="input" name="input_razao_social" required maxlength="255">

                        <br><br>
                        <button class="button_form_cadastro bttn_salvar" type="submit">Cadastrar</button>
                    </form>

                    <form id="cadastro_fornecedor" action="../../php/functions/importar_dados.php" method="post">

                        <h3>Ou importe de outro sistema...</h3>

                        <br>
                        <p><i class="fa fa-regular fa-lightbulb"></i> A importação utilizará o CNPJ ou ID do fornecedor, caso haja um CNPJ ou CPF repetido, iremos ignorar a importação do CNPJ ou CPF que estiver repetido de modo a evitar erros em dados.</p>

                        <br><br>
                        <div class="file">
                            <label class="file-label">
                                <input class="file-input" type="file" name="resume" accept=".pdf" disabled />
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label"> Escolha uma base de dados...</span>
                                </span>
                            </label>
                        </div>

                        <br>
                        <button class="button_form_cadastro bttn_salvar" type="submit" disabled>Importar</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <div class="cadastro_popup">
            <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_fornecedor.php" method="post">

                <h3>Cadastrar fornecedor</h3>
                <br>

                <span>CNPJ</span><br>
                <input type="text" class="input" name="input_cnpj" required maxlength="18" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})">

                <br><br>
                <span>Razão social</span><br>
                <input type="text" class="input" name="input_razao_social" required maxlength="255">

                <br><br>
                <button class="button_form_cadastro bttn_salvar">Cadastrar</button> <br><br>
                <button class="button_form_cadastro bttn_cancelar" onclick="fechar_popup()" type="button">Fechar janela</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>