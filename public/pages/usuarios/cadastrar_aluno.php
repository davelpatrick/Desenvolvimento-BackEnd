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

        $id = uniqid();

        $line = $id . '|' . $name . '|' . $email . '|' . $data_nascimento . PHP_EOL;

        if (file_put_contents(DB_PATH, $line, FILE_APPEND)) {
            header('Location: diretor.php');
        } else {
            $erro = "Erro ao cadastrar o aluno.";
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}

require '/var/www/app/views/usuarios/cadastrar_aluno.phtml';

?>
