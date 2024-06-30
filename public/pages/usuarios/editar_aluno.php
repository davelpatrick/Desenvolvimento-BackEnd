<?php

define('DB_PATH', '/var/www/database/bd.txt');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$alunos = [];
if (file_exists(DB_PATH)) {
    $file_content = file(DB_PATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($file_content as $line) {
        $fields = explode('|', $line);
        if (count($fields) === 4) {
            list($aluno_id, $nome, $email, $data_nascimento) = $fields;
            $alunos[$aluno_id] = [
                'nome' => $nome,
                'email' => $email,
                'data_nascimento' => $data_nascimento
            ];
        }
    }
}

$aluno = isset($alunos[$id]) ? $alunos[$id] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'], $_POST['email'], $_POST['data_nascimento'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];

        $alunos[$id] = [
            'nome' => $nome,
            'email' => $email,
            'data_nascimento' => $data_nascimento
        ];

        $new_content = '';
        foreach ($alunos as $aluno_id => $aluno) {
            $new_content .= $aluno_id . '|' . $aluno['nome'] . '|' . $aluno['email'] . '|' . $aluno['data_nascimento'] . PHP_EOL;
        }

        file_put_contents(DB_PATH, $new_content);

        header('Location: gerenciar_alunos.php');
        exit;
    }
}

require '/var/www/app/views/usuarios/editar_aluno.phtml';

?>
