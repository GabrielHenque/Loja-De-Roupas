<?php

include "backend/conexao.php";
include "php/funcoes.php";

$produtos = listar($conn, 'produtos');
$categorias = listar($conn, 'tb_categoria');

// deletar($conn, 'tb_categoria', 1);



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include "php/links.php";
    ?>

    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/index_funcao.css">
    <link rel="shortcut icon" href="logo-branco.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <title>Loja Função</title>
</head>

<body>

    <div class="container">

        <div id="inicio">

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
                    <button class="button-27" role="button"><a href="html/login.html"
                            target="_blank">Button</a></button>
                </div>

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


            <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="img/Captura de tela 2024-09-05 223034.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Blusa Basica</h5>
                            <p class="card-text">Blusa</p>
                            <p><span>R$ 29.90</span></p>
                        </div>
                    </div>
                </div>

            </div> -->

            <div class="container text-center pt-5 mt-5">
                <div class="row row-cols-5 g-2">

                    <?php
                    foreach ($produtos as $produto):
                        ?>
                        <div class="col">
                            <div class="card">
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

        </main>


    </div>

    <!-- Footer -->

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


</body>

</html>