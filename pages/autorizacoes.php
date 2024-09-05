<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Pedidos</title>
    <link rel="shortcut icon" href="../files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<?php session_start();

require_once "../php/session/verifica_sessao.php";
require_once "../php/session/conexao_banco.php";

$id_user = $_SESSION["id"]; ?>

<body>
    <div id="banner_topo">
        <img id="perfil_sm" src="<?php if (isset($_SESSION["foto"])) {
                                        echo $_SESSION["foto"];
                                    } else {
                                        echo "../files/img/icons/avatar.png";
                                    } ?>">

        <div id="nav_links">
            <h2><a href="panel.php"><img src="../files/img/icons/logo.png"></a></h2>

            <h2><a href="licitacoes.php">Licitações</a></h2>
            <h2><a href="pedidos.php">Pedidos</a></h2>
            <h2><a href="autorizacoes.php">Autorizações</a></h2>
            <?php if ($_SESSION["hierarquia"]) { ?> <h2><a href="moderacao.php">Moderação</a></h2> <?php } ?>
        </div>
    </div>

    <div id="buttons_navegacao_pedidos" class="sombra_quadro">
        <button class="badge button_filtro" onclick="filtra_itens('em_aberto')">Em Aberto</button>
        <button class="badge button_filtro" onclick="filtra_itens('em_andamento')">Em andamento</button>
        <button class="badge button_filtro" onclick="filtra_itens('finalizados')">Finalizados</button>
        <button class="badge button_filtro" onclick="filtra_itens()">Limpar filtro</button>
    </div>

    <div id="quadro_fundo">
        <div class="grid_empenhos">

            <?php // Verificando as atribuições de departamentos que o usuário possui
            $atribuicoes = $conexao->query("SELECT * FROM atribuicao WHERE id_usuario = $id_user");

            $i = 0;
            $empenhos_ativos = "";

            while ($atribuicao = $atribuicoes->fetch_assoc()) {

                $id_departamento = $atribuicao["id_departamento"];
                $dados = $conexao->query("SELECT * FROM empenho WHERE status = 1 AND id_departamento = $id_departamento");

                if ($dados->num_rows > 0) {
                    while ($empenho = $dados->fetch_assoc()) {

                        $id_empenho = $empenho["id"];
                        $num_empenho = $empenho["num_empenho"];
                        $num_af = $empenho["num_af"];
                        $id_departamento = $empenho["id_departamento"];

                        $data_empenho = $empenho["data_empenho"];
                        $ultima_atualizacao = $empenho["ultima_atualizacao"];

                        $dados_departamento = $conexao->query("SELECT * FROM departamento WHERE id = $id_departamento");
                        $dados_departamento = $dados_departamento->fetch_assoc();

                        $nome_departamento = $dados_departamento["nome"];
                        $cor_destaque = $dados_departamento["cor_destaque"];

                        echo "<form class='card_empenho' action='./pedidos/consultar_empenho.php'>
                            <button style='float: right;'><i class='fa fa-regular fa-compass'></i> Ver mais</button>

                            <span class='barra_lateral_cor_destaque' style='background-color: $cor_destaque'></span>
                            <h4>Empenho <b>$num_empenho</b><br>Autorização <b>$num_af</b></h4>
                            <hr>
                            <p>Empenhado em $data_empenho<br>Última atualização em $ultima_atualizacao</p>

                            <span class='label' style='background-color: gray;'><i class='fa fa-solid fa-pencil'></i> Materiais de escritório</span>
                            <input type='text' class='invisible' value='$id_empenho'>

                            <p><span class='label' style='background-color: $cor_destaque;'>$nome_departamento</span></p>
                        </form>";
                    }
                }
            } ?>
        </div>
    </div>
</body>

<script type="text/javascript" src="../js/engine.js"></script>

</html>