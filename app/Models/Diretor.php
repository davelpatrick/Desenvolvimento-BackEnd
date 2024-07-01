<?php

require_once 'Aluno.php';

class Diretor
{
    const DB_PATH = '/var/www/database/bd.txt';

    public function cadastrarAluno($nome, $email, $dataNascimento)
    {
        $aluno = new Aluno($nome, $email, $dataNascimento);
        $linha = $aluno->getId() . '|' . $aluno->getNome() . '|' . $aluno->getEmail() . '|' . $aluno->getDataNascimento() . PHP_EOL;
        return file_put_contents(self::DB_PATH, $linha, FILE_APPEND);
    }

    public function todosAlunos()
    {
        $alunos = [];
        if (file_exists(self::DB_PATH)) {
            $linhas = file(self::DB_PATH, FILE_IGNORE_NEW_LINES);
            foreach ($linhas as $linha) {
                list($id, $nome, $email, $dataNascimento) = explode('|', $linha);
                $alunos[] = new Aluno($nome, $email, $dataNascimento, $id);
            }
        }
        return $alunos;
    }

    public function encontrarAlunoPorId($id)
    {
        $alunos = $this->todosAlunos();
        foreach ($alunos as $aluno) {
            if ($aluno->getId() === $id) {
                return $aluno;
            }
        }
        return null;
    }

    public function atualizarAluno($id, $nome, $email, $dataNascimento)
    {
        $alunos = $this->todosAlunos();
        $novoConteudo = '';

        foreach ($alunos as $aluno) {
            if ($aluno->getId() === $id) {
                $novoConteudo .= $id . '|' . $nome . '|' . $email . '|' . $dataNascimento . PHP_EOL;
            } else {
                $novoConteudo .= $aluno->getId() . '|' . $aluno->getNome() . '|' . $aluno->getEmail() . '|' . $aluno->getDataNascimento() . PHP_EOL;
            }
        }

        return file_put_contents(self::DB_PATH, $novoConteudo);
    }

    public function deletarAluno($id)
    {
        $alunos = $this->todosAlunos();
        $indiceParaRemover = null;

        foreach ($alunos as $index => $aluno) {
            if ($aluno->getId() == $id) {
                $indiceParaRemover = $index;
                break;
            }
        }

        if ($indiceParaRemover !== null) {
            unset($alunos[$indiceParaRemover]);

            $lines = [];
            foreach ($alunos as $aluno) {
                $lines[] = implode('|', [$aluno->getId(), $aluno->getNome(), $aluno->getEmail(), $aluno->getDataNascimento()]);
            }

            $content = implode(PHP_EOL, $lines);

            if (file_put_contents(self::DB_PATH, $content)) {
                return true; // Deleção bem-sucedida
            } else {
                return false; // Erro ao salvar no arquivo
            }
        } else {
            return false; // Aluno não encontrado
        }
    }
}

?>
