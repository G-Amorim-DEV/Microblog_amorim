<?php 
// src\Services\AutenticacaoServico.php

Class AutenticacaoServico{

    public static function iniciarSessao():void {
        /* Verificando se não há uma sessão em andamento/ativa */
        if(session_status() !== PHP_SESSION_ACTIVE){
            // Não havendo, inicializa uma sessão
            session_start();
        }
    }

    public static function exigirLogin(): void{
        //Verificando se já tem sessão
        self::iniciarSessao();

        /*  Se não existir uma variável de sessão para o id de um usuário, na prática, é porque NÃO TEM NINGUEM LOGADO */

        if(!isset($_SESSION['id'])){
            Utils::redirecionarPara("../login.php?acesso_proibido");
        }
    }

    public static function login(int $valorId, string $valorNome, string $valorTipo):void{

        self::iniciarSessao();

        // Criando variáveis de sessão com os dados informados
        $_SESSION['id'] = $valorId;
        $_SESSION['nome'] = $valorNome;
        $_SESSION['tipo'] = $valorTipo;

        // Após logar, vá para admin/index.php
        Utils::redirecionarPara("admin/");
    }

    public static function logout():void{

        self::iniciarSessao();

        session_destroy();

        Utils::redirecionarPara("../login.php?saiu");

    }

    public static function exigirAdmin():void{
        self::iniciarSessao();
        
        if ($_SESSION['tipo'] != 'admin') 
            
            Utils::redirecionarPara("nao-autorizado.php");
    }
}

?>