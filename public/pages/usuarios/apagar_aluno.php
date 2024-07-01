<?php
require_once '/var/www/app/Models/Diretor.php';

$erro = '';


if (isset($_POST['id'])) {
    $idParaApagar = $_POST['id'];


    $diretor = new Diretor();


    if ($diretor->deletarAluno($idParaApagar)) {
        header('Location: gerenciar_alunos.php');
        exit;
    } else {
        $erro = "Erro ao apagar o aluno.";
    }
} else {
    $erro = "ID do aluno não especificado.";
}


header('Location: gerenciar_alunos.php?erro=' . urlencode($erro));
exit;
?>
