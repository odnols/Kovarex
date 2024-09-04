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

<?php session_start();

require_once "../../php/session/verifica_sessao.php";
require_once "../../php/session/conexao_banco.php"; ?>

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
            <h2><a href="../panel.php"><img src="../../files/img/icons/logo.png"></a></h2>

            <h2><a href="../itens.php">Itens</a></h2>
            <h2><a href="../pedidos.php">Pedidos</a></h2>
            <h2><a href="../entregas.php">Entregas</a></h2>
            <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="../moderacao.php">Moderação</a></h2> <?php } ?>
        </div>
    </div>

    <div id="quadro_fundo_total">
        <div class="detalhes_fornecedor">

            <a href="../moderacao.php"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>
            <br><br>

            <?php
            $dados = $conexao->query("SELECT * FROM empresa");

            if ($dados->num_rows > 0) { ?>

                <input id="input_filtro_fornecedor" type="text" name="text" class="input" placeholder="Pesquise por um CNPJ, ID ou Razão Social" onkeyup="filtra_fornecedor()">

                <button class="cadastrar_novo" onclick="abrir_popup()"><i class="fa fa-solid fa-plus"></i> Cadastrar um novo</button>

                <br><br>
                <h4>Fornecedores</h4>

                <div class="lista_fornecedores">

                    <?php
                    // Listando todos os fornecedores
                    while ($dados_fornecedor = $dados->fetch_assoc()) {

                        $id = $dados_fornecedor["id"];
                        $cnpj = $dados_fornecedor["cnpj"];
                        $razao = $dados_fornecedor["razao_social"];
                        $cnpj_formatado = str_replace(".", "", $cnpj);
                        $cnpj_formatado = str_replace("/", "", $cnpj_formatado);
                        $cnpj_formatado = str_replace("-", "", $cnpj_formatado);

                        $razaio_min = strtolower($razao);

                        echo "<form class='item_fornecedor $cnpj $razaio_min $id $cnpj_formatado' action='../../php/cache/editar_fornecedor.php' method='POST'>
                                <span class='label'>$id</span> $razao <br>
                                $cnpj

                                <input name='id_fornecedor' value='$id' class='invisible'>

                                <button><i class='fa fa-solid fa-pen'></i> Editar fornecedor</button>
                        </form>";
                    } ?>

                    <h2 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem fornecedores para essa pesquisa...</h2>
                </div>

            <?php } else { ?>

                <h1>Não há nenhum fornecedor cadastrado ainda...</h1>
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
                        <button class="button_form_cadastro">Cadastrar</button>
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
                        <button class="button_form_cadastro" disabled>Importar</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <div class="cadastro_popup">
            <form id="cadastro_fornecedor" action="../../php/functions/cadastrar_fornecedor.php" method="post">

                <h3>Cadastro de fornecedor</h3>
                <br>

                <span>CNPJ</span><br>
                <input type="text" class="input" name="input_cnpj" required maxlength="18" pattern="([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})">

                <br><br>
                <span>Razão social</span><br>
                <input type="text" class="input" name="input_razao_social" required maxlength="255">

                <br><br>
                <button class="button_form_cadastro">Cadastrar</button> <br><br>
                <button class="button_form_cadastro" onclick="fechar_popup()" type="button">Fechar janela</button>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>