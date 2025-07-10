<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$nome = $_POST["input_nome_unidade"];
$sigla = $_POST["input_sigla_unidade"];

$sigla = strtoupper($sigla);

$verifica = $conexao->query("SELECT * FROM unidade WHERE nome = '$nome'");

if ($verifica->num_rows > 0) // Unidade informado já existe
    header("Location: ../../pages/moderacao/unidades.php");

// Inserindo a nova unidade no banco
$conexao->query("INSERT INTO unidade (nome, sigla) VALUES ('$nome', '$sigla')");

header("Location: ../../pages/moderacao/unidades.php");
