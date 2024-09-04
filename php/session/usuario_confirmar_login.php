<?php require_once "conexao_banco.php";

$options = [
    'cost' => 12,
];

$email = $_POST["email"];

$resultado = $conexao->query("SELECT * FROM usuario where email like '$email'");

if ($resultado->num_rows > 0) {
    $linha = $resultado->fetch_assoc();

    if (password_verify($_POST["senha"], $linha['hash'])) {

        // Verificando se a senha precisa ser atualizada com um novo hash
        if (password_needs_rehash($linha['hash'], PASSWORD_BCRYPT, $options)) {

            // Atualizando o hash do usuário para o formato mais recente de dados
            $newHash = password_hash($_POST["senha"], PASSWORD_BCRYPT, $options);

            $conexao->query("UPDATE usuario where email = '$email' set hash = '$newHash'");
        }

        // Efetuando o login no sistema
        session_start();
        $_SESSION["logado"] = 1;
        $_SESSION["id"] = $linha["id"];
        $_SESSION["nome"] = $linha["nome"];
        $_SESSION["hierarquia"] = $linha["hierarquia"];

        // Redirecionando para o usuário trocar a senha de acesso
        if ($linha["alterar_psw"] == 1) header("Location: ../cache/alterar_senha.php");
        else header("Location: ../../pages/panel.php");
    } else
        header("Location: ../../index.php?ERROR=001");
} else
    header("Location: ../../index.php?ERROR=001");
