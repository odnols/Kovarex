<?php require_once "conexao_obsoleta.php";

$nome_usuario = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$hierarquia = 0;
$controle = 0;

// Verificando se não existe usuário com o mesmo e-mail
$verifica = "SELECT * FROM usuario";
$executa = $conexao->query($verifica);

if ($executa->num_rows > 0) {
    while ($existe = $executa->fetch_assoc()) {
        if ($email == $existe["email"])
            $controle += 1;
    }
}

if ($controle == 0) {
    $cadast = "INSERT INTO usuario (id, email, nome, psw, hierarquia) values (null, '$email', '$nome_usuario', '$senha', $hierarquia)";
    $executa_cadastro = $conexao->query($cadast);

    // Fazendo o login automaticamente após completar o cadastro
    $query = "SELECT * FROM usuario where email = '$email' and psw = '$senha';";
    $resultado = $conexao->query($query);

    if ($resultado->num_rows > 0 && $controle == 0) {
        while ($linha = $resultado->fetch_assoc()) {

            session_start();
            $_SESSION["logado"] = 1;
            $_SESSION["id"] = $linha["id"];
            $_SESSION["nome"] = $linha["nome"];
            $_SESSION["hierarquia"] = $linha["hierarquia"];

            header("Location: ../../pages/panel.php");
        }
    }
} else
    header("Location: ../../index.php?ERROR=003");
