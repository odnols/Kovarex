<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$nome = $_POST["input_nome"];
$cor_destaque = $_POST["input_cor_destaque"];

$verifica = $conexao->query("SELECT * FROM departamento where nome = '$nome'");

if ($verifica->num_rows > 0) // Fornecedor com o CNPJ ou CPF informado já existe
    header("Location: ../../pages/moderacao/departamentos.php");

// Inserindo o novo fornecedor no banco
$conexao->query("INSERT INTO departamento (nome, cor_destaque) VALUES ('$nome', '$cor_destaque')");

header("Location: ../../pages/moderacao/departamentos.php");
