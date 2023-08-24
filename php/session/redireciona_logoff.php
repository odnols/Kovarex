<?php require_once "conexao_banco.php";

session_start();

// Deletando a sessão
session_unset();
session_destroy();

header("Location: ../../index.php");
