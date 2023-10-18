<?php
namespace Microblog;
use exception, PDO;

class Categoria {
    private int $id;
    private string $nome;
    private PDO $conexao;
    
    public function __construct(){
        $this->conexao = banco::conecta();
    }
    //inserir
    public function inserir():void{
        $sql = "INSERT INTO categorias(nome) VALUES (:nome)";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }
    }
    //ler todos 
    public function lertodas():array {
        $sql = "SELECT * FROM categorias ORDER BY nome";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }
        return $resultado;
    }
    //Delete
    public function excluir():void{
        $sql = "DELETE FROM categorias WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }
}