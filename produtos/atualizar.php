<?php
use ExemploCrudPoo\Produto;

require_once "../vendor/autoload.php";

$produto = new Produto;
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['atualizar'])) {
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT);
    $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_NUMBER_INT);
    $fabricanteId = filter_input(INPUT_POST, "fabricante", FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

    
    $produto->setId($id);
    $produto->setNome($nome);
    $produto->setPreco($preco);
    $produto->setQuantidade($quantidade);
    $produto->setFabricanteId($fabricanteId);
    $produto->setDescricao($descricao);

    
    $produto->atualizarProduto();

    header("location: visualizar.php");
}


$produtoDados = $produto->lerUmProduto($id);
?>
