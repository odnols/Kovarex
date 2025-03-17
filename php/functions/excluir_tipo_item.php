<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_GET["input_id"];

$dados_atribuicao = $conexao->query("SELECT * FROM item WHERE id_tipo_item = $id");

if ($dados_atribuicao->num_rows < 1) // Excluindo o tipo de item
    $conexao->query("DELETE FROM tipo_item WHERE id = $id");

header("Location: ../../pages/moderacao/unidades.php");
