<?php

    include "backend/conexao.php";
    include "php/funcoes.php";

    // Setando fixo o id do produto, sera via $_GET
    $id = $_GET['id'];

    $produto = listarId($conn, 'produtos', $id);
    


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto Detalhado</title>
    <link rel="stylesheet" href="css/produtos.css">
</head>

<body>

    <header>
        <h1>Loja de Produtos</h1>
    </header>

    <main class="product-detail-container">

            <div class="product-image">
                <img class="img" src="img/originais/<?php echo $produto['imagem']; ?>" alt="">
            </div>
            <div class="product-info">
                <h2><?php echo $produto['nome']; ?></h2>
                <p class="price"><?php echo $produto['preco']; ?></p>
                <p><?php echo $produto['descricao']; ?></p>

                <form action="carrinho.php" method="POST">
                    <button class="buy-button" name="id_produto" value="<?php echo $produto['id']; ?>">Comprar Agora</button>
                </form>

                <br>
                <br>
                <a href="index.php"><button class="voltar-button">Voltar</button></a>
            </div>
    </main>

<br><br><br><br><br>

    <footer>
        <p>© 2024 Loja de Produtos. Todos os direitos reservados.</p>
    </footer>

</body>

</html>