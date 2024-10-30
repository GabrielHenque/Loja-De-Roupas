<?php

include "backend/conexao.php";
include "php/funcoes.php";

$categorias = listar($conn, 'tb_categoria');

if (isset($_POST['btn_deletar'])) {
    deletar($conn, 'tb_categoria', $_POST['btn_deletar']);
}



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
        <h1>tabela produtos</h1>
    </header>

    <main class="product-detail-container">

        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Categoria</td>
                    <td>Data</td>
                    <td>Ações</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($categorias as $categoria) { ?>
                    <tr>
                        <td><?php echo $categoria['id'] ?></td>
                        <td><?php echo $categoria['categoria'] ?></td>
                        <td><?php echo $categoria['data_cad'] ?></td>
                        <td>
                            <form action="categoria.php" method="POST">
                                <input type="hidden" name="id" id="id" value="<?php echo $categoria['id']; ?>">
                                <button type="submit" class="btn-deletar" name="btn_deletar"
                                    value="<?php echo $categoria['id']; ?>">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </main>

    <br><br><br><br><br>

    <footer>
        <p>© 2024 Loja de Produtos. Todos os direitos reservados.</p>
    </footer>

</body>

</html>