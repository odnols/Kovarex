<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Painel</title>
    <link rel="shortcut icon" href="../files/img/icons/logo.png">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/animations.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/6c1b2d82eb.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<body>

    <?php // Importando a barra lateral de funções
    include_once "../modules/barra_funcoes.php" ?>

    <div id="conteudo_pag">

        <?php if ($atribuicoes->num_rows || $_SESSION["hierarquia"]) { ?>

            <div id="buttons_navegacao_index">
                <div class="quadro_pag pilula_l sombra_quadro">
                    <h3>Boas vindas ao Kovarex!</h3>
                    <hr>
                    <p>Crie pedidos e acompanhe o status de entregas de forma rápida.</p>

                    <br>
                    <a href="./pedidos/criar_pedido.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Criar um novo pedido ></a>
                </div>

                <div class="quadro_pag pilula_l_2 sombra_quadro">

                    <h3><i class="fa fa-solid fa-file-contract"></i> Licitações</h3>

                    <hr>
                    <p>Acesse todos os itens licitados.</p>

                    <br>
                    <a href="licitacoes.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Ver itens licitados ></a>
                </div>

                <div class="quadro_pag pilula_r sombra_quadro">

                    <h3><i class="fa fa-solid fa-cart-arrow-down"></i> Pedidos</h3>
                    <hr>

                    <?php
                    $resultado = $conexao->query("SELECT * FROM pedido WHERE id_autor = $id_user ORDER BY id DESC LIMIT 5");

                    if ($resultado->num_rows) {
                    } else
                        echo "<p>Você ainda não tem pedidos para acompanhar... <br><br>Crie um agora mesmo!</p>"; ?>
                </div>

                <!-- <div class="quadro_pag pilula_avisos_geral sombra_quadro">
                    <p><i class="fa fa-solid fa-flag-checkered"></i> Um novo fechamento está programado para o dia 02/10, envie pedidos de materiais que são licitados antes desta data.</p>
                </div> -->

                <div class="quadro_pag pilula_completa sombra_quadro">
                    <a href="autorizacoes.php" class="button_add_pedido bttn_ver_autorizacoes_index cinza" style="float: right; width: 20%">Ver todas as autorizações ></a>

                    <h3><i class="fa fa-solid fa-clipboard-check"></i> Autorizações</h3>
                    <hr>

                    <?php // Listando empenhos de todos os departamentos atribuidos ao usuário

                    $i = 0;
                    $empenhos_ativos = "";

                    while ($atribuicao = $atribuicoes->fetch_assoc()) {

                        $id_departamento = $atribuicao["id_departamento"];
                        $dados = $conexao->query("SELECT * FROM empenho WHERE status = 1 AND id_departamento = $id_departamento");

                        if ($dados->num_rows) {

                            while ($i < 5 && $empenho = $dados->fetch_assoc()) {

                                $id_empenho = $empenho["id"];
                                $num_empenho = $empenho["num_empenho"];
                                $num_af = $empenho["num_af"];
                                $id_departamento = $empenho["id_departamento"];

                                $codigo_compartilhamento = $empenho["codigo_compartilhamento"];

                                $data_empenho = $empenho["data_empenho"];
                                $ultima_atualizacao = $empenho["ultima_atualizacao"];

                                $dados_departamento = $conexao->query("SELECT * FROM departamento WHERE id = $id_departamento");
                                $dados_departamento = $dados_departamento->fetch_assoc();

                                $nome_departamento = $dados_departamento["nome"];
                                $cor_destaque = $dados_departamento["cor_destaque"];

                                $empenhos_ativos = $empenhos_ativos . "<form class='card_empenho' action='./pedidos/consultar_empenho.php' method='POST'>
                                    <span class='label'><i class='fa fa-solid fa-share'></i> $codigo_compartilhamento</span>
                                    <button style='float: right;' class='bttn_ver_empenho'><i class='fa fa-regular fa-compass'></i> Ver mais</button>
                                
                                    <span class='barra_lateral_cor_destaque' style='background-color: $cor_destaque'></span>
                                    <h4>Empenho <b>$num_empenho</b><br>Autorização <b>$num_af</b></h4>
                                    <hr>
                                    <p>Empenhado em $data_empenho<br>Última atualização em $ultima_atualizacao</p>

                                    <span class='label' style='background-color: gray;'><i class='fa fa-solid fa-pencil'></i> Materiais de escritório</span>
                                    <input type='text' class='invisible' name='empenho' value='$codigo_compartilhamento'>

                                    <p><span class='label' style='background-color: $cor_destaque;'>$nome_departamento</span></p>
                                </form>";

                                if ($i > 5) break;

                                $i++;
                            }
                        }

                        if ($i > 5) break;
                    }

                    if ($i > 0) { ?>

                        <p>Autorizações lançadas que aguardam entrega ou coleta.</p>

                        <div class="grid_empenhos">
                            <?php echo $empenhos_ativos ?>
                        </div>

                    <?php } else { ?>

                        <p>No momento não há autorizações lançadas que estão sem entregas confirmadas...</p>

                    <?php } ?>
                    <br>
                </div>
            </div>

        <?php } else { ?>

            <div id="buttons_navegacao_aprovacao">
                <div class="quadro_pag sombra_quadro">
                    <h3>Boas vindas ao Kovarex!</h3>
                    <hr>
                    <p>Sua conta foi enviada para aprovação... Logo iremos liberar todas<br>as funcionalidades para utilização!<br><br>Uma notificação será enviada ao envelope localizado no canto superior esquerdo.</p>
                </div>
            </div>

        <?php } ?>
    </div>

</body>

<script type="text/javascript" src="../js/engine.js"></script>

</html>