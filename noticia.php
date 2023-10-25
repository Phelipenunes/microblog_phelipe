<?php 
require_once "inc/cabecalho.php";
use Microblog\Noticia;
$noticia = new Noticia;
/* Capturando o id e o tipo do usuario logado e associando estes valores às propiedades do objeto */
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);

?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2> Título da notícia... </h2>
        <p class="font-weight-light">
            <time>Data da notícia...</time> - <span>Autor da notícia</span>
        </p>
        <img src="https://picsum.photos/seed/picsum/200/100" alt="" class="float-left pr-2 img-fluid">
        <p>Texto da notícia...</p>
    </article>
    

</div>        
                  

<?php 
require_once "inc/rodape.php";
?>

