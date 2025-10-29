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

    /* Exercício: crie um método chamado dump, faça ele receber um parãmetro chamado $dados, efaça aparecer o var_dump dentro da tag <pre> */

    public static function dump(mixed $dados): void
    {
        echo '<pre>';
        var_dump($dados);
        echo '</pre>';
    }
}
