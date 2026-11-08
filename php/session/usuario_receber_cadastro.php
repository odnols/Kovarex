<?php
require_once "conexao_banco.php";

$email = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL);
$nome = $_POST["nome"] ?? '';
$cnpj = preg_replace('/[^0-9]/', '', $_POST["cnpj"] ?? '');
$senha = $_POST["senha"] ?? '';

if (!$email || !$nome || !$senha || strlen($senha) < 8) {
    header("Location: ../../index.php?ERROR=002");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../index.php?ERROR=002");
    exit;
}

$stmt = $conexao->prepare("SELECT id FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $stmt->close();
    header("Location: ../../index.php?ERROR=003");
    exit;
}
$stmt->close();

$options = ['cost' => 12];
$hash_senha = password_hash($senha, PASSWORD_BCRYPT, $options);

$stmt = $conexao->prepare("INSERT INTO usuario (email, nome, hash, cnpj, hierarquia) VALUES (?, ?, ?, ?, 0)");
if (!$stmt) {
    error_log("Erro na preparação da query: " . $conexao->error);
    header("Location: ../../index.php?ERROR=999");
    exit;
}

$stmt->bind_param("ssss", $email, $nome, $hash_senha, $cnpj);
if (!$stmt->execute()) {
    error_log("Erro ao inserir usuário: " . $stmt->error);
    $stmt->close();
    header("Location: ../../index.php?ERROR=999");
    exit;
}
$stmt->close();

$stmt = $conexao->prepare("SELECT id, nome FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $linha = $resultado->fetch_assoc();
    
    session_start();
    session_regenerate_id(true);
    
    $_SESSION["logado"] = 1;
    $_SESSION["id_user"] = $linha["id"];
    $_SESSION["id_usuario"] = $linha["id"];
    $_SESSION["nome"] = $linha["nome"];
    $_SESSION["hierarquia"] = 0;

    $stmt->close();
    header("Location: ../../pages/panel.php");
} else {
    $stmt->close();
    header("Location: ../../index.php?ERROR=999");
}

