<?php
require_once "conexao_banco.php";

$options = [
    'cost' => 12,
];

$email = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL);
$senha = $_POST["senha"] ?? '';

if (!$email || !$senha) {
    header("Location: /kovarex/index.php?ERROR=001");
    exit;
}

$stmt = $conexao->prepare("SELECT id, nome, hash, hierarquia, alterar_psw FROM usuario WHERE email = ?");
if (!$stmt) {
    error_log("Erro na preparação da query: " . $conexao->error);
    header("Location: /kovarex/index.php?ERROR=001");
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows) {
    $linha = $resultado->fetch_assoc();

    if (password_verify($senha, $linha['hash'])) {

        if (password_needs_rehash($linha['hash'], PASSWORD_BCRYPT, $options)) {
            $newHash = password_hash($senha, PASSWORD_BCRYPT, $options);
            
            $updateStmt = $conexao->prepare("UPDATE usuario SET hash = ? WHERE id = ?");
            $updateStmt->bind_param("si", $newHash, $linha['id']);
            $updateStmt->execute();
            $updateStmt->close();
        }

        // Regenerar ID da sessão para evitar session fixation
        session_start();
        session_regenerate_id(true);
        
        $_SESSION["logado"] = 1;
        $_SESSION["id_user"] = $linha["id"];
        $_SESSION["id_usuario"] = $linha["id"];
        $_SESSION["nome"] = $linha["nome"];
        $_SESSION["hierarquia"] = $linha["hierarquia"];

        if (isset($_POST["codigo_empenho"])) {
            $_SESSION["codigo_empenho"] = preg_replace('/[^a-zA-Z0-9\-_]/', '', $_POST["codigo_empenho"]);
        }

        if ($linha["alterar_psw"] == 1) {
            header("Location: /kovarex/php/cache/alterar_senha.php");
        } else {
            header("Location: /kovarex/pages/panel.php");
        }
    } else {
        header("Location: /kovarex/index.php?ERROR=001");
    }
} else {
    header("Location: /kovarex/index.php?ERROR=001");
}

$stmt->close();

