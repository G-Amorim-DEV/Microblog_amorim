<?php

//src\Helpers\Utils.php
class Utils
{

    /* Usamos mixed para sinalizar que o método aceita/retorna tipos de dados variados (string, int, array, float etc). */
    public static function sanitizar(mixed $valor, string $tipoDeSanitizacao = 'texto'): mixed
    {

        switch ($tipoDeSanitizacao) {
            case 'inteiro':
                return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);

            case 'email':
                return trim(filter_var($valor, FILTER_SANITIZE_EMAIL));

            default:
                return trim(filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }

    public static function codificarSenha(string $valorSenha): string
    {
        return password_hash($valorSenha, PASSWORD_DEFAULT);
    }

    /* Ao chamar o método verificarSenha, passamos pra ele a senha digitada no formulário e a senha existente no bando de dados. */
    public static function verificarSenha(
        string $senhaDigitadaNoFormulario, string $senhaArmazenadaNoBanco
    ){
        /*  Ussamos o password_verify para comparar as duas senhas */
        if(password_verify($senhaDigitadaNoFormulario, $senhaArmazenadaNoBanco)){
            ////São iguais? Então retorne a mesma senha já existente no banco de dados.
            return $senhaArmazenadaNoBanco;
        }else{
            //São diferentes? Então pega a senha digitada e faça um novo hash
            return self::codificarSenha($senhaDigitadaNoFormulario);
        }
    }

    /* Exercício: crie um método chamado dump, faça ele receber um parãmetro chamado $dados, efaça aparecer o var_dump dentro da tag <pre> */

    public static function dump(mixed $dados): void
    {
        echo '<pre>';
        var_dump($dados);
        echo '</pre>';
    }

    /* Exercício: crie um método chamado redirecionar, faça ele receber um parãmetro chamado $paginaDestino, e faça com que ele redirecione as páginas de maneira que possa ser usado em outras páginas */
   public static function redirecionarPara(string $paginaDestino):void {
    header("Location: " . $paginaDestino);
    exit;
    }

    public static function formatarDate($dataHora){
        try {
            $dt = new DateTime($dataHora);
            return $dt->format('d/m/y H:i');

        } catch (Exception $e) {
            return false;
        }
    }

}
