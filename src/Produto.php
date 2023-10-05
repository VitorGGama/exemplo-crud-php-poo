<?php
namespace ExemploCrudPoo;
use Exception, PDO;

class Produto {
    private int $id;
    private int $nome;
    private int $descricao;
    private int $preco;
    private int $quantidade;
    private int $fabricanteId;

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    public function lerProduto(): array {
        $sql = "SELECT * FROM produtos ORDER BY nome";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }    
    
        return $resultado;
    }
    
    public function inserirProduto(): void {
        $sql = "INSERT INTO produtos (nome, preco, quantidade, fabricante_id, descricao) VALUES (:nome, :preco, :quantidade, :fabricante_id, :descricao)";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
            $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
            $consulta->bindValue(":fabricante_id", $this->fabricanteId, PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: " . $erro->getMessage());
        }
    }

    public function lerUmProduto(): array {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $produto = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar: " . $erro->getMessage());
        }
        return $produto;
    }

    public function atualizarProduto(): void {
        $sql = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade, fabricante_id = :fabricante_id, descricao = :descricao WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
            $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
            $consulta->bindValue(":fabricante_id", $this->fabricanteId, PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar: " . $erro->getMessage());
        }
    }

    public function excluirProduto(): void {
        $sql = "DELETE FROM produtos WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao excluir: " . $erro->getMessage());
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): self {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    public function getPreco(): float {
        return $this->preco;
    }

    public function setPreco(float $preco): self {
        $this->preco = filter_var($preco, FILTER_SANITIZE_NUMBER_FLOAT);
        return $this;
    }

    public function getQuantidade(): int {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): self {
        $this->quantidade = filter_var($quantidade, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    public function getFabricanteId(): int {
        return $this->fabricanteId;
    }

    public function setFabricanteId(int $fabricanteId): self {
        $this->fabricanteId = filter_var($fabricanteId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self {
        $this->descricao = filter_var($descricao, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }
}