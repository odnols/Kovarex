<?php
session_start();

require_once __DIR__."/../config.php"; 

$id_user = "";
$foto_user = "/kovarex/files/img/icons/avatar.png";

if (isset($_SESSION["codigo_empenho"])) {
    $codigo_empenho = preg_replace('/[^a-zA-Z0-9\-_]/', '', $_SESSION["codigo_empenho"]);
    unset($_SESSION["codigo_empenho"]);
    header("Location: /kovarex/pages/pedidos/consultar_empenho.php?empenho=$codigo_empenho");
    exit;
}

$trace = debug_backtrace();
$caller = $trace[0];
$solicitante = $caller['file'];

require_once SITE_ROOT."/php/session/conexao_banco.php";

if (!strpos($solicitante, "consultar_empenho.php") && !isset($_SESSION["id_user"])) {
    require_once SITE_ROOT."/php/session/verifica_sessao.php";
    exit;
}

$atribuicoes = array();

if (isset($_SESSION["id_user"])) {
    $id_user = (int) $_SESSION["id_user"];

    if (isset($_SESSION["foto"])) {
        $foto_user = htmlspecialchars($_SESSION["foto"], ENT_QUOTES, 'UTF-8');
    }

    require_once SITE_ROOT."/php/session/verifica_sessao.php";

    $stmt = $conexao->prepare("SELECT id_departamento FROM atribuicao WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $atribuicoes = $stmt->get_result();
    $stmt->close();
}
?>

<div id="barra_funcoes">

    <?php if ($id_user) { ?>

        <div id="caixa_entrada">
            <i class="fa fa-solid fa-envelope fa-lg icon_cinza"></i>
        </div>

        <img id="perfil_sm" src="<?php echo htmlspecialchars($foto_user, ENT_QUOTES, 'UTF-8') ?>" alt="Perfil">
    <?php } ?>

    <div id="nav_links">
        <?php if ($id_user) {
            echo "<h2><a href='/kovarex/pages/panel.php'><img src='/kovarex/files/img/icons/logo.png' alt='Logo'></a></h2>";
        } else { ?>
            <h2><a href="/kovarex/index.php"><img src="/kovarex/files/img/icons/logo.png" alt="Logo"></a></h2>
            <h2><a href='#' onclick='pop_up_login()'>Faça login</a></h2>
        <?php } ?>

        <div class="opcoes_barra_funcoes">
            <?php if ($id_user) {
                $nome = htmlspecialchars($_SESSION["nome"] ?? '', ENT_QUOTES, 'UTF-8');
                $hierarquia = (int) ($_SESSION["hierarquia"] ?? 0);
                
                echo "<h2><a href='/kovarex/pages/licitacoes.php'>Licitações</a></h2>
                      <h2><a href='/kovarex/pages/pedidos.php'>Pedidos</a></h2>
                      <h2><a href='/kovarex/pages/autorizacoes.php'>Autorizações</a></h2>";

                if ($hierarquia) {
                    echo "<h2><a href='/kovarex/pages/moderacao.php'>Moderação</a></h2>";
                }
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

    <a href='/kovarex/php/session/redireciona_logoff.php'>Deslogar</a>
</div>