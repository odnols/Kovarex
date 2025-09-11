<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$nome = $_POST["input_nome_item"];
$descricao = $_POST["input_descricao_item"];
$unidade_medida = $_POST["input_unidade_medida"];
$tipo_item = $_POST["input_tipo_item"];

$verifica = $conexao->query("SELECT * FROM item WHERE nome = '$nome'");

if ($verifica->num_rows) // Item informado já existe
    header("Location: ../../pages/moderacao/itens.php");

// Inserindo o novo item no banco
$conexao->query("INSERT INTO item (nome, descricao, id_unidade, id_tipo_item) VALUES ('$nome', '$descricao', $unidade_medida, $tipo_item)");

header("Location: ../../pages/moderacao/itens.php");
