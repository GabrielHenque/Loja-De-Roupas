<?php

    function addCarrinho($conn,$id_sessao,$id_produto,$quantidade){
            $sql = "INSERT INTO tb_carrinho (id_session,id_produto,quant) VALUES
            (:id_sessao,:id_produto,:quantidade)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_sessao',$id_sessao);
            $stmt->bindParam(':id_produto',$id_produto);
            $stmt->bindParam(':quantidade',$quantidade);
            $stmt->execute();
    }

    function listarCarrinho($conn, $id_sessao){
        $sql = "SELECT 
                    produtos.*,
                    tb_carrinho.quant,tb_carrinho.id id_carrinho
                FROM tb_carrinho
                INNER JOIN produtos ON produtos.id = tb_carrinho.id_produto
                WHERE id_session =:id_sessao
                ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_sessao',$id_sessao);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }

    function deletarProdutoCarrinho($conn,$id_carrinho){
        $sql = "DELETE FROM tb_carrinho WHERE id=:id_carrinho";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_carrinho',$id_carrinho);
        $stmt->execute();
    }

    function limparCarrinho($conn,$id_session){
        $sql = "DELETE FROM tb_carrinho WHERE id_session=:id_session";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_session',$id_session);
        $stmt->execute();
    }

?>