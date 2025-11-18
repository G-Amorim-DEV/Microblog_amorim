<?php 
require_once "../src/Database/conecta.php";

require_once "../src/Helpers/Utils.php";

require_once "../src/Services/NoticiaServico.php";

require_once  "../src/Services/AutenticacaoServico.php";

AutenticacaoServico::exigirLogin();

$erro = null;

$noticias = [];

$noticiaServico = new NoticiaServico();

try {
	$noticias = $noticiaServico->buscar();
	// Utils::dump($noticias);
	
} catch (\Throwable $e) {
	$erro = "Erro ao buscar notícias. <br>".$e->getMessage(); 
}

require_once "../includes/cabecalho-admin.php";

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">Notícias <span class="badge bg-dark"><?= count($noticias) ?></span></h2>

		<?php if ($erro): ?>
			<p class="alert alert-danger text-center"><?= $erro ?></p>
		<?php endif; ?>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>				
						<th>Autor</th>

						<th class="text-center" colspan="2">Operações</th>
					</tr>
				</thead>

				<tbody>


					<tr>
                       
						<?php foreach ($noticias as $noticia) { ?>

                        <td> <?= $noticia['titulo'] ?></td>
                        <td> <?= $noticia['data'] ?> </td>
						<td> <?= $noticia['autor'] ?> </td>
						

						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php?id=<?= $noticia['id'] ?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						</td>
						<td>
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php?id=<?= $noticia['id'] ?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
					<?php } ?>

				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../includes/rodape-admin.php";
?>

