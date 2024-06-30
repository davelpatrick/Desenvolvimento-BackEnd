<?php

define('DB_PATH', '/var/www/database/bd.txt');

$method = $_SERVER['REQUEST_METHOD'];
$erro = '';
$mensagem = '';

if ($method === 'POST') {
    if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["data_nascimento"])) {
        $name = $_POST["nome"];
        $email = $_POST["email"];
        $data_nascimento = $_POST["data_nascimento"];

        $line = $name . '|' . $email . '|' . $data_nascimento . PHP_EOL;

        if (file_put_contents(DB_PATH, $line, FILE_APPEND)) {
            $mensagem = "Aluno cadastrado com sucesso!";
            header('Location: /pages/usuarios/diretor.php');
            exit;
        } else {
            $erro = "Erro ao cadastrar o aluno.";
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}

require '/var/www/app/views/usuarios/cadastrar_aluno.phtml';
?>
