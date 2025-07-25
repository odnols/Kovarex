<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Moderação</title>
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
        <div id="buttons_navegacao_index">
            <div class="quadro_pag sombra_quadro">
                <h3><i class="fa fa-solid fa-user"></i> Usuários</h3>
                <hr>
                <p>Gerencie os usuários.</p>

                <br>
                <a href="moderacao/usuarios.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Ver todos os usuários ></a>
            </div>

            <div class="quadro_pag sombra_quadro">
                <h3><i class="fa fa-solid fa-industry"></i> Fornecedores</h3>
                <hr>
                <p>Gerencie os fornecedores.</p>

                <br>
                <a href="moderacao/fornecedores.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Ver todos os fornecedores ></a>
            </div>

            <div class="quadro_pag sombra_quadro">
                <h3><i class="fa fa-solid fa-file-contract"></i> Licitações</h3>
                <hr>
                <p>Gerencie licitações, relação de itens, quantidades e departamentos solicitantes.</p>

                <br>
                <a href="licitacoes.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Gerenciar licitações ></a>
            </div>

            <div class="quadro_pag sombra_quadro">
                <h3><i class="fa fa-solid fa-cube"></i> Itens</h3>
                <hr>
                <p>Gerencie os itens.</p>

                <br>
                <a href="./moderacao/itens.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Gerenciar itens ></a>
            </div>

            <div class="quadro_pag sombra_quadro">
                <h3><i class="fa fa-solid fa-warehouse"></i></i> Departamentos</h3>
                <hr>
                <p>Gerencie os departamentos.</p>

                <br>
                <a href="./moderacao/departamentos.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Gerenciar departamentos ></a>
            </div>

            <div class="quadro_pag sombra_quadro">
                <h3><i class="fa fa-solid fa-ruler"></i> Unidades</h3>
                <hr>
                <p>Gerencie as unidades de medida e categorias de itens.</p>

                <br>
                <a href="./moderacao/unidades.php" class="button_add_pedido bttn_atalhos_panel cinza large_button">Gerenciar unidades ></a>
            </div>
        </div>
    </div>

    <footer id="footer">
        <h2 style="float: right;">Kovarex</h2>
    </footer>
</body>

<script type="text/javascript" src="../js/engine.js"></script>

</html>