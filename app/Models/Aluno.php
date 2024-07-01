<?php

class Aluno
{
    private $id;
    private $nome;
    private $email;
    private $dataNascimento;

    public function __construct($nome, $email, $dataNascimento, $id = null)
    {
        $this->id = $id ?? uniqid();
        $this->nome = $nome;
        $this->email = $email;
        $this->dataNascimento = $dataNascimento;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
}

?>
