<?php

try {

    include "backend/conexao.php";

    $sql = "SELECT * FROM produtos";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $menu = $stmt->fetchAll((PDO::FETCH_ASSOC));


} catch (PDOException $err) {
    echo "Erro ao conectar ao banco de dados: " . $err->getMessage();
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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <title>Loja de Roupas</title>
</head>

<body>

    <div id="container">

        <header>

            <a href="#inicio"><img src="backend/img/logo-preto.png" alt="Logo" class="logo"></a>
            <nav>

                <ul id="menu">
                    <li><a href="#">######</a></li>
                    <li><a href="#">$$$$$$</a></li>
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

            <div class="d-flex justify-content-center flex-row mb-3 container container-conteudo-principal">

                <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/Captura de tela 2024-09-05 223034.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
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
                    </div>
                </div> -->


                <section class="produtos">

                    <?php foreach ($menu as $item) { ?>


                        <div class="produto-card">
                            <img src="img/miniaturas/<?php echo $item['imagem'] ?>" alt="" class="credito-card">
                            <h3><?php echo $item['nome'] ?></h3>
                            <p><?php echo $item['descricao'] ?></p>
                            <p class="preco"><?php echo $item['preco'] ?></p>
                            <a href="produto.php?id=<?php echo $item['id'] ?> "><button>Saiba Mais</button></a>
                        </div>
                        <?php
                    }
                    ;
                    ?>
                </section>

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