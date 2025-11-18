<?php
require_once "../src/Database/conecta.php";

require_once "../src/Models/usuario.php";

require_once "../src/Helpers/Utils.php";

require_once "../src/Services/UsuarioServico.php";

require_once  "../src/Services/AutenticacaoServico.php";

AutenticacaoServico::exigirLogin();

$erro = null;

$usuarioServico = new UsuarioServico();

try {
	// Busca a partir do id do usuário logado
	$dados = $usuarioServico->buscarPorId($_SESSION['id']);
	if(!$dados) $erro = "Usuário não encontrado";
} catch (\Throwable $e) {
	$erro = "Erro ao buscar usuário. <br>".$e->getMessage();
}

//Detectar se o formulário foi acionado para atualizar o usuário
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (empty($_POST['nome']) || empty($_POST['email'])) {
        $erro = "Nome e E-mail são obrigatórios";
    } else {
        try {
            $nome = Utils::sanitizar($_POST['nome']);
            $email = Utils::sanitizar($_POST['email'], 'email');

            // senha
            $senha = empty($_POST['senha'])
                ? $dados['senha']
                : Utils::verificarSenha($_POST['senha'], $dados['senha']);

            // Montando objeto
            $usuario = new Usuario($nome, $email, $senha, $_SESSION['tipo']);
            $usuario->setId($_SESSION['id']);

            // Atualiza
            $usuarioServico->atualizar($usuario);

            // Atualiza sessão
            $_SESSION['nome'] = $nome;

            Utils::redirecionarPara('index.php');

        } catch (\Throwable $e) {
            $erro = "Erro ao atualizar usuário: " . $e->getMessage();
        }
    }
}


require_once "../includes/cabecalho-admin.php";

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Atualizar meus dados
		</h2>

		<?php if ($erro): ?>
			<p class="alert alert-danger text-center"><?= $erro ?></p>
		<?php endif; ?>

		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">
			<input type="hidden" name="id" value="<?=$dados['id']?>">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input value="<?=$dados['nome']?>" class="form-control" type="text" id="nome" name="nome">
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input value="<?=$dados['email']?>" class="form-control" type="email" id="email" name="email">
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>