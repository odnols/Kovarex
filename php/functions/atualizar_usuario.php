<?php
session_start();

require_once "../session/verifica_sessao.php";
require_once "../session/conexao_banco.php";

if (!isset($_SESSION["hierarquia"]) || !$_SESSION["hierarquia"]) {
    header("Location: ../../index.php?ERROR=401");
    exit;
}

$id = (int) ($_POST["input_id"] ?? 0);
$nome = $_POST["input_nome"] ?? '';
$email = filter_var($_POST["input_email"] ?? '', FILTER_SANITIZE_EMAIL);

if (!$id || !$nome || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../pages/moderacao/usuarios.php?ERROR=invalid");
    exit;
}

$atribuidos = [];
$atribuicoes = [];
$departamentos = [];

if (isset($_POST["input_atribuicoes"]) && is_array($_POST["input_atribuicoes"])) {
    $stmtDept = $conexao->prepare("SELECT id FROM departamento ORDER BY id ASC");
    $stmtDept->execute();
    $dados_departamento = $stmtDept->get_result();
    $stmtDept->close();

    if ($dados_departamento->num_rows) {
        while ($dados_dpt = $dados_departamento->fetch_assoc()) {
            $departamentos[] = (int) $dados_dpt["id"];
        }
    }

    $stmtAtrib = $conexao->prepare("SELECT id_departamento FROM atribuicao WHERE id_usuario = ?");
    $stmtAtrib->bind_param("i", $id);
    $stmtAtrib->execute();
    $dados_atribuicao = $stmtAtrib->get_result();
    $stmtAtrib->close();

    if ($dados_atribuicao->num_rows) {
        while ($dados_atr = $dados_atribuicao->fetch_assoc()) {
            $atribuicoes[] = (int) $dados_atr["id_departamento"];
        }
    }

    foreach ($_POST["input_atribuicoes"] as $atribuicao) {
        $atribuicao_int = (int) $atribuicao;
        if (in_array($atribuicao_int, $departamentos)) {
            $atribuidos[] = $atribuicao_int;
        }
    }

    foreach ($departamentos as $id_departamento) {
        if (in_array($id_departamento, $atribuidos)) {
            if (!in_array($id_departamento, $atribuicoes)) {
                $stmtIns = $conexao->prepare("INSERT INTO atribuicao (id_usuario, id_departamento) VALUES (?, ?)");
                $stmtIns->bind_param("ii", $id, $id_departamento);
                $stmtIns->execute();
                $stmtIns->close();
            }
        } else {
            $stmtDel = $conexao->prepare("DELETE FROM atribuicao WHERE id_usuario = ? AND id_departamento = ?");
            $stmtDel->bind_param("ii", $id, $id_departamento);
            $stmtDel->execute();
            $stmtDel->close();
        }
    }
} else {
    $stmtDelAll = $conexao->prepare("DELETE FROM atribuicao WHERE id_usuario = ?");
    $stmtDelAll->bind_param("i", $id);
    $stmtDelAll->execute();
    $stmtDelAll->close();
}

$stmt = $conexao->prepare("UPDATE usuario SET nome = ?, email = ? WHERE id = ?");
if (!$stmt) {
    error_log("Erro na preparação da query: " . $conexao->error);
    header("Location: ../../pages/moderacao/usuarios.php?ERROR=db");
    exit;
}

$stmt->bind_param("ssi", $nome, $email, $id);
if (!$stmt->execute()) {
    error_log("Erro ao atualizar usuário: " . $stmt->error);
    $stmt->close();
    header("Location: ../../pages/moderacao/usuarios.php?ERROR=update");
    exit;
}
$stmt->close();

header("Location: ../../pages/moderacao/usuarios.php?success=1");

