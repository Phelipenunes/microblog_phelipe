<?php 
require_once "../inc/cabecalho-admin.php";
use Microblog\Noticia;
use Microblog\Utilitarios;
use Microblog\Categoria;
 $noticia = new Noticia();

 $categoria = new Categoria;
 $listaDeCategorias = $noticia->categoria->lertodas(); 

 if(isset($_POST['inserir'])){
 $noticia->setTitulo($_POST['titulo']);
 $noticia->setTexto($_POST['texto']);
 $noticia->setResumo($_POST['resumo']);
 $noticia->setDestaque($_POST['destaque']);

 //ID do usuario que esta inserindo a noticia
$noticia->usuario->setId($_SESSION['id']);

 // ID da categoria escolhida para a noticia
 $noticia->categoria->setId($_POST['categoria']);

 /* sobre a imagem 
 - capturar o arquivo de imagem e enviar para o servidor 
 */
$imagem = $_FILES['imagem'];
$noticia->upload($imagem);

/* 
- capturar o nome e eviar para o banco de dados 
 */
$noticia->setImagem($imagem["name"]);

//executar no banco e redirecionar
$noticia->inserir();
header("location:noticias.php");
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Inserir nova notícia
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" enctype="multipart/form-data" name="form-inserir">

            <div class="mb-3">
                <label class="form-label" for="categoria">Categoria:</label>
                <select class="form-select" name="categoria" id="categoria" required>
					<option value=""></option>
				<?php foreach($listaDeCategorias as $itemCategoria){?>
					<option value="<?=$itemCategoria['id']?>">
					<?=$itemCategoria['nome']?>
					</option>
				<?php } ?>
				</select>
			</div>

			<div class="mb-3">
                <label class="form-label" for="titulo">Título:</label>
                <input class="form-control" required type="text" id="titulo" name="titulo" >
			</div>

			<div class="mb-3">
                <label class="form-label" for="texto">Texto:</label>
                <textarea class="form-control" required name="texto" id="texto" cols="50" rows="6"></textarea>
			</div>

			<div class="mb-3">
                <label class="form-label" for="resumo">Resumo (máximo de 300 caracteres):</label>
                <span id="maximo" class="badge bg-danger">0</span>
                <textarea class="form-control" required name="resumo" id="resumo" cols="50" rows="2" maxlength="300"></textarea> 
			</div>

			<div class="mb-3">
                <label class="form-label" for="imagem">Selecione uma imagem:</label>
                <input required class="form-control" type="file" id="imagem" name="imagem"
                accept="image/png, image/jpeg, image/gif, image/svg+xml">
			</div>
			
            <div class="mb-3">
                <p>Deixar a notícia em destaque?
                    <input type="radio" class="btn-check" name="destaque" id="nao" autocomplete="off" checked value="nao">
                    <label class="btn btn-outline-danger" for="nao">Não</label>

                    <input type="radio" class="btn-check" name="destaque" id="sim" autocomplete="off" value="sim">
                    <label class="btn btn-outline-success" for="sim">Sim</label>
                </p>
            </div>

			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>