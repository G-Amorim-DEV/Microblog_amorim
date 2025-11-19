<?php
require_once "../src/Database/conecta.php";

require_once "../src/Models/Noticia.php";

require_once "../src/Services/NoticiaServico.php";

require_once "../src/Helpers/Utils.php";

require_once  "../src/Services/AutenticacaoServico.php";

AutenticacaoServico::exigirLogin();

$erro = null;

$noticiaServico = new NoticiaServico();

$id = Utils::sanitizar($_GET['id'], 'inteiro');
if(!$id) Utils::redirecionarPara('noicias.php');

try {
    $dados = $noticiaServico->buscarPorId($id, $_SESSION['tipo'], $_SESSION['id']);
   
} catch (\Throwable $th) {

    $erro = 'Erro ao buscar dados da noticia. <br>'.$e->getMessage();
}

require_once "../includes/cabecalho-admin.php";

?>


<div class="row">
    <article class="col-12 bg-white rounded shadow my-1 py-4">

        <h2 class="text-center">
            Atualizar dados da notícia
        </h2>

        <?php if ($erro): ?>
			<p class="alert alert-danger text-center"><?= $erro ?></p>
		<?php endif; ?>

        <form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar" autocomplete="off">
            <input type="hidden" name="id" value="id da notícia...">

            <div class="mb-3">
                <label class="form-label" for="titulo">Título:</label>
                <input value="<?=$dados['titulo']?>" class="form-control" type="text" id="titulo" name="titulo" >
            </div>

            <div class="mb-3">
                <label class="form-label" for="texto">Texto:</label>
                <textarea class="form-control" name="texto" id="texto" cols="50" rows="6"><?=$dados['texto']?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="resumo">Resumo (máximo de 300 caracteres):</label>
                <span id="maximo" class="badge bg-danger">0</span>
                <textarea class="form-control" name="resumo" id="resumo" cols="50" rows="2" maxlength="300"><?=$dados['texto']?></textarea>
            </div>

            <div class="mb-3">
                <label for="imagem-existente" class="form-label">Imagem da notícia:</label>
                <!-- campo somente leitura, meramente informativo -->
                <input value="<?=$dados['imagem']?>" class="form-control" type="text" id="imagem-existente" name="imagem-existente" readonly>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Caso queira mudar, selecione outra imagem:</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
            </div>

            <button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
        </form>

    </article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>