<?php require_once "conexao_banco.php";

$email = $_POST["email"];
$controle = 0;

// Verificando se não existe usuário com o mesmo e-mail cadastrado
$verifica = "SELECT * FROM usuario where email like '$email'";
$executa = $conexao->query($verifica);

if (!$executa->num_rows) {

    $nome_usuario = $_POST["nome"];
    $hierarquia = 0;

    $options = [
        'cost' => 12
    ];

    // Gerando a hash da senha para o novo usuário
    $senha = password_hash($_POST["senha"], PASSWORD_BCRYPT, $options);

    $cadastro = "INSERT INTO usuario (id, email, nome, hash, hierarquia) values (null, '$email', '$nome_usuario', '$senha', $hierarquia)";
    $executa_cadastro = $conexao->query($cadastro);

    // Realizando o login automaticamente após completar o cadastro
    $query = "SELECT * FROM usuario where email like '$email'";
    $resultado = $conexao->query($query);

    if ($resultado->num_rows > 0 && $controle == 0) {
        while ($linha = $resultado->fetch_assoc()) {

            session_start();
            $_SESSION["logado"] = 1;
            $_SESSION["id"] = $linha["id"];
            $_SESSION["nome"] = $nome_usuario;
            $_SESSION["hierarquia"] = 0;

            header("Location: ../../pages/panel.php");
        }
    }
} else
    header("Location: ../../index.php?ERROR=003");
