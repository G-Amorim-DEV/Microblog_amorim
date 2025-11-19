<?php
require_once "../src/Database/conecta.php";

require_once "../src/Models/Noticia.php";

require_once "../src/Services/NoticiaServico.php";

require_once "../src/Helpers/Utils.php";

require_once  "../src/Services/AutenticacaoServico.php";

AutenticacaoServico::exigirLogin();

$erro = null;

$noticiaServico = new NoticiaServico();


require_once "../includes/cabecalho-admin.php";

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Inserir nova notícia
		</h2>

		<!-- Obrigatório colocar o atributo enctype com o valor multipart/form-data para que o seu formulário ACEITE/PERMITA o envio de ARQUIVOS. -->
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir" autocomplete="off" enctype="multipart/form-data">

			<div class="mb-3">
				<label class="form-label" for="titulo">Título:</label>
				<input class="form-control" type="text" id="titulo" name="titulo">
			</div>

			<div class="mb-3">
				<label class="form-label" for="texto">Texto:</label>
				<textarea class="form-control" name="texto" id="texto" cols="50" rows="6"></textarea>
			</div>

			<div class="mb-3">
				<label class="form-label" for="resumo">Resumo (máximo de 300 caracteres):</label>
				<span id="maximo" class="badge bg-danger">0</span>
				<textarea class="form-control" name="resumo" id="resumo" cols="50" rows="2" maxlength="300"></textarea>
			</div>

			<div class="mb-3">
				<label class="form-label" for="imagem" class="form-label">Selecione uma imagem:</label>
				<input class="form-control" type="file" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
			</div>

			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
		</form>

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>