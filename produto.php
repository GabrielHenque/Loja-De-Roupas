<?php
 
  try {
   
    include "conexao.php";

    $id = $_GET['id'];

    // comando que sera executado no banco de dados
    $sql = "SELECT * FROM produtos WHERE id=:id";
 
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id',$id);
 
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
    <title>Produto Detalhado</title>
    <link rel="stylesheet" href="produtos.css">
</head>
<body>

<header>
    <h1>Loja de Produtos</h1>
</header>

<main class="product-detail-container">
    <?php   
        foreach($menu as $item){
        ?>
            <div class="product-image">
                <img class="img" src="img/originais/<?php echo $item['imagem']; ?>" alt="">
            </div>
        <?php
    };?>
    <?php
        foreach($menu as $item){
        ?>
            <div class="product-info">
                <h2><?php echo $item['nome']; ?></h2>
                <p class="price"><?php echo $item['preco']; ?></p>
                <p><?php echo $item['descricao']; ?></p>
                <button class="buy-button">Comprar Agora</button>
                <br>
                <br>
                <a href="index.php"><button class="voltar-button">Voltar</button></a>
            </div>
        <?php
    };?>
</main>

<footer>
    <p>© 2024 Loja de Produtos. Todos os direitos reservados.</p>
</footer>

</body>
</html>
