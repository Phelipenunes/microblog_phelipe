 <?php
 use Microblog\Usuario;
 use Microblog\ControleDeAcesso;
 require_once "../vendor/autoload.php";
 $sessao->verificarAcessoAdmin();
 $sessao = new ControleDeAcesso;
 $sessao->verificarAcesso();

 $usuario = new Usuario;
 $usuario->setId($_GET['id']);
 $usuario->excluir();
 header("location:usuarios.php");