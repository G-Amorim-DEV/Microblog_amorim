<?php
//src\Services\NoticiaServico.php

class NoticiaServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Conecta::getConexao();
    }

    //Versão completa usada em admin/noticias.php
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

    //admin/noticia-insere.php
    public function inserir(Noticia $dadosNoticia):void{

        $sql = "INSERT INTO noticias(
                    titulo, 
                    texto, 
                    resumo, 
                    imagem, 
                    usuario_id
                    ) VALUES(
                    :titulo,
                    :texto,
                    :resumo,
                    :imagem,
                    :usuario_id                    
                    )";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":titulo", $dadosNoticia->getTitulo());
        $consulta->bindValue(":texto", $dadosNoticia->getTexto());
        $consulta->bindValue(":resumo", $dadosNoticia->getResumo());
        $consulta->bindValue(":imagem", $dadosNoticia->getImagem());
        $consulta->bindValue(":usuario_id", $dadosNoticia->getUsuarioId());

        $consulta->execute();
    }

    public function buscarPorId(int $idNoticia, string $tipoUsuario, int $idUsuario): ?array{
        if($tipoUsuario === "admin"){
            /* Pode buscar/exibir qualquer noticia, bastando saber o id da noticia */
            $sql = "SELECT * FROM noticias WHERE id = :id";
            
        }else{
            /* Se não, pode buscar/exibir qualquer noticia desde que seja dele/dela própria */
            $sql = "SELECT * FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
        }
    
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $idNoticia); // Fora do if porque é usado nos 2 sql
        
        if ($tipoUsuario !== 'admin') {
            // Fica dentro do if porque é usado apenas no SQL do editor
            $consulta->bindValue(":usuario_id", $idUsuario);
        }

        $consulta->execute();
        return  $consulta->fetch() ?: null;
    }
}
