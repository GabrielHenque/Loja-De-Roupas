<?php

session_start();

$_SESSION['carrinho'] = array();

$_SESSION['carrinho']['id'] = 10;

$ids = $_SESSION ['carrinho']['id'];


try{

    $quantidade = 1;

    include "backend/conexao.php";

    $sql = "SELECT * FROM produtos WHERE id IN ($ids)";
 
    $stmt = $conn->prepare($sql);

    // $stmt->bindParam(':id',$id);
 
    $stmt->execute();

    $menu = $stmt->fetchAll((PDO::FETCH_ASSOC));
}catch(PDOException $err){
    echo "Erro".$err->getMessage();
  }



?>





<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="carrinho.css">
</head>
<body>

<header>
    <h1>Loja de Produtos</h1>
</header>

<main class="cart-container">
    <div class="cart-steps">
        <span class="step active">1. Carrinho</span>
        <span class="step">2. Identificação</span>
        <span class="step">3. Pagamento</span>
    </div>

    <section class="cart-items">
        <h2>Seu Carrinho</h2> 
        <?php
            foreach($menu as $item){
        ?>
            <div class="cart-item">
                <div class="product-image">
                    <img class="img" src="img/miniaturas<?php echo $item['imagem']; ?>" alt="">
                </div>
                <div class="product-details">
                    <p class="product-name"><?php echo $item['nome']; ?></p>
                    <p>Cor: <?php echo $item['cor']; ?></p>
                    <p>Tmanho: <?php echo $item['tamanho']; ?></p>
                </div>
                <form action="" class="">
                    <div class="product-quantity">
                        <button class="btn-decrement">-</button>
                        <input type="text" value="1" class="quantity-input">
                        <button class="btn-increment">+</button>
                    </div>
                    <div class="product-price">
                        <p class="unit-price"><?php echo $item['preco']; ?></p>
                    </div>
                    <div class="remove-item">
                        <button class="btn-remove">Excluir <i class="fa-solid fa-trash"></i> </button>
                    </div>
                </form>
            </div>
        <?php
        };?>

        <div class="subtotal">
            <p>Subtotal:</p>
            <p class="subtotal-value">R$ 129,99</p>
        </div>
    </section>
    <section class="cart-total">
        <h2>Resumo</h2>
        <div class="summary-details">
            <p>Valor dos produtos: <span>R$ 129,99</span></p>
            <p>Frete: <span>A calcular</span></p>
            <p>Descontos: <span>- R$ 00,00</span></p>
            <p class="total">Total da compra: <span>R$ 129,99</span></p>
        </div>
        <button class="btn-continue">Continuar</button>
    </section>
</main>

<footer class="cart-footer">
    <p>© 2024 Loja de Produtos. Todos os direitos reservados.</p>
</footer>

</body>
</html>