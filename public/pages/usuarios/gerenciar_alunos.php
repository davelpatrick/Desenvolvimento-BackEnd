<?php

define('DB_PATH', '/var/www/database/bd.txt');

$alunos = [];
if (file_exists(DB_PATH)) {
    $file_content = file(DB_PATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($file_content as $line) {
        $fields = explode('|', $line);
        if (count($fields) === 4) {
            list($id, $nome, $email, $data_nascimento) = $fields;
            $alunos[] = [
                'id' => $id,
                'nome' => $nome,
                'email' => $email,
                'data_nascimento' => $data_nascimento
            ];
        }
    }
}


require '/var/www/app/views/usuarios/gerenciar_alunos.phtml';

?>




