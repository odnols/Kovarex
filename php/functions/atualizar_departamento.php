<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_POST["input_id"];
$nome = $_POST["input_nome"];
$cor_destaque = $_POST["input_cor_destaque"];

$conexao->query("UPDATE departamento SET nome = '$nome', cor_destaque = '$cor_destaque' WHERE id = $id");

header("Location: ../../pages/moderacao/departamentos.php");
