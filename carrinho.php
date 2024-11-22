<?php
include 'php/funcoes.php';
include 'php/funcao_carrinho.php';
include 'backend/conexao.php';

//   Carrinho

// inicia a sessao
session_start();

$id_sessao = session_id();

if(isset($_POST['id_produto'])){

    $id_produto = $_POST['id_produto'];
    addCarrinho($conn,$id_sessao,$id_produto,1);
}

if (isset($_POST['id_carrinho'])) {
    
    $id_carrinho = $_POST['id_carrinho'];
    deletarProdutoCarrinho($conn,$id_carrinho);
}

if (isset($_POST['limparCarrinho'])) {
    limparCarrinho($conn,$id_sessao);
}

// Executa a funcao e armazena o resultado do carrinho
$produtos = listarCarrinho($conn,$id_sessao);

$quantidade = 0

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>

    <?php include "php/links.php"; ?>

    <link rel="stylesheet" href="css/carrinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

                $valor_frete = 20.00;

                $valor_produtos = 0.00;
            
                if (!empty($produtos)) { ?>

                <?php

                    foreach ($produtos as $produto) {
                    $valor_produtos += $produto['preco'];

                    

                ?>
                    <div class="cart-item">
                        <div class="product-image">
                            <img src="img/miniaturas/<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                        </div>
                        <div class="product-details">
                            <p class="product-name"><?php echo $produto['nome']; ?></p>
                            <p>Cor: <?php echo $produto['cor']; ?></p>
                            <p>Tamanho: <?php echo $produto['tamanho']; ?></p>
                        </div>
                        <form action="carrinho.php" method="post" class="product-quantity-form">
                            <input type="hidden" name="id_produto" value="<?php echo $id; ?>">
                            <div class="product-quantity">
                                <button type="submit" name="quantidade" value="<?php echo $quantidade - 1; ?>"
                                    class="btn-decrement">-</button>
                                <input type="text" name="quantidade" value="<?php echo $quantidade; ?>" class="quantity-input"
                                    readonly>
                                <button type="submit" name="quantidade" value="<?php echo $quantidade + 1; ?>"
                                    class="btn-increment">+</button>
                            </div>
                        </form>
                        <div class="product-price">
                            <p class="unit-price">R$ <?php echo number_format($precoTotal, 2, ',', '.'); ?></p>
                        </div>
                        <form action="carrinho.php" method="post">
                            <input type="hidden" name="id_carrinho" value="<?php echo $produto['id_carrinho']; ?>">
                            <button type="submit" class="btn-remove">Excluir <i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                <?php } ?>
                <!-- Botão de Limpar Carrinho -->
                <form action="carrinho.php" method="post" class="clear-cart-form">
                    <input type="hidden" name="limparCarrinho">
                    <button type="submit" class="btn-clear-cart">Limpar Carrinho</button>
                </form>
            <?php } else { ?>
                <div class="card text-center">

                    <div class="card-body">
                        <div class="alert alert-warning fs-3 fw-bold" role="alert">
                        Carrinho Vazio!
                        </div>
                        <p class="card-text">Você apagou todos os itens do <span class="text-decoration-underline">Carrinho!</span></p>
                        <a href="index_funcao.php" class="btn btn-primary">Voltar as Compras</a>
                    </div>

                </div>
            <?php } ?>

            <div class="subtotal">
                <p>Subtotal:</p>
                <p class="subtotal-value">R$ <?php ; ?></p>
            </div>
        </section>
        <section class="cart-total">
            <h2>Resumo</h2>
            <div class="summary-details">
                <p>Valor dos produtos: <span>R$ <?php echo $valor_produtos; ?></span></p>
                <p>Frete: <span>R$ <?php echo $valor_frete; ?></span></p>
                <p>Descontos: <span>- R$ 00,00</span></p>
                <p class="total">Total da compra: <span> R$ <?php echo $valor_produtos + $valor_frete; ?></span>
                </p>
            </div>
            <button class="btn-continue">Continuar</button>
        </section>
    </main>

    <footer class="cart-footer">
        <p>© 2024 Loja de Produtos. Todos os direitos reservados.</p>
    </footer>

</body>

</html>