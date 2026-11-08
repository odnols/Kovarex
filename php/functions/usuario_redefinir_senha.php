<?php
session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

if (!isset($_SESSION["hierarquia"]) || !$_SESSION["hierarquia"]) {
    header("Location: ../../index.php?ERROR=401");
    exit;
}

$id_user = (int) ($_POST["id_user"] ?? 0);
$senha = $_POST["senha"] ?? '';

if (!$id_user || !$senha || strlen($senha) < 8) {
    header("Location: ../../pages/moderacao/usuarios.php?ERROR=invalid");
    exit;
}

$options = ['cost' => 12];
$hash_senha = password_hash($senha, PASSWORD_BCRYPT, $options);

$stmt = $conexao->prepare("UPDATE usuario SET hash = ?, alterar_psw = 1 WHERE id = ?");
if (!$stmt) {
    error_log("Erro na preparação da query: " . $conexao->error);
    header("Location: ../../pages/moderacao/usuarios.php?ERROR=db");
    exit;
}

$stmt->bind_param("si", $hash_senha, $id_user);
if (!$stmt->execute()) {
    error_log("Erro ao atualizar senha: " . $stmt->error);
    $stmt->close();
    header("Location: ../../pages/moderacao/usuarios.php?ERROR=update");
    exit;
}
$stmt->close();

header("Location: ../../pages/moderacao/usuarios.php?success=1");

