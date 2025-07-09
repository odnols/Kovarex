<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_POST["input_id"];
$nome = $_POST["input_nome"];
$descricao = $_POST["input_descricao"];
$id_unidade = $_POST["input_unidade_medida"];
$id_tipo_item = $_POST["input_tipo_item"];

// Atualizando dados do item
$conexao->query("UPDATE item SET nome = '$nome', descricao = '$descricao', id_unidade = $id_unidade, id_tipo_item = $id_tipo_item WHERE id = $id");

header("Location: ../../pages/moderacao/itens.php");
