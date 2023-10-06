<?php
use ExemploCrudPoo\Produto;
require_once "../vendor/autoload.php";
$objetoProduto = new Produto;
$objetoProduto->setId($_GET["id"]);
$objetoProduto->excluirProduto();
header("location:visualizar.php");