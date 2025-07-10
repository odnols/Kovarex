<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Criando um pedido</title>
    <link rel="shortcut icon" href="../../files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<?php

$codigo = "";

if (isset($_GET["empenho"])) $codigo = $_GET["empenho"];
else if (isset($_POST["empenho"])) $codigo = $_POST["empenho"];
?>

<body>

    <?php // Importando a barra lateral de funções
    include_once "../../modules/barra_funcoes.php" ?>

    <div id="quadro_fundo_total" class="cinza_escuro_fundo">

        <?php
        $dados_empenho = $conexao->query("SELECT * FROM empenho WHERE codigo_compartilhamento = '$codigo'");

        if (isset($_SESSION["hierarquia"])) { ?>
            <a href="../autorizacoes.php" class="btn_voltar_pedidos"><button><i class="fa fa-solid fa-caret-left"></i> Retornar</button></a>
        <?php }

        // Gera um código de compartilhamento
        function generateRandomString()
        {
            $chars = "0123456789";
            $chars_2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz";
            $randomString = '';

            for ($i = 0; $i < 2; $i++) {
                $randomString .= $chars_2[mt_rand(0, strlen($chars_2) - 1)];
            }

            $randomString .= ".";

            for ($i = 0; $i < 4; $i = $i + 1) {
                $randomString .= $chars[mt_rand(0, strlen($chars) - 1)];
            }

            $randomString .= ".";

            for ($i = 0; $i < 2; $i++) {
                $randomString .= $chars_2[mt_rand(0, strlen($chars_2) - 1)];
            }

            return $randomString;
        }

        if ($dados_empenho->num_rows > 0 && strlen($codigo) > 0) {

            $dados = $dados_empenho->fetch_assoc();

            $num_af = $dados["num_af"];
            $data_emp = $dados["data_empenho"];
            $ano_af = explode("/", $dados["data_empenho"]);
            $ano_af = $ano_af[2];

            $id_departamento = $dados["id_departamento"];

            $dados_departamento = $conexao->query("SELECT * FROM departamento WHERE id = $id_departamento");
            $dados_departamento = $dados_departamento->fetch_assoc();

            $nome_departamento = $dados_departamento["nome"];
            $cor_destaque = $dados_departamento["cor_destaque"]; ?>

            <div id="buttons_navegacao_index">
                <div class="quadro_pag pilula_l sombra_quadro">

                    <span class='barra_lateral_cor_destaque' style='background-color: <?php echo $cor_destaque ?>'></span>

                    <?php echo "<span class='label' style='background-color: $cor_destaque; float: right; font-size: 18px; height: 25px'>$nome_departamento</span></p>"; ?><br>
                    <span class="label" style="float: right; font-size: 18px; height: 25px;"><i class='fa fa-solid fa-pencil'></i> Materiais de escritório</span>

                    <h3 style="margin-top: -10px;"><i class="fa fa-regular fa-folder-open"></i> Consultando a AF <?php echo $num_af ?> de <?php echo $ano_af ?></h3>

                    <hr>

                    <p style="float: right;">Entrega prevista para 27/09/2024</p>
                    <p>Criado em <?php echo $data_emp ?></p>

                    Código interno: <span class='label'><i class='fa fa-solid fa-share'></i> <?php echo $codigo ?></span>

                    <br><br>

                    <fieldset id="lista_itens_pedido">

                        <input id="input_filtro_fornecedor" type="text" name="text" class="input" style="width: 100%;" placeholder="Pesquise por um item" onkeyup="filtra_fornecedor()">

                        <br><br>

                        <div class="item_lista_conferir_empenho">
                            <span>Item</span>
                            <span>Descrição</span>
                            <span>Quantidade</span>
                            <span>Status</span>
                        </div>

                        <div class="lista_grid_selecionar_item">

                            <div class="item_lista_conferir_empenho item_fornecedor generos_alimenticios">
                                <span>Arroz</span>
                                <span>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</span>
                                <span class="label">50</span>
                                <span class="label amarelo">Falta entregar</span>
                            </div>

                            <div class="item_lista_conferir_empenho item_fornecedor generos_alimenticios">
                                <span>Arroz</span>
                                <span>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</span>
                                <span class="label">50</span>
                                <span class="label verde">Entregue</span>
                            </div>

                            <div class="item_lista_conferir_empenho item_fornecedor generos_alimenticios">
                                <span>Arroz</span>
                                <span>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</span>
                                <span class="label">50</span>
                                <span class="label verde">Entregue</span>
                            </div>

                            <div class="item_lista_conferir_empenho item_fornecedor generos_alimenticios">
                                <span>Arroz</span>
                                <span>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</span>
                                <span class="label">50</span>
                                <span class="label verde">Entregue</span>
                            </div>

                            <div class="item_lista_conferir_empenho item_fornecedor generos_alimenticios">
                                <span>Arroz</span>
                                <span>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</span>
                                <span class="label">50</span>
                                <span class="label verde">Entregue</span>
                            </div>

                            <div class="item_lista_conferir_empenho item_fornecedor generos_alimenticios">
                                <span>Arroz</span>
                                <span>Escolha abaixo o tipo do pedido para ter acesso aos itens licitados no momento.</span>
                                <span class="label">50</span>
                                <span class="label verde">Entregue</span>
                            </div>
                        </div>

                        <h3 class="sem_resultados"><i class="fa fa-solid fa-ban"></i> Sem itens para essa pesquisa...</h3>
                    </fieldset>
                </div>

                <div class="quadro_pag pilula_r sombra_quadro">

                    <?php if (isset($_SESSION["hierarquia"])) { ?>
                        <button style="float: right;"><i class="fa fa-solid fa-check"></i> Marcar como entregue <i class="fa fa-solid fa-caret-right"></i></button>
                    <?php } ?>

                    <h3><i class="fa fa-regular fa-calendar"></i> Eventos da AF</h3>
                    <hr>
                    <p>Confira os eventos relacionados a essa AF abaixo.</p>

                    <br>

                    <fieldset id="lista_itens_pedido">

                        <div class="item_lista_conferir_empenho">
                            <span>Tipo</span>
                            <span>Data</span>
                            <span>Autor</span>
                            <span>Descrição</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label verde'><i class="fa fa-solid fa-box"></i> Entrega</span>
                            <span class='label'>10/09/2024</span>
                            <span>Gustavo</span>
                            <span>Os itens 2, 4 e 6 foram entregues</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>

                        <div class="item_lista_conferir_empenho">
                            <span class='label azul'><i class="fa fa-solid fa-robot"></i> Sistema</span>
                            <span class='label'>10/09/2024</span>
                            <span>Sistema</span>
                            <span>AF marcada como encerrada.</span>
                        </div>
                    </fieldset>
                </div>
            </div>
        <?php } else {
            echo "<h1 class='empenho_desconhecido'><i class='fa fa-solid fa-magnifying-glass'></i> Opa, não há nada por aqui no momento...</h1>";
        } ?>
    </div>

    <div id="formulario_login_empenho">
        <!-- Formulários de Login -->
        <div id="formularios_lg">

            <h1 style="color: white;">Faça login para continuar</h1>
            <hr id="hr_login">

            <form name="loga" class="logah" action="/kovarex/php/session/usuario_confirmar_login.php" method="post">
                <h2>
                    <input type="text" name="codigo_empenho" class="invisible" required value="<?php echo $codigo ?>">

                    <input type="text" name="email" required placeholder="E-mail" maxlength="100"><br><br>

                    <input type="password" name="senha" required placeholder="Senha" maxlength="50"><br><br>
                </h2>

                <div class="buttons_login">
                    <a class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: left" onclick="btn_login(1)">Primeiro acesso</a>

                    <button class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: right">Entrar</button>
                </div>
            </form>
        </div>

        <!-- Formulário cadastro -->
        <div id="formularios_cad">

            <h1 style="color: white;">Cadastre-se para começar</h1>
            <hr id="hr_login">

            <form name="cadastra" class="logah" action="/kovarex/php/session/usuario_receber_cadastro.php" method="post">
                <h2>
                    <input type="text" name="nome" required placeholder="Nome" maxlength="100"><br><br>

                    <input type="text" name="email" required placeholder="E-mail" maxlength="100"><br><br>

                    <input type="text" name="cnpj" placeholder="CNPJ" maxlength="100"><br><br>

                    <input type="password" name="senha" required placeholder="Senha" maxlength="50"><br><br>
                </h2>

                <div class="buttons_login">
                    <a class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: left" onclick="btn_login(0)">Voltar para login</a>

                    <button class="btn btn-custom btn-lg page-scroll configura_perfil" style="float: right">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript" src="../../js/engine.js"></script>

</html>