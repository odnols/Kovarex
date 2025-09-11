<?php require_once "conexao_banco.php";

$options = [
    'cost' => 12,
];

$email = $_POST["email"];

$resultado = $conexao->query("SELECT * FROM usuario WHERE email LIKE '$email'");

if ($resultado->num_rows) {
    $linha = $resultado->fetch_assoc();

    if (password_verify($_POST["senha"], $linha['hash'])) {

        // Verificando se a senha precisa ser atualizada com um novo hash
        if (password_needs_rehash($linha['hash'], PASSWORD_BCRYPT, $options)) {

            // Atualizando o hash do usuário para o formato mais recente de dados
            $newHash = password_hash($_POST["senha"], PASSWORD_BCRYPT, $options);

            $conexao->query("UPDATE usuario WHERE email = '$email' SET HASH = '$newHash'");
        }

        // Efetuando o login no sistema
        session_start();
        $_SESSION["logado"] = 1;
        $_SESSION["id_user"] = $linha["id"];
        $_SESSION["nome"] = $linha["nome"];
        $_SESSION["hierarquia"] = $linha["hierarquia"];

        if (isset($_POST["codigo_empenho"])) // Login solicitado a partir da tela de empenho
            $_SESSION["codigo_empenho"] = $_POST["codigo_empenho"];

        // Redirecionando para o usuário trocar a senha de acesso
        if ($linha["alterar_psw"] == 1) header("Location: /kovarex/php/cache/alterar_senha.php");
        else header("Location: /kovarex/pages/panel.php");
    } else
        header("Location: /kovarex/index.php?ERROR=001");
} else
    header("Location: /kovarex/index.php?ERROR=001");
