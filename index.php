<?php
require_once "src/Database/Conecta.php";
require_once "src/Services/NoticiaServico.php";
require_once "src/Helpers/Utils.php";

$erro = null;
$noticias = [];
$noticiaServico = new NoticiaServico();

try {
    $noticias = $noticiaServico->buscarNoticiasParaPublico();
    Utils::dump($noticias);
} catch (Throwable $e) {
    $erro = "Erro ao buscar notícias. <br>" . $e->getMessage();
}

require_once "includes/cabecalho.php";
?>

<?php if ($erro): ?>
    <p class="alert alert-danger text-center"> <?=$erro?> </p>
<?php endif; ?>

<div class="row my-1 mx-md-n1">

    <!-- INÍCIO Card -->
    <?php foreach ($noticias as $noticia) { ?>
    <div class="col-md-6 my-1 px-md-1">
        <article class="card shadow-sm h-100">

            <img src="images/<?=$noticia['imagem']?>" class="card-img-top" alt="<?=$noticia['titulo']?>">

            <div class="card-body">
                <h3 class="fs-4 card-title"><?=$noticia['titulo']?></h3>
                <p class="card-text"><?=$noticia['resumo']?></p>

                <!-- Link correto para stretched-link -->
                <a href="noticia.php?id=<?=$noticia['id']?>" class="stretched-link"></a>
            </div>

        </article>
    </div>
    <?php } ?>
    <!-- FIM Card -->

</div>

<?php
require_once "includes/rodape.php";
?>
