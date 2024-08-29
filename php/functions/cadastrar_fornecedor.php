<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$cnpj = $_POST["input_cnpj"];
$razao = $_POST["input_razao_social"];

// Deixando a razão social em maiusculo
$razao = strtoupper($razao);

$verifica_fornecedor = "SELECT * FROM empresa where cnpj = '$cnpj'";
$verifica = $conexao->query($verifica_fornecedor);

if ($verifica->num_rows > 0) // Fornecedor com o CNPJ ou CPF informado já existe
    header("Location: ../../pages/moderacao/fornecedores.php");

// Inserindo o novo fornecedor no banco
$insere_fornecedor = "INSERT INTO empresa (razao_social, cnpj) VALUES ('$razao', '$cnpj')";
$conexao->query($insere_fornecedor);

header("Location: ../../pages/moderacao/fornecedores.php");
