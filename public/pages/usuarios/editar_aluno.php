<?php

require_once '/var/www/app/Models/Diretor.php';

$diretor = new Diretor();
$id = isset($_GET['id']) ? $_GET['id'] : null;

$aluno = $diretor->encontrarAlunoPorId($id);

if (!$aluno) {
    die('Aluno não encontrado.');
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'], $_POST['email'], $_POST['data_nascimento'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $dataNascimento = $_POST['data_nascimento'];

        if ($diretor->atualizarAluno($id, $nome, $email, $dataNascimento)) {
            header('Location: gerenciar_alunos.php');
            exit;
        } else {
            $erro = "Erro ao atualizar o aluno.";
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}

require '/var/www/app/views/usuarios/editar_aluno.phtml';

?>
