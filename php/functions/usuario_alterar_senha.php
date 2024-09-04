<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id_user = $_SESSION["id"];

$options = [
    'cost' => 12
];

// Gerando a hash da senha para o usuário e atualizando no banco de dados
$senha = password_hash($_POST["senha"], PASSWORD_BCRYPT, $options);
$conexao->query("UPDATE usuario set hash = '$senha', alterar_psw = false WHERE id = $id_user");

header("Location: ../../pages/panel.php");
