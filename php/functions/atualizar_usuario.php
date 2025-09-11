<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id = $_POST["input_id"];
$nome = $_POST["input_nome"];
$email = $_POST["input_email"];

$atribuidos = [];
$atribuicoes = [];
$departamentos = [];

if (isset($_POST["input_atribuicoes"])) {
    $dados_departamento = $conexao->query("SELECT * FROM departamento");

    // Listando todos os departamentos
    if ($dados_departamento->num_rows)
        while ($dados_atr_interno = $dados_departamento->fetch_assoc())
            array_push($departamentos, $dados_atr_interno["id"]);

    $dados_atribuicao = $conexao->query("SELECT * FROM atribuicao WHERE id_usuario = $id");

    if ($dados_atribuicao->num_rows) // Listando todos os departamentos do usuário
        while ($dados_atr_interno = $dados_atribuicao->fetch_assoc())
            array_push($atribuicoes, $dados_atr_interno["id_departamento"]);

    // Listando os departamentos selecionados
    foreach ($_POST["input_atribuicoes"] as $atribuicao)
        array_push($atribuidos, $atribuicao);

    foreach ($departamentos as $id_departamento) {

        // Departamento não está na lista de atribuições e foi atribuído ao usuário
        if (in_array($id_departamento, $atribuidos)) {
            if (!in_array($id_departamento, $atribuicoes))
                $conexao->query("INSERT INTO atribuicao (id_usuario, id_departamento) VALUES ($id, $id_departamento)");
        } else $conexao->query("DELETE FROM atribuicao WHERE id_usuario = $id AND id_departamento = $id_departamento");
    }
} else // Remove todas as atribuições ligadas a um usuário
    $conexao->query("DELETE FROM atribuicao WHERE id_usuario = $id");

// Atualizando o nome e e-mail do usuário
$conexao->query("UPDATE usuario SET nome = '$nome', email = '$email' WHERE id = $id");

header("Location: ../../pages/moderacao/usuarios.php");
