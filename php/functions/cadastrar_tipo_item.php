<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$nome = $_POST["input_nome_tipo_item"];

$verifica = $conexao->query("SELECT * FROM tipo_item where nome = '$nome'");

if ($verifica->num_rows > 0) // Tipo de item informado já existe
    header("Location: ../../pages/moderacao/unidades.php");

// Inserindo o novo tipo de item no banco
$conexao->query("INSERT INTO tipo_item (nome) VALUES ('$nome')");

header("Location: ../../pages/moderacao/unidades.php");
