<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_POST["input_id"];
$cnpj = $_POST["input_cnpj"];
$razao = $_POST["input_razao_social"];

// Deixando a razão social em maiusculo
$razao = strtoupper($razao);

$atualiza_fornecedor = "UPDATE empresa SET cnpj = '$cnpj', razao_social = '$razao' WHERE id = $id";
$conexao->query($atualiza_fornecedor);

header("Location: ../../pages/moderacao/fornecedores.php");
