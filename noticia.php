<?php
require_once "src/Database/Conecta.php";
require_once "src/Services/NoticiaServico.php";
require_once "src/Helpers/Utils.php";

$erro = null;

$noticiaServico = new NoticiaServico();

$id = Utils::sanitizar($_GET['id'] ?? null, 'inteiro');
if(!$id) Utils::redirecionarPara("index.php");

try {

    $dados = $noticiaServico->exibirNoticiaCompleta($id);

} catch (\Throwable $e) {
    $erro = "Erro ao exibir a notícia.<br>" . $e->getMessage();
}

require_once "includes/cabecalho.php";
?>


<div class="row my-1 mx-md-n1">

    <?php if ($erro): ?>
		<p class="alert alert-danger text-center"><?= $erro ?></p>
	<?php endif; ?>

    <article class="col-12">
        <h2> <?= $dados['titulo'] ?> </h2>
        <p class="font-weight-light">
            <time datetime="<?=  $dados['data'] ?>"><?= Utils::formatarDate($dados['data']) ?></time> - 
            <span><?=$dados['autor']?></span>
        </p>
        <img src="images/<?= $dados['imagem'] ?>" alt="" class="float-start pe-2 img-fluid">
        <p class="ajusta-texto"><?= nl2br($dados['texto']) ?></p>
    </article>
    

</div>        
                  

<?php 
require_once "includes/rodape.php";
?>

