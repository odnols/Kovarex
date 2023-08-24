<?php require_once "conexao_obsoleta.php";

$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "SELECT * FROM usuario where email = '$email' and psw = '$senha'";
$resultado = $conexao->query($query);

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {

        $usuario = $linha["email"];
        $psw = $linha["psw"];

        //  Verifica se o email ou o id ou o telefone corresponte e se a senha está correta
        if ($email == $usuario && $senha == $psw) {

            session_start();
            $_SESSION["logado"] = 1;
            $_SESSION["id"] = $linha["id"];
            $_SESSION["nome"] = $linha["nome"];
            $_SESSION["hierarquia"] = $linha["hierarquia"];

            header("Location: ../../pages/panel.php");
        } else // Informações erradas
            header("Location: ../../index.php?ERROR=001");
    }
} else // Banco de Dados de usuários vazio
    header("Location: ../../index.php");
