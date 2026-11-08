<?php
// Configurar estas variáveis via variáveis de ambiente em produção
$servidor = getenv('DB_HOST') ?: "localhost";
$user = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASSWORD') ?: "";
$banco = getenv('DB_NAME') ?: "kovarex";

$conexao = new mysqli($servidor, $user, $password, $banco);

if ($conexao->connect_error) {
    error_log("Erro de conexão ao banco: " . $conexao->connect_error);
    die("Falha na conexão com o banco de dados.");
}

mysqli_set_charset($conexao, "utf8mb4");

