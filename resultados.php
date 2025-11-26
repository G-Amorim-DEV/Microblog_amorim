<?php
require_once "src/Database/Conecta.php";
require_once "src/Services/NoticiaServico.php";
require_once "src/Helpers/Utils.php";

$erro = null;
$dados = [];

$noticiaServico = new NoticiaServico();

// Obter o valor que foi digitado no campo buscar
$termo = Utils::sanitizar($_GET['busca'] ?? '');

try {
    $dados = $noticiaServico->buscarNoticias($termo);

} catch (Throwable $e) {
    $erro = "Erro ao buscar o termo digitado no sistema. <br>" . $e->getMessage();
}

require_once "includes/cabecalho.php";
?>

<?php if ($erro): ?>
    <p class="alert alert-danger text-center"><?= $erro ?></p>
<?php endif; ?>

<div class="row my-1 mx-md-n1">

    <h2 class="col-12 fs-5 fw-light">
        Você procurou por 
        <span class="badge bg-dark"><?= $termo ?></span> e
        obteve <span class="badge bg-info"><?= count($dados) ?></span> resultados
    </h2>

    <?php if (count($dados) === 0): ?>
        <p class="alert alert-warning text-center">Nenhuma notícia encontrada.</p>
    <?php endif; ?>

    <?php foreach ($dados as $noticia): ?>
        <div class="col-12 my-1">
            <article class="card">
                <div class="card-body">

                    <h3 class="fs-4 card-title fw-light">
                        <?= $noticia['titulo'] ?>
                    </h3>

                    <p class="card-text">
                        <time><?= date('d/m/Y H:i', strtotime($noticia['data'])) ?></time> - 
                        <?= $noticia['resumo'] ?>
                    </p>

                    <a href="noticia.php?id=<?= $noticia['id'] ?>" 
                       class="btn btn-primary btn-sm">
                        Continuar lendo
                    </a>

                </div>
            </article>
        </div>
    <?php endforeach; ?>

</div>

<?php
require_once "includes/rodape.php";
?>
