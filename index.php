<?php
session_start();

include "backend/conexao.php";
include "php/funcoes.php";

$produtos = listar($conn, 'produtos');
$categorias = listar($conn, 'tb_categoria');

// Verifica se o carrinho está ativo e conta os itens
if (isset($_SESSION["carrinho"])) {
    $qtd_carrinho = count(array_unique($_SESSION["carrinho"]));
} else {
    $qtd_carrinho = 0;
}

try {
    // Conexão com o banco de dados
    include "backend/conexao.php";

    // Busca todas as categorias distintas
    $sql_categorias = "SELECT DISTINCT categoria FROM produtos";
    $stmt_categorias = $conn->prepare($sql_categorias);
    $stmt_categorias->execute();
    $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

    // Busca todas as marcas distintas
    $sql_marcas = "SELECT DISTINCT marca FROM produtos";
    $stmt_marcas = $conn->prepare($sql_marcas);
    $stmt_marcas->execute();
    $marcas = $stmt_marcas->fetchAll(PDO::FETCH_ASSOC);

    // Inicia a consulta básica para os produtos
    $sql = "SELECT * FROM produtos WHERE 1=1"; // `1=1` facilita a adição de condições dinâmicas

    // Verifica se há um termo de busca
    if (isset($_GET['busca']) && !empty($_GET['busca'])) {
        $busca = "%" . $_GET['busca'] . "%"; // Adiciona coringas para a busca com LIKE
        $sql .= " AND (nome LIKE :busca OR categoria LIKE :busca)";
    }

    // Verifica se há um filtro de categoria
    if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
        $categoria = $_GET['categoria'];
        $sql .= " AND categoria = :categoria";
    }

    // Verifica se há um filtro de marca
    if (isset($_GET['marca']) && !empty($_GET['marca'])) {
        $marca = $_GET['marca'];
        $sql .= " AND marca = :marca";
    }

    // Verifica se há um filtro de ordenação por preço
    if (isset($_GET['preco']) && $_GET['preco'] == 'asc') {
        $sql .= " ORDER BY preco ASC";  // Ordena do menor para o maior
    } elseif (isset($_GET['preco']) && $_GET['preco'] == 'desc') {
        $sql .= " ORDER BY preco DESC";  // Ordena do maior para o menor
    }

    // Verifica se há um filtro de ordenação alfabética
    if (isset($_GET['alfabetico']) && $_GET['alfabetico'] == 'az') {
        $sql .= " ORDER BY nome ASC";  // Ordena de A a Z
    } elseif (isset($_GET['alfabetico']) && $_GET['alfabetico'] == 'za') {
        $sql .= " ORDER BY nome DESC";  // Ordena de Z a A
    }

    // Prepara a consulta para produtos
    $stmt = $conn->prepare($sql);

    // Passa os parâmetros da busca, categoria e marca
    if (isset($busca)) {
        $stmt->bindParam(':busca', $busca);
    }
    if (isset($categoria)) {
        $stmt->bindParam(':categoria', $categoria);
    }
    if (isset($marca)) {
        $stmt->bindParam(':marca', $marca);
    }

    // Executa a consulta SQL para produtos
    $stmt->execute();
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $err) {
    echo "Erro: " . $err->getMessage();
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include "php/links.php";
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/home.css">
    <!-- icon -->
    <link rel="shortcut icon" href="logo-branco.ico" type="image/x-icon">

    <title>Loja de Roupas</title>
</head>

<body>

    <div id="container">

        <header>

            <a href="#inicio"><img src="backend/img/logo-preto.png" alt="Logo" class="logo"></a>
            <nav>

                <ul id="menu">
                    <li><a href="#">######</a></li>
                    <li><a href="index_funcao.php"> Funções </a></li>
                    <li><a href="#">@@@@@@</a></li>


                </ul>

            </nav>

            <div id="button">
                <!----------------- Colocar tela de Login ----------------------->
                <button class="button-27" role="button"><a href="html/login.html" target="_blank">Login</a></button>
            </div>

        </header>

        <div id="inicio">



            <div id="inicio-dados">
                <h1>Você está na Drop</h1>

                <h2>Sua Loja preferida de Roupas Streetwear</h2>

                <br><br>

                <p>Veja os Melhores Drops</p>

                <br><br>
                <hr>

            </div>

        </div>



        <!-- Conteudo Principal do Site -->

        <main class="justify-content-center container-xl">

            <br><br>

            <div id="top-musicas">
                <h1>Principais Produtos</h1>

                <h2>Da Semana</h2>

                <p>Curta os Melhores</p>

            </div>

            <br>

            <!-- <div class="d-flex justify-content-center flex-row mb-3 container container-conteudo-principal">

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/Captura de tela 2024-09-05 223034.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div> -->

            <div class="container text-center pt-5 mt-5">
                <div class="row row-cols-5 g-2">

                    <?php
                    foreach ($produtos as $produto):
                        ?>
                        <div class="col">
                            <div class="card teste">
                                <img src="img/miniaturas/<?php echo $produto['imagem'] ?>" alt="Imagem do produto">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $produto['nome'] ?></h5>
                                    <p class="card-text"><?php echo $produto['categoria'] ?></p>
                                    <p class="card-text">R$ <?php echo $produto['preco'] ?></p>
                                    <a href="produto.php?id=<?php echo $produto['id']; ?>"
                                        class="btn btn-primary">Comprar</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <!-- <div class="col">
                        <div class="card h-100">
                            <img src="img/CALÇA DE BOLSO UTILITÁRIA ZARA MAN.webp" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a short card.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/Captura de tela 2024-09-05 223034.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/CALÇA DE BOLSO UTILITÁRIA ZARA MAN.webp" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div> -->


    </div>


    <br><br><br><br>


    <!-- Zap Zap -->

    <div>
        <a href="https://wa.me/55(aqui seu numero com ddd | tudo junto)?text=Adorei%20seu%20artigo"
            style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888 z-index:1000;"
            target="_blank">
            <i style="margin-top:16px" class="fa fa-whatsapp"></i>
        </a>
    </div>

    </main>


    <!-- REFAZER FOOTER -->


    <!-- footer -->
    <footer id="creditos">
        <div class="footer-content">
            <img src="backend/img/logo-branco.png" alt="" class="logo2">
            <ul class="footer-menu">
                <p>Empresas</p>
                <li class="footer-menu-item">
                    Sobre
                </li>
                <li class="footer-menu-item">
                    Empresas
                </li>
                <li class="footer-menu-item">
                    For the License
                </li>
            </ul>

            <ul class="footer-menu">
                <p>Comunidades</p>

                <li class="footer-menu-item">
                    Desenvolvedores
                </li>
                <li class="footer-menu-item">
                    Marcas
                </li>
                </li>
                <li class="footer-menu-item">
                    Investidores
                </li>
                <li class="footer-menu-item">
                    Fornecedores
                </li>
            </ul>

            <ul class="footer-menu">
                <p>Links úteis</p>
                <li class="footer-menu-item">
                    Ajuda
                </li>
                <li class="footer-menu-item">
                    DROP Chat Bot
                </li>
                <li class="footer-menu-item">
                    Contato Suporte
                </li>
            </ul>

            <div class="socials">
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-x-twitter"></i>
                <i class="fa-brands fa-facebook"></i>
            </div>

        </div>

    </footer>

    </div>

</body>

</html>