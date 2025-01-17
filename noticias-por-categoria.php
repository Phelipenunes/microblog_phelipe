<?php 
require_once "inc/cabecalho.php";
use Microblog\Utilitarios;
$noticia->categoria->setId($_GET['id']);
$dados = $noticia->listarPorCategoria();

?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <?php if(count($dados)){?>
            <h2 class=" ">Notícias sobre <span class="badge bg-primary"><?=$dados[0]['categoria']?></span> </h2>
        <?php } else {?>
            <h2 class="alert alert-warning text-center">Não temos notícias desta categoria</h2>
        <?php }?>    
        <div class="row my-1">
            <div class="col-12 px-md-1">
                <div class="list-group">
                    <?php foreach ($dados as $itemNoticia) {?>
                    <a href="noticia.php?id=<?=$itemNoticia['id']?>" class="list-group-item list-group-item-action">
                        <h3 class="fs-6"><?=$itemNoticia['titulo']?></h3>
                        <p><time><?=Utilitarios::formataData($itemNoticia['data'])?></time><?=$itemNoticia['autor']?></p>
                        <p><?=$itemNoticia['resumo']?></p>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>


    </article>
    

</div>        
        

<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

