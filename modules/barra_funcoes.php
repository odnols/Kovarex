<?php session_start();

$id_user = "";
$foto_user = "/kovarex/files/img/icons/avatar.png";

// Redireciona o usuário para o empenho que estava visualizando antes de realizar o login
if (isset($_SESSION["codigo_empenho"])) {
    $codigo_empenho = $_SESSION["codigo_empenho"];

    unset($_SESSION["codigo_empenho"]);
    header("Location: /kovarex/pages/pedidos/consultar_empenho.php?empenho=$codigo_empenho");
}

$trace = debug_backtrace();
$caller = $trace[0];

$solicitante = $caller['file'];

// Encontra a posição da palavra
$posicao = strpos($solicitante, "kovarex\pages");
$substring = substr($solicitante, $posicao + strlen("kovarex\pages"));

// Conta quantas vezes \ aparece na substring
$count = substr_count($substring, '\\');
$navegacao = "";

if ($count > 1)
    $navegacao = "../";

require_once "$navegacao../php/session/conexao_banco.php";

// Verifica se o usuário está logado para liberar acesso a outras páginas além da consulta de empenho
if (!strpos($solicitante, "consultar_empenho.php") && !isset($_SESSION["id_user"]))
    require_once "$navegacao../php/session/verifica_sessao.php";

if (isset($_SESSION["id_user"])) {

    $id_user = $_SESSION["id_user"];

    // Coletando a foto que o usuário possui
    if (isset($_SESSION["foto"])) $foto_user = $_SESSION["foto"];

    require_once "$navegacao../php/session/verifica_sessao.php";

    // Verificando as atribuições de departamentos que o usuário possui
    $atribuicoes = $conexao->query("SELECT * FROM atribuicao WHERE id_usuario = $id_user");
} else
    $atribuicoes = array(); ?>

<div id="barra_funcoes">

    <?php if ($id_user) { ?>

        <div id="caixa_entrada">
            <i class="fa fa-solid fa-envelope fa-lg icon_cinza"></i>
            <!-- <i class="fa fa-solid fa-envelope-open-text fa-lg icon_amarelo"></i> -->
        </div>

        <img id="perfil_sm" src="<?php echo $foto_user ?>">
    <?php } ?>

    <div id="nav_links">
        <?php if ($id_user) echo "<h2><a href='/kovarex/pages/panel.php'><img src='/kovarex/files/img/icons/logo.png'></a></h2>";
        else { ?>

            <h2><a href="/kovarex/index.php"><img src="/kovarex/files/img/icons/logo.png"></a></h2>
            <h2><a href='#' onclick='pop_up_login()'>Faça login</a></h2>

        <?php } ?>

        <div class="opcoes_barra_funcoes">
            <?php if ($id_user) {
                echo "<h2><a href='/kovarex/pages/licitacoes.php'>Licitações</a></h2>
                      <h2><a href='/kovarex/pages/pedidos.php'>Pedidos</a></h2>
                      <h2><a href='/kovarex/pages/autorizacoes.php'>Autorizações</a></h2>";

                if ($_SESSION["hierarquia"])
                    echo "<h2><a href='/kovarex/pages/moderacao.php'>Moderação</a></h2>";
            } ?>
        </div>
    </div>
</div>

<div id="float_menu">

    <?php if ($id_user) { ?>
        <a href="#">Perfil</a>
        <hr>
        <a href="#">Configurações</a>
        <hr>
    <?php } ?>

    <?php echo "<a href='/kovarex/php/session/redireciona_logoff.php'>Deslogar</a>" ?>
</div>