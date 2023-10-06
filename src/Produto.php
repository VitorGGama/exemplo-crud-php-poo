<?php
namespace ExemploCrudPoo;
use PDO, Exception;

final class Produto {
    private int $id;
    private string $nome;
    private string $descricao;
    private float $preco;
    private int $quantidade;
    private int $fabricanteId;
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();        
    }

    public function lerProdutos():array {
        $sql = "SELECT 
                    produtos.id,
                    produtos.nome AS produto,
                    produtos.preco,
                    produtos.quantidade,
                    fabricantes.nome AS fabricante
                FROM produtos INNER JOIN fabricantes
                ON produtos.fabricante_id = fabricantes.id
                ORDER BY produto";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar produtos: ".$erro->getMessage());
        }
        
        return $resultado;
    }


    public function inserirProduto():void {
        $sql = "INSERT INTO produtos(
            nome, preco, quantidade, descricao, fabricante_id
        ) VALUES(
            :nome, :preco, :quantidade, :descricao, :fabricanteId
        )";    
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
            $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->bindValue(":fabricanteId", $this->fabricanteId, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: ".$erro->getMessage());
        }
    }

    public function lerUmProduto():array {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }    
        return $resultado;
    }
    
    
    public function atualizarProduto():void {
    
        $sql = "UPDATE produtos SET
            nome = :nome,
            preco = :preco,
            quantidade = :quantidade,
            descricao = :descricao,
            fabricante_id = :fabricanteId WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
            $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->bindValue(":fabricanteId", $this->fabricanteId, PDO::PARAM_INT);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar: ".$erro->getMessage());
        }   
    }


    public function excluirProduto():void {
        $sql = "DELETE FROM produtos WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao excluir: ".$erro->getMessage());
        }
    }


















    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self  {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    /**
     * Get the value of nome
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @param string $nome
     *
     * @return self
     */
    public function setNome(string $nome): self {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    /**
     * Get the value of descricao
     *
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @param string $descricao
     *
     * @return self
     */
    public function setDescricao(string $descricao): self {
        $this->descricao = filter_var($descricao, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    /**
     * Get the value of preco
     *
     * @return float
     */
    public function getPreco(): float
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @param float $preco
     *
     * @return self
     */
    public function setPreco(float $preco): self {
        $this->preco = filter_var($preco, FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION);
        return $this;
    }

    /**
     * Get the value of quantidade
     *
     * @return int
     */
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     *
     * @param int $quantidade
     *
     * @return self
     */
    public function setQuantidade(int $quantidade): self {
        $this->quantidade = filter_var($quantidade, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    /**
     * Get the value of fabricanteId
     *
     * @return int
     */
    public function getFabricanteId(): int
    {
        return $this->fabricanteId;
    }

    /**
     * Set the value of fabricanteId
     *
     * @param int $fabricanteId
     *
     * @return self
     */
    public function setFabricanteId(int $fabricanteId): self {
        $this->fabricanteId = filter_var($fabricanteId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
}