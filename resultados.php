<?php 
require_once "inc/cabecalho.php";
$noticia->setTermo($_GET['busca']);
$resultado = $noticia->buscar();
?>


<div class="row bg-white rounded shadow my-1 py-4">
    <h2 class="col-12 fw-light">
        Você procurou por <span class="badge bg-dark"><?=$noticia->getTermo()?></span> e
        obteve <span class="badge bg-info"><?=count($resultado)?></span> resultados
    </h2>
    
    <div class="col-12 my-1">
        
        <article class="card">
        <?php foreach ($resultado as $itemNoticia) {?>
            <div class="card-body">
                <h3 class="fs-4 card-title fw-light"><?=$itemNoticia['titulo']?></h3>
                <p class="card-text">
                    <time><?=$itemNoticia['data']?></time><?=$itemNoticia['resumo']?>
                </p>
                
                <a href="noticia.php?id=<?=$itemNoticia['id']?>" class="btn btn-primary btn-sm">Continuar lendo</a>
            </div>
            <?php } ?>
    </div>

</div>        

<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

