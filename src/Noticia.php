<?php
namespace Microblog;
use PDO, Exception;

final class Noticia {
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private string $termo; // será usado na busca
    private PDO $conexao;

    /* Propriedades cujos tipos são ASSOCIADOS
    às classes já existentes. Isso permitirá usar
    recursos destas classes à partir de Noticia. */
    public Usuario $usuario;
    public Categoria $categoria;

    public function __construct(){
        /* Ao criar um objeto Noticia, aproveitamos para
        instanciar objetos de Usuario e Categoria */
        $this->usuario = new Usuario;
        $this->categoria = new Categoria;

        $this->conexao = Banco::conecta();
    }

    //métodos CRUD
    public function inserir():void{
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, destaque, usuario_id, categoria_id) VALUES(:titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :categoria_id)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindValue(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindValue(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);

            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":categoria_id", $this->categoria->getId(), PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }
    }

    //listar
    public function listar():array{
        //se o tipo do usuario logar por admin
        if($this->usuario->getTipo() ==='admin'){
            $sql ="SELECT noticias.id, noticias.titulo, noticias.data, usuarios.nome AS autor, noticias.destaque
                   FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id ORDER BY data DESC";
        }else{
            //se usuario logar com o tipo editor usa este
            $sql = "SELECT id, titulo, data, destaque FROM noticias WHERE usuario_id = :usuario_id
                    ORDER BY data DESC";
        }
        try {
            $consulta = $this->conexao->prepare($sql);
            if($this->usuario->getTipo() !=='admin'){
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar noticias: ".$erro->getMessage());
        }
        return $resultado;
    }

    //listarUm
    public function listarUm():array{
        if($this->usuario->getTipo() ==='admin'){
            $sql ="SELECT * FROM noticias WHERE id = :id";
        }else{
            $sql = "SELECT * FROM noticias WHERE id = :usuario_id AND usuario_id = :usuario_id";
        }
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);

            if($this->usuario->getTipo() !=='admin'){
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar noticias: ".$erro->getMessage());
        }
        return $resultado;
    }


    // Método para upload de foto
    public function upload(array $arquivo):void{
        //definindo os tipos válidos
        $tiposValidos = [
            "image/png",
            "image/jpeg",
            "image/gif",
            "image/svg+xml"
        ];
        if (!in_array($arquivo['type'],$tiposValidos)){
            die("
            <script>
            alert('Formato inválido!');
            history.back();
            </script>
            ");
        }
        $nome = $arquivo['name'];
        $temporario = $arquivo['tmp_name'];
        $pastafinal = "../imagens/".$nome;
        move_uploaded_file($temporario, $pastafinal);
    }



    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): self
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }


    public function getData(): string
    {
        return $this->data;
    }


    public function setData(string $data): self
    {
        $this->data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getTitulo(): string
    {
        return $this->titulo;
    }


    public function setTitulo(string $titulo): self
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getTexto(): string
    {
        return $this->texto;
    }


    public function setTexto(string $texto): self
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getResumo(): string
    {
        return $this->resumo;
    }


    public function setResumo(string $resumo): self
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getImagem(): string
    {
        return $this->imagem;
    }


    public function setImagem(string $imagem): self
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getDestaque(): string
    {
        return $this->destaque;
    }


    public function setDestaque(string $destaque): self
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    public function getTermo(): string
    {
        return $this->termo;
    }


    public function setTermo(string $termo): self
    {
        $this->termo = filter_var($termo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


   
}