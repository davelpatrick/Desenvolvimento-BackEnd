<?php

if (!defined('DB_PATH')) {
    define('DB_PATH', '/var/www/database/bd.txt');
}

$alunos = [];
if (file_exists(DB_PATH)) {
    $file_content = file(DB_PATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($file_content as $line) {
        list($nome, $email, $data_nascimento) = explode('|', $line);
        $alunos[] = [
            'nome' => $nome,
            'email' => $email,
            'data_nascimento' => $data_nascimento
        ];
    }
}

require '/var/www/app/views/usuarios/gerenciar_alunos.phtml';
?>
