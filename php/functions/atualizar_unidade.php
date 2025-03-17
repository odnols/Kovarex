<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_POST["input_id"];
$nome = $_POST["input_nome"];
$sigla = $_POST["input_sigla"];

$sigla = strtoupper($sigla);

// Atualizando o nome e sigla da unidade
$conexao->query("UPDATE unidade SET nome = '$nome', sigla = '$sigla' WHERE id = $id");

header("Location: ../../pages/moderacao/unidades.php");
