<?php 

if (isset($_POST["btn_cadastrar"])) {

    try {
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $estoque = $_POST["estoque"];
        $categoria = $_POST["categoria"];
        $tamanho = $_POST["tamanho"];
        $cor = $_POST["cor"];
        $marca = $_POST["marca"];


        // Caminho pra Armazena as Imagem Ex:".png .jpg"
        $caminho1 = 'img/';  // Primeiro caminho
        $caminho2 = 'img/originais/';  // Segundo caminho (cópia de segurança)

        // Captura a extensão da imagem enviada para upload (Ex: .png .jpg)
        $extensao = pathinfo($_FILES['imagem']['tmp_name'], PATHINFO_FILENAME);

        // Gera um hash aleatório para a imagem (nome aleatório)
        $hash = md5 (uniqid($_FILES['imagem']['tmp_name'], true));

        // Junta o hash (nome aleatório) + extensão
        $nome_imagem = $hash . '.' . $extensao;

        // Executa o upload da imagem no primeiro caminho
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho1 . $nome_imagem);

        // Copia a imagem para o segundo caminho
        copy($caminho1 . $nome_imagem, $caminho2 . $nome_imagem);

        
        include '../backend/conexao.php'; // Conexão


        $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria, tamanho, cor, marca, imagem)
                VALUES (:nome, :descricao, :preco, :estoque, :categoria, :tamanho, :cor, :marca, :imagem)";

        // Vincula os parâmetros
        // Proteção anti SQL Injection
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':tamanho', $tamanho);
        $stmt->bindParam(':cor', $cor);
        $stmt->bindParam(':marca', $marca);
        $stmt->bindParam(':imagem', $nome_imagem);


        // Executa a query
        $stmt->execute();

        echo "Cadastro realizado com sucesso";

    } catch (PDOException $err) {
        echo "Não foi possível realizar o cadastro" . $err->getMessage();
    }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './php/links_admin.php'; ?>

    <link rel="stylesheet" href="./css/cadastrar.css">

    <title>Cadastrar Produtos</title>
</head>

<body>

    <main class="justify-content-center align-items-center">
        <div class="clerinton">

            <div class="clerinton  text-white">
                <form class="post-container text-white" enctype="multipart/form-data" action="php/cadastrar-produto.php"
                    method="POST">
                    <h2 class="text-white justify-content-center align-items-center">Cadastrar Produto</h2>
                    <div class="form-group">
                        <div class="input-group mb-3 text-white">
                            <span class="input-group-text" id="basic-addon1">#</span>
                            <input type="text" class="form-control" placeholder="Nome do Produto" aria-label="Username"
                                aria-describedby="basic-addon1" name="titulo" id="titulo">
                        </div>
                    </div>
                    <!-- <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        <select class="form-selec" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                    <div class="form-group align-items-center">
                        <label class="d-flex gap-3 text-white justify-content-center" for="media">Foto Produto <i
                                class="fa-solid fa-image"></i></label>
                        <div class="media-section d-flex justify-content-center align-items-center">
                            <!-- input -->
                            <div class="form-group image-upload-container">
                                <label for="imagem" class="image-upload-label">
                                    <span class="image-upload-icon">📁</span> Escolher a Imagem
                                </label>
                                <input type="file" name="foto[]" id="imagem" class="image-upload" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-white">
                        <label class="d-flex gap-3 text-white justify-content-center" for="post-text">Publicação
                            personalizada<i class="fa-solid fa-clipboard"></i></label>
                        <textarea id="descricao" name="descricao" placeholder="Escreva sua legenda aqui..."></textarea>
                    </div>

                    <!-- <div id="informacoes">
                        <input type="hidden" name="categoria" id="categoria" value="1">
                        <input type="hidden" name="local" id="local" value="troca">
                        <input type="hidden" name="public" id="public" value="3">
                        <input type="hidden" name="tipo" id="tipo" value="2">
                        <input type="hidden" name="status" id="status" value="1">
                    </div> -->

                    <div class="mb-4 actions text-white justify-content-center align-items-center">
                        <!-- <button class="schedule-btn">Concluir mais tarde</button> -->
                        <button type="submit" class="publish-btn" id="btnCadastrar">Publicar</button>
                    </div>

                </form>
            </div>
    </main>

</body>

</html>