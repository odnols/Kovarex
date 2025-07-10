<?php session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

$id_user = $_POST["id_user"];

$options = [
    'cost' => 12
];

// Gerando a hash da senha para o usuário e atualizando no banco de dados
$senha = password_hash($_POST["senha"], PASSWORD_BCRYPT, $options);
$conexao->query("UPDATE usuario SET hash = '$senha', alterar_psw = true WHERE id = $id_user");

header("Location: ../../pages/moderacao/usuarios.php");
