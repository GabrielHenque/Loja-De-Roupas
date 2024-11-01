<?php
include 'php/funcoes.php';
include 'backend/conexao.php';

// Adicionar produto ao carrinho com quantidade padrão de 1 (ou o valor enviado)
if (isset($_POST['id_produto'])) {
    $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;
    adicionarAoCarrinho($_POST['id_produto'], $quantidade);
}

// Verificar se o botão de limpar o carrinho foi acionado
if (isset($_POST['limparCarrinho']) && $_POST['limparCarrinho'] == 'true') {
    limparCarrinho();
}

// Obter os IDs dos produtos e quantidades no carrinho
$itensCarrinho = obterItensCarrinho();
$subtotal = 0;
$menu = array();

if (!empty($itensCarrinho)) {
    $ids = implode(",", array_keys($itensCarrinho));
    $sql = "SELECT * FROM produtos WHERE id IN ($ids)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $subtotal = calcularSubtotal($conn);
}
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
        <?php if (!empty($menu)) { ?>
            <?php foreach ($menu as $item) { 
                $id = $item['id'];
                $quantidade = $itensCarrinho[$id];
                $precoTotal = $item['preco'] * $quantidade;
            ?>
                <div class="cart-item">
                    <div class="product-image">
                        <img src="img/miniaturas/<?php echo $item['imagem']; ?>" alt="<?php echo $item['nome']; ?>">
                    </div>
                    <div class="product-details">
                        <p class="product-name"><?php echo $item['nome']; ?></p>
                        <p>Cor: <?php echo $item['cor']; ?></p>
                        <p>Tamanho: <?php echo $item['tamanho']; ?></p>
                    </div>
                    <form action="carrinho.php" method="post" class="product-quantity-form">
                        <input type="hidden" name="id_produto" value="<?php echo $id; ?>">
                        <div class="product-quantity">
                            <button type="submit" name="quantidade" value="<?php echo $quantidade - 1; ?>" class="btn-decrement">-</button>
                            <input type="text" name="quantidade" value="<?php echo $quantidade; ?>" class="quantity-input" readonly>
                            <button type="submit" name="quantidade" value="<?php echo $quantidade + 1; ?>" class="btn-increment">+</button>
                        </div>
                    </form>
                    <div class="product-price">
                        <p class="unit-price">R$ <?php echo number_format($precoTotal, 2, ',', '.'); ?></p>
                    </div>
                    <form action="carrinho.php" method="post">
                        <input type="hidden" name="limparCarrinho" value="true">
                        <button type="submit" class="btn-remove">Excluir <i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            <?php } ?>
            <!-- Botão de Limpar Carrinho -->
            <form action="carrinho.php" method="post" class="clear-cart-form">
                <input type="hidden" name="limparCarrinho" value="true">
                <button type="submit" class="btn-clear-cart">Limpar Carrinho</button>
            </form>
        <?php } else { ?>
            <p class="empty-cart">Carrinho Vazio!</p>
        <?php } ?>

        <div class="subtotal">
            <p>Subtotal:</p>
            <p class="subtotal-value">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
        </div>
    </section>
    <section class="cart-total">
        <h2>Resumo</h2>
        <div class="summary-details">
            <p>Valor dos produtos: <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span></p>
            <p>Frete: <span>A calcular</span></p>
            <p>Descontos: <span>- R$ 00,00</span></p>
            <p class="total">Total da compra: <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span></p>
        </div>
        <button class="btn-continue">Continuar</button>
    </section>
</main>

<footer class="cart-footer">
    <p>© 2024 Loja de Produtos. Todos os direitos reservados.</p>
</footer>

</body>
</html>