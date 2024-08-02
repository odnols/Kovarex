<?php require_once "conexao_banco.php";

$options = [
    'cost' => 12,
];

// $email = password_verify($_POST["email"], '$2y$12$f2ZpbdKW3iosnEt9M3Jpk.ILMziU5B8NX/ANWn5lEWGnavxg/thsK');
// $senha = password_verify($_POST["senha"], '$2y$12$dyoPe0O4l32PTY7CFRppguTaRyMjkSYAAGpGmWskGj7icMtSOI2AC');

$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "SELECT * FROM usuario where email = '$email' and psw = '$senha'";
$resultado = $conexao->query($query);

if ($resultado->num_rows > 0) {
    $linha = $resultado->fetch_assoc();

    session_start();
    $_SESSION["logado"] = 1;
    $_SESSION["id"] = $linha["id"];
    $_SESSION["nome"] = $linha["nome"];
    $_SESSION["hierarquia"] = $linha["hierarquia"];

    header("Location: ../../pages/panel.php");
} else // Banco de Dados de usuários vazio
    header("Location: ../../index.php?ERROR=001");
