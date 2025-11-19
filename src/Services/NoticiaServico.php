<?php
//src\Services\NoticiaServico.php

class NoticiaServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Conecta::getConexao();
    }

    public function buscar(string $tipoUsuario, int $idUsuario): array
    {

        if ($tipoUsuario === 'admin'){

        $sql = " SELECT 
                    noticias.id,
                    noticias.titulo,
                    noticias.data,
                    usuarios.nome AS autor
                FROM noticias JOIN usuarios
                ON noticias.usuario_id = usuarios.id 
                ORDER BY noticias.data DESC";

        } else{
            
            $sql = "SELECT id, titulo, data 
                    FROM noticias 
                    WHERE usuario_id = :usuario_id 
                    ORDER BY data DESC";
        }

        $consulta = $this->conexao->prepare($sql);

        if($tipoUsuario !== 'admin'){
            $consulta->bindValue(":usuario_id", $idUsuario);
        }

        $consulta->execute();

        return $consulta->fetchAll();
    }
}
