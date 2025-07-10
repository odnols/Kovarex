<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Kovarex - Licitações</title>
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

    <div id="buttons_navegacao" class="sombra_quadro">
        <button class="badge button_filtro" onclick="filtra_itens('alimenticio_estocavel')">Alimentícios estocáveis</button>
        <button class="badge button_filtro" onclick="filtra_itens('produto_limpeza')">Produtos de limpeza</button>
        <button class="badge button_filtro" onclick="filtra_itens('item_informatica')">Informática</button>
        <button class="badge button_filtro" onclick="filtra_itens('insumo_pintura')">Insumos de pintura</button>
        <button class="badge button_filtro" onclick="filtra_itens()">Limpar filtro</button>
    </div>

    <div id="quadro_fundo">

        <div class="cabecalho_infos">
            <h3>Nome do item</h3>
            <h3>Unidade de medida</h3>
            <h3>Forma de envio</h3>
            <h3>Expiração</h3>
        </div>

        <div class="categoria_item alimenticio_estocavel">
            <h2>Alimentícios estocáveis</h2>

            <div class="item_card">
                <p>Leite integral</p>
                <p>litro</p>
                <p>fardo com 12 litros</p>
                <span class="badge_tempo vermelho">Em 23 de agosto de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Açúcar refinado</p>
                <p>kg</p>
                <p>pacote</p>
                <span class="badge_tempo preto">Expirou em 02 de agosto de 2023</span>
                <a href="#" class="button_add_pedido preto">Expirado</a>
            </div>

            <div class="item_card">
                <p>Açúcar</p>
                <p>kg</p>
                <p>fardo com 12 litros</p>
                <span class="badge_tempo preto">Expirou em 02 de agosto de 2023</span>
                <a href="#" class="button_add_pedido preto">Expirado</a>
            </div>

            <div class="item_card">
                <p>Café moido em pó</p>
                <p>pacote</p>
                <p>pacote com 500gr</p>
                <span class="badge_tempo verde">Em 18 de abril de 2024</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Chá mate</p>
                <p>pacote</p>
                <p>pacote com 250gr</p>
                <span class="badge_tempo verde">Em 18 de abril de 2024</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>
        </div>

        <div class="categoria_item produto_limpeza">
            <h2>Produtos de limpeza</h2>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Papel higiênico</p>
                    <p>Branco folha dupla, de 30m x 10 cm cada com folha dupla de alta qualidade, neutro, testado dermatologicamente</p>
                </div>
                <p>fardo</p>
                <p>fardo com 16 pacotes <br>(64 rolos)</p>
                <span class="badge_tempo vermelho">Em 25 de agosto de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Copo descartável</p>
                    <p>P/ água 180ml. Feito em polipropileno (pp), na cor branca, para consumo de água, sucos e refrigerantes, capacidade 180 ml, atóxico, fabricado de acordo com a nbr 14865, embalados em pacotes plásticos com 100 unidades e acondicionados em caixas de papelão com 25 centos. Deverá ter impresso nas caixas do produto o selo de aprovação abnt nbr</p>
                </div>
                <p>caixa</p>
                <p>caixa com 2.500 copos</p>
                <span class="badge_tempo vermelho">Em 25 de agosto de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>
        </div>

        <div class="categoria_item item_informatica">
            <h2>Informática</h2>

            <div class="item_card">
                <p>SSD 500GB</p>
                <p>unidade</p>
                <p>unidade</p>
                <span class="badge_tempo verde">Em 03 de agosto de 2024</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>
        </div>

        <div class="categoria_item insumo_pintura">
            <h2>Insumos para pintura</h2>

            <div class="item_card">
                <p>Resina acrílica p/ pedras</p>
                <p>galão</p>
                <p>galão com 3,6 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Resina acrílica p/ pedras</p>
                <p>lata</p>
                <p>lata com 18 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Selador acrílico</p>
                <p>lata</p>
                <p>lata com 3,6 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Massa niveladora </p>
                <p>galão</p>
                <p>25kg</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Massa acrílica</p>
                <p>kg</p>
                <p>25kg</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Manta Líquida</p>
                <p>litro</p>
                <p>lata com 18 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Selador acrílico</p>
                <p>lata</p>
                <p>lata com 3,6L</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Massa niveladora</p>
                    <p>Ambientes internos e externos</p>
                </div>
                <p>galão</p>
                <p>galão com 3,6 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Tinta acrílica premium</p>
                    <p>Tinta para pisos e pavimentos; diversas cores</p>
                </div>
                <p>lata</p>
                <p>lata com 18 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Tinta esmalte sintético premium</p>
                    <p>Alto brilho, tinta para construção civil; diversas cores</p>
                </div>
                <p>galão</p>
                <p>galão com 3,6 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Tinta látex acrílica premium</p>
                    <p>Para uso em parede; diversas cores</p>
                </div>
                <p>lata</p>
                <p>lata com 18 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Tinta p/ demarcação viária</p>
                    <p>Com médio volume de tráfego</p>
                </div>
                <p>lata</p>
                <p>lata com 18 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Tinta acrílica premium</p>
                    <p>Tinta para pisos e pavimentos; diversas cores</p>
                </div>
                <p>galão</p>
                <p>galão com 3,6 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <div>
                    <p class="titulo_item">Tinta látex PVA premium</p>
                    <p>Para uso em parede; diversas cores</p>
                </div>
                <p>lata</p>
                <p>lata com 18 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Tinta Epóxi</p>
                <p>galão</p>
                <p>galão com 3,6 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>

            <div class="item_card">
                <p>Impermeabilizante</p>
                <p>lata</p>
                <p>lata com 18 litros</p>
                <span class="badge_tempo laranja">Em 1° de novembro de 2023</span>
                <a href="#" class="button_add_pedido cinza">Fazer pedido ></a>
            </div>
        </div>
    </div>

    <footer id="footer">
        <h2 style="float: right;">Kovarex</h2>
    </footer>
</body>

<script type="text/javascript" src="../js/engine.js"></script>

</html>