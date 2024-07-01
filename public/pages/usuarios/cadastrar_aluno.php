<?php

require_once '/var/www/app/Models/Diretor.php';

$diretor = new Diretor();
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["nome"], $_POST["email"], $_POST["data_nascimento"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $dataNascimento = $_POST["data_nascimento"];

        if ($diretor->cadastrarAluno($nome, $email, $dataNascimento)) {
            header('Location: diretor.php');
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
