<?php

// src\Models\usuario.php

class Usuario{

    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo;
    private ?int $id;

    public function __construct(
        string $valorNome,
        string $valorEmail,
        string $valorSenha,
        string $valorTipo,
        ?int $valorId = null
    ) {

        $this-> setNome($valorNome);
        $this-> setEmail($valorEmail);
        $this-> setSenha($valorSenha);
        $this-> setTipo($valorTipo);
        $this-> setId($valorId);
        
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getId(){
        return $this->id;
    }


    private function setNome(string $valorNome):void{
        $this->nome = $valorNome;
    }

    private function setEmail(string $valorEmail):void{
        $this->email = $valorEmail;
    }

    private function setSenha(string $valorSenha):void{
        $this->senha = $valorSenha;
    }

    private function setTipo(string $valorTipo):void{
        $this->tipo = $valorTipo;
    }
    
    private function setId(string $valorId):void{
        $this->id = $valorId;
    }
}