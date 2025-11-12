<?php

//src\Services\UsuarioServico.php

class UsuarioServico
{
    private PDO $conexao;

    public function __construct()
    {

        /* Toda vez que criamos um objetos baseado na classe UsuarioServico, este objeto fará uma chamada ao método de conexão na classe Conecta */
        $this->conexao = Conecta::getConexao();
    }

    /* Métodos CRUD para Usuários */

    //Inserir (INSERT)
    public function inserir(Usuario $dadosDoUsuario): void
    {

        $sql = "INSERT INTO usuarios(nome, email, tipo, senha) VALUES (:nome, :email, :tipo, :senha)";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $dadosDoUsuario->getNome());
        $consulta->bindValue(":email", $dadosDoUsuario->getEmail());
        $consulta->bindValue(":tipo", $dadosDoUsuario->getTipo());
        $consulta->bindValue(":senha", $dadosDoUsuario->getSenha());

        $consulta->execute();
    }

    //buscar (SELECT)

    public function buscar(): array
    {
        $sql = "SELECT * FROM usuarios ORDER BY nome";

        $consulta = $this->conexao->query($sql);

        return $consulta->fetchAll();
    }

    //buscarPorId (SELECT/WHERE)

    public function buscarPorId(int $valorID): ?array
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $valorID);
        $consulta->execute();

        /* Sobre o :? conhecido como "Elvis Operator
        É uma condicional simplificada/abreviada em que,
        se a condição/expressão for válida,
        ela mesam é retornada. Caso contrário, é retornado null */
        return $consulta->fetch() ?: null;
    }

    //atualizar (UPDATE/WHERE)

    public function atualizar(Usuario $dadosDoUsuario): void
    {
        $sql = "UPDATE usuarios SET
            nome = :nome,
            email = :email,
            tipo = :tipo,
            senha = :senha
            WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);

        $consulta->bindValue(':nome', $dadosDoUsuario->getNome());
        $consulta->bindValue(':email', $dadosDoUsuario->getEmail());
        $consulta->bindValue(':tipo', $dadosDoUsuario->getTipo());
        $consulta->bindValue(':senha', $dadosDoUsuario->getSenha());
        $consulta->bindValue(':id', $dadosDoUsuario->getId());

        $consulta->execute();
    }

    public function excluir(Usuario $dadosDoID): void
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $dadosDoID->getId(), PDO::PARAM_INT);

        $consulta->execute();
    }

    public function buscarPorEmail($email): ?array{

        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":email", $email);
        $consulta->execute();

        /* A expressão no return é TRUE? 
        Então retorna os daodos como array (fetch)
        Senão, retorna null. */

        return $consulta->fetch() ?: null;
    }
}
