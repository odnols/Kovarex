<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_GET["input_id"];

$dados_atribuicao = $conexao->query("SELECT * FROM item_pedido WHERE id_item = $id");

if ($dados_atribuicao->num_rows < 1) // Excluindo o item mencionado
    $conexao->query("DELETE FROM item WHERE id = $id");

header("Location: ../../pages/moderacao/itens.php");
