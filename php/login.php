<?php

    // var_dump($_POST);

    try {
        include 'conexao.php';

        //  captura os dados recebidos via $_POST
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM tb_usuario WHERE email = :email AND senha = :senha";

        // Anti SQL Injection
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();

        // Guarda os dados do SELECT
        $dados = $stmt->fetchALL((PDO::FETCH_ASSOC));

        // Exibe os Dados(debug)
        // var_dump($dados);

        // verifica se existe informacoes do usuariona variavel $dados
        // isso irá acontecer se o usuario digita o email e senha corretos
        if($dados != null){
            // trabalhando com sessao
            // $_SESSION = acesso global(pode ser acessada de todas as paginas do projeto)
            // $_SESSION = controle e restrição de acesso a aplicação

            // iniciar sessao
            session_start();
            // atribuindo os dados do usuario para a sessao
                // var_dump(session_id());

            // cria variavel de sessao e armazena uma identicação unica do sistema 
            $_SESSION['id_sistema'] = '__meio_ambiente';
            // var_dump($_SESSION['id_sistema']);


            // armazena os dados do usuario para a sessao
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;

            // exit;

            // os dados estao corretos, redireciona o usuarioa para pagina interna
            header("Location: ../cadastrar-categoria.php");
        } else {
            // dados invalidos exibe a variavel erro
            echo "Email ou senha invalidos";
        }
        


    } catch (PDOException $err) {
        echo "Erro ao conectar ao banco de dados: " . $err->getMessage();

    }




?>