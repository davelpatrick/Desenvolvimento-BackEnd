<?php
if (isset($_POST['id'])) {
    $idParaApagar = $_POST['id'];


    define('DB_PATH', '/var/www/database/bd.txt');


    $alunos = carregarAlunos();

    $indiceParaRemover = null;
    foreach ($alunos as $index => $aluno) {
        if ($aluno['id'] == $idParaApagar) {
            $indiceParaRemover = $index;
            break;
        }
    }


    if ($indiceParaRemover !== null) {
        unset($alunos[$indiceParaRemover]);

        $lines = [];
        foreach ($alunos as $aluno) {
            $lines[] = implode('|', $aluno);
        }
        $content = implode(PHP_EOL, $lines);

       
        if (file_put_contents(DB_PATH, $content)) {

            header('Location: gerenciar_alunos.php');
        } else {
            $erro = "Erro ao apagar o aluno.";
        }
    } else {
        $erro = "Aluno não encontrado.";
    }
} else {
    
    $erro = "ID do aluno não especificado.";
}

function carregarAlunos() {
    $alunos = [];
    $lines = file(DB_PATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $dados = explode('|', $line);
        $alunos[] = [
            'id' => $dados[0],
            'nome' => $dados[1],
            'email' => $dados[2],
            'data_nascimento' => $dados[3]
        ];
    }
    return $alunos;
}

header('Location: gerenciar_alunos.php');
exit;
?>
