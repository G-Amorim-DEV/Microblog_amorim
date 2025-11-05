<?php
require_once "../src/Database/conecta.php";
require_once "../src/Models/usuario.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../src/Helpers/Utils.php";

$id = $_GET['id'] ?? null;
$usuarioServico = new UsuarioServico();

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$acao = $_POST['acao'] ?? null;

	if ($acao === 'voltar') {
		Utils::redirecionarPara('usuario.php');
	}

	if ($acao === 'excluir' && $id) {
		$excluirUsuario = $usuarioServico->excluir($id);

		Utils::redirecionarPara('usuario.php?excluido=true');
	}
}

if (!$id) {
	Utils::redirecionarPara('usuario.php');
}




require_once "../includes/cabecalho-admin.php";
?>




<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<?php if ($erro): ?>
			<p class="alert alert-sucess text-center"><?= $erro ?></p>
		<?php endif; ?>

		<h2 class="text-center">
			Excluir usuário
		</h2>



		<form method="POST">
			<button type="submit" name="acao" value="voltar">Voltar</button>
		</form>



	</article>
</div>

<script src="../admin/js/confirmar_exclusao.js"></script>


<?php
require_once "../includes/rodape-admin.php";
?>