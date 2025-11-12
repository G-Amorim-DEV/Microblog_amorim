<?php 
require_once "src/Database/conecta.php";

require_once "src/Services/UsuarioServico.php";

require_once "src/Helpers/Utils.php";

require_once "src/Services/AutenticacaoServico.php";

$usuarioServico = new UsuarioServico();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['email']) || empty($_POST['senha'])){

        Utils::redirecionarPara("login.php?campos_obrigatorios");

    }else{

        // Captura e-mail e senha

        $email = Utils::sanitizar($_POST['email'], 'email');

        $senha = $_POST['senha'];

        // Busca pelo usuário através do e-mail

        $dadosDoUsuario = $usuarioServico->buscarPorEmail($email);       

        // Se não estiver usuário/usuário inválido, redirecione para login.php

        if (!$dadosDoUsuario) {
            Utils::redirecionarPara("login.php?dados_incorretos");
        } else {
            
            // Caso contrário, verifique a senha
            if(password_verify($senha, $dadosDoUsuario['senha'])){

                echo "Entrou";

                // Estando correta, faça o login
                AutenticacaoServico::login($dadosDoUsuario['id'], $dadosDoUsuario['nome'], $dadosDoUsuario['tipo']);
         

            }else{

                // Estando errada, mantenha em login.php

                Utils::redirecionarPara("login.php?dados_incorretos");

               
            }      
            
        }

    }
}

/*  Mensagens do processo de login/logout */

if(isset($_GET['acesso_proibido'])){

    $mensagem = "Você deve logar primeiro!!! 😒🤦‍♂️😡";

}elseif(isset($_GET['campos_obrigatorios'])){

    $mensagem = "Preencha o e-mail e a senha. Esses campos são obrigatórios para acessar a página.😡😡😡";

}elseif(isset($_GET['dados_incorretos'])){

     $mensagem = "⚠️ E-mail/Senha incorretos. Digite novamente para ter acesso.😡😡😡";

}

require_once "includes/cabecalho.php";
?>

<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <?php if(isset($mensagem)):?>
            <p class="alert alert-warning text-center my-2"><?= $mensagem?><p/>
            <?php endif;?>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50" autocomplete="off">
			

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input class="form-control" type="email" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input class="form-control" type="password" id="senha" name="senha">
            </div>

            <button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>
        </form>
    </div>
</div>

<?php 
require_once "includes/rodape.php";
?>
