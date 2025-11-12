<?php

require_once "../src/Database/conecta.php";

require_once "../src/Models/usuario.php";

require_once "../src/Services/UsuarioServico.php";

require_once "../src/Helpers/Utils.php";

require_once "../src/Helpers/Utils.php";

require_once  "../src/Services/AutenticacaoServico.php";

AutenticacaoServico::exigirLogin();

AutenticacaoServico::exigirAdmin();

$id = Utils::sanitizar($_GET['id'], 'inteiro');

//Se não houver id válido na URL, faça volvar para página usuários
if(!$id) Utils::redirecionarPara('usuarios.php');

//inicialização

$erro = null;

$usuarioServico = new UsuarioServico();

try {
	$dados = $usuarioServico->buscarPorId($id);
	if(!$dados) $erro = "Usuário não encontrado";
} catch (\Throwable $e) {
	$erro = "Erro ao buscar usuário. <br>".$e->getMessage();
}

//Detectar se o formulário foi acionado para atualizar o usuário

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(empty($_POST['nome']) || ($_POST['email']) || ($_POST['tipo'])){
		$erro = "Nome, E-mail e Tipo são obrigatórios";
	} else{
		try {
			$nome = Utils::sanitizar($_POST['nome']);
			$email = Utils::sanitizar($_POST['email'], 'email');
			$tipo = Utils::sanitizar($_POST['tipo']);

			 /* Se o campo senha estiver, manter a senha existente. Caso contrário, verifique as senhas (digitada no formulário e a do banco de dados).*/

			 $senha = empty($_POST['senha'] ? $dados['senha'] : Utils::verificarSenha($_POST['senha'], $dados['senha']));

			 //Montando um objeto com os dados do usuario
			 $usuario = new Usuario($nome, $email, $senha, $tipo, $id);

			 //Executar o serviço para atualizar
			 $usuarioServico->atualizar($usuario);

			 //Redirecionar para a lista de usuarios
			 Utils::redirecionarPara('usuarios.php');

		} catch (\Throwable $e) {
			$erro = "Nome, E-mail e Tipo são obrigatórios";
		}
	}
}


require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Atualizar dados do usuário
		</h2>

		<?php if ($erro): ?>
			<p class="alert alert-danger text-center"><?= $erro ?></p>
		<?php endif; ?>

		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar" autocomplete="off">
			<input type="hidden" name="id" value="<?=$dados['id']?>">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$dados['nome']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$dados['email']?>">
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo">
					<option value="">--Selecione um tipo de Usuário--</option>

					<option value="editor" <?php if($dados['tipo'] === 'editor') echo "selected"?>>Editor</option>

					<option value="admin" <?php if($dados['tipo'] === 'admin') echo "selected"?>>Administrador</option>

				</select>
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>