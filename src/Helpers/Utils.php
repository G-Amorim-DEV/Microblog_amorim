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
        string $senhaDigitadaNoFormulario,
        string $senhaArmazenadaNoBanco
    ) {
        /*  Ussamos o password_verify para comparar as duas senhas */
        if (password_verify($senhaDigitadaNoFormulario, $senhaArmazenadaNoBanco)) {
            ////São iguais? Então retorne a mesma senha já existente no banco de dados.
            return $senhaArmazenadaNoBanco;
        } else {
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
    public static function redirecionarPara(string $paginaDestino): void
    {
        header("Location: " . $paginaDestino);
        exit;
    }

    public static function formatarDate($dataHora)
    {
        try {
            $dt = new DateTime($dataHora);
            return $dt->format('d/m/Y H:i');
        } catch (Exception $e) {
            return false;
        }
    }

    public static function upload(?array $arquivo): void
    {

        /* Validação Incial:: Verifica se:
            - não tem arquivo;
            - não existe açguma referência na área temporária;
            - não for um arquivo que possa/permita envio/upload. */
        if (
            !$arquivo ||
            !isset($arquivo["tmp_name"]) ||
            !is_uploaded_file($arquivo["tmp_name"])
        ) {
            throw new Exception("Nenhum arquivo válido foi enviado.");
        }

        // Definindo uma pasta no servidor/site para receber a imagem enviada
        $pastaDeDestino = "../images/";

        // Validação do formato de imagem 
        $formatosPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];

        // Definindo um tamanho máximo para imagens
        $tamanhoMaximo = 2 * 1024 * 1024; // 2MB

        // Detectando o formato REAL dos ARQUIVOS
        $formatoDoArquivoEnviado = mime_content_type($arquivo["tmp_name"]);

        // Se formato NÃO ESTIVER na lista de formatos permitidos
        if (!in_array($formatoDoArquivoEnviado, $formatosPermitidos)) {
            throw new Exception("Apenas arquivos JPG, PNG, GIF e SVG são permitidos.");
        }

        // Se o tamanho do arquivo enviado for acima do máximo
        if ($arquivo["size"] > $tamanhoMaximo) {
            throw new Exception("O arquivo é muito grande. Tamanho máximo: 2MB.");
        }

        // Montando o nome/caminho di arquivo que será guardado na pasta Imagens.
        $nomeDoArquivo = $pastaDeDestino . basename($arquivo["name"]);

        // Se NÃO CONSEGUIR execultar a função move_uploaded_file, lançar exeção
        if (!move_uploaded_file($arquivo["tmp_name"], $nomeDoArquivo)) {
            throw new Exception("Erro ao mover o arquivo. Código de erro: " . $arquivo["error"]);
        }
    }
}
