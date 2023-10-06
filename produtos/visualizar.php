<?php
use ExemploCrudPoo\Produto;
use ExemploCrudPoo\Utilitarios;
require_once "../vendor/autoload.php";
$produto = new Produto;
$listaDeProdutos = $produto->lerProdutos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Visualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Produtos | SELECT - <a href="../index.php">Home</a> </h1>
        <hr>
        <h2>Lendo e carregando todos os produtos.</h2>
        <p><a href="inserir.php">
            Inserir novo produto</a></p>
        <div class="row">
<?php foreach( $listaDeProdutos as $dadosProduto ){ ?>
            <div class="col-md-6">
                <article class="shadow p-2">
                    <h3> <?=$dadosProduto["produto"]?> </h3>
                    <h4> <?=$dadosProduto["fabricante"]?> </h4>
                    
                    <p><b>Preço:</b> 
                    <?=Utilitarios::formatarPreco($dadosProduto["preco"])?> </p>

                    <p><b>Quantidade:</b> <?=$dadosProduto["quantidade"]?> </p>
                    
            <p><b>Total:</b>
            <?=Utilitarios::calcularTotal
            ($dadosProduto["preco"], $dadosProduto["quantidade"])
            ?></p>

                    <hr>
                    <p>
                        <a href="atualizar.php?id=<?=$dadosProduto["id"]?>">Editar</a> |
                        <a class="excluir" href="excluir.php?id=<?=$dadosProduto["id"]?>">Excluir</a>
                    </p>
                </article>
            </div>
<?php } ?>
        </div>
    </div>

    <script src="../js/confirma-exclusao.js"></script>

</body>
</html>