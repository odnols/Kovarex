<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_POST["input_id"];
$nome = $_POST["input_nome"];
$email = $_POST["input_email"];

$departamentos = "SELECT * FROM departamento";
$dados_departamento = $conexao->query($departamentos);

$departamentos = [];
$atribuicoes = [];
$atribuidos = [];

// Listando todos os departamentos
if ($dados_departamento->num_rows > 0)
    while ($dados_atr_interno = $dados_departamento->fetch_assoc())
        array_push($departamentos, $dados_atr_interno["id"]);

$departamentos_atribuidos = "SELECT * FROM atribuicao WHERE id_usuario = $id";
$dados_atribuicao = $conexao->query($departamentos_atribuidos);

// Listando todos os departamentos do usuário
if ($dados_atribuicao->num_rows > 0)
    while ($dados_atr_interno = $dados_atribuicao->fetch_assoc())
        array_push($atribuicoes, $dados_atr_interno["id_departamento"]);

foreach ($_POST["input_atribuicoes"] as $atribuicao) {

    // Departamento não está na lista de atribuições e foi atribuído ao usuário
    if (!in_array($atribuicao, $atribuicoes)) $conexao->query("INSERT INTO atribuicao (id_usuario, id_departamento) VALUES ($id, $atribuicao)");
    else array_push($atribuidos, $atribuicao);
}

foreach ($departamentos as $id) {

    if (!in_array($id, $atribuidos)) $conexao->query("DELETE FROM atribuicao WHERE id_usuario = $id AND id_departamento = $atribuicao");
}

$atualiza_usuario = "UPDATE usuario SET nome = '$nome', email = '$email' WHERE id = $id";
$conexao->query($atualiza_usuario);

header("Location: ../../pages/moderacao/usuarios.php");
