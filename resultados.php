<?php

require_once "includes/cabecalho.php";
?>

<div class="row my-1 mx-md-n1">
    <h2 class="col-12 fs-5 fw-light">
        Você procurou por 
        <span class="badge bg-dark"> termo digitado... </span> e
        obteve <span class="badge bg-info">  X </span> resultados
    </h2>
    

    <div class="col-12 my-1">
        <article class="card">
            <div class="card-body">
                <h3 class="fs-4 card-title fw-light">
                    Título da notícia...
                </h3>
                <p class="card-text">
                    <time>11/11/2011 21:12</time> - 
                    Resumo da notícia...
                </p>
                
                <a href="noticia.php" 
                class="btn btn-primary btn-sm">Continuar lendo</a>
            </div>
        </article>
    </div>

</div>     


<?php
require_once "includes/rodape.php";
?>