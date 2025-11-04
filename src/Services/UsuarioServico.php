<?php

//src\Services\UsuarioServico.php

class UsuarioServico{
    private PDO $conexao;

    public function __construct(){

        /* Toda vez que criamos um objetos baseado na classe UsuarioServico, este objeto fará uma chamada ao método de conexão na classe Conecta */
        $this->conexao = Conecta::getConexao();
    }

    /* Métodos CRUD para Usuários */

    //Inserir (INSERT)
    public function inserir(Usuario $dadosDoUsuario):void{

        $sql = "INSERT INTO usuarios(nome, email, tipo, senha) VALUES (:nome, :email, :tipo, :senha)";

        $consulta = $this->conexao->prepare($sql);
        $consulta ->bindValue(":nome", $dadosDoUsuario->getNome());
        $consulta ->bindValue(":email", $dadosDoUsuario->getEmail());
        $consulta ->bindValue(":tipo", $dadosDoUsuario->getTipo());
        $consulta ->bindValue(":senha", $dadosDoUsuario->getSenha());

        $consulta->execute();

    }

    //buscar (SELECT)

    public function buscar(): array {
        $sql = "SELECT * FROM usuarios ORDER BY nome";

       $consulta = $this->conexao->query($sql);

       return $consulta->fetchAll();
    }


}