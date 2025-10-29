<?php
//src\Database\conecta.php

class Conecta
{
    private static string $servidor = "localhost"; // padrão do XAMPP
    private static string $banco = "microblog_amorim";
    private static string $usuario = "root"; // padrão do XAMPP
    private static string $senha = ""; // padrão do XAMPP

    private static ?PDO $conexao = null;

    private function __construct() {}         // impede instâncias
    private function __clone() {}             // impede clonagem
    

    // Método estático para obter a conexão
    public static function getConexao(): PDO
    {
        if (self::$conexao === null) {
            try {
                self::$conexao = new PDO(
                    "mysql:host=" . self::$servidor . ";dbname=" . self::$banco . ";charset=utf8",
                    self::$usuario,
                    self::$senha
                );

                // Configurações de erro e fetch mode
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $erro) {
                die("Erro ao conectar Banco de Dados: " . $erro->getMessage());
            }
        }

        return self::$conexao;
    }
}

//Teste de conexão
Conecta::getConexao();

?>
