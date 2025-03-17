<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_POST["input_id"];
$nome = $_POST["input_nome"];

// Atualizando o nome do tipo de item
$conexao->query("UPDATE tipo_item SET nome = '$nome' WHERE id = $id");

header("Location: ../../pages/moderacao/unidades.php");
