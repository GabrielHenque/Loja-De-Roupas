<?php

// Função genérica que lista todos os dados de uma tabela
function listar($conn, $tabela) {
    $sql = "SELECT * FROM $tabela";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função genérica que lista um registro por ID
function listarId($conn, $tabela, $id) {
    $sql = "SELECT * FROM $tabela WHERE id=:id";
    $stmt = $conn->prepare($sql);

    // Anti SQL Injection
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Função genérica de DELETE que deleta o item por ID
function deletar($conn, $tabela, $id) {
    $sql = "DELETE FROM $tabela WHERE id=:id";
    $stmt = $conn->prepare($sql);

    // Anti SQL Injection
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// Inicia a sessão, caso ainda não tenha sido iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Função para adicionar um produto ao carrinho com quantidade padrão de 1
function adicionarAoCarrinho($idProduto, $quantidade = 1) {
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    if (isset($_SESSION['carrinho'][$idProduto])) {
        $_SESSION['carrinho'][$idProduto] += $quantidade; // Incrementa a quantidade
    } else {
        $_SESSION['carrinho'][$idProduto] = $quantidade; // Adiciona novo item
    }
}

// Função para limpar o carrinho
function limparCarrinho() {
    unset($_SESSION['carrinho']);
}

// Função para obter os IDs e quantidades dos produtos no carrinho
function obterItensCarrinho() {
    return isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();
}

// Função para obter os IDs dos produtos no carrinho em formato de string (separados por vírgulas)
function obterIdsCarrinho() {
    if (!empty($_SESSION['carrinho'])) {
        return implode(",", array_keys($_SESSION['carrinho']));
    }
    return "";
}

// Função para atualizar a quantidade de um item no carrinho
function atualizarQuantidade($idProduto, $novaQuantidade) {
    if (isset($_SESSION['carrinho'][$idProduto])) {
        if ($novaQuantidade > 0) {
            $_SESSION['carrinho'][$idProduto] = $novaQuantidade;
        } else {
            // Remove o produto se a quantidade for zero
            unset($_SESSION['carrinho'][$idProduto]);
        }
    }
}

// Função para calcular o subtotal do carrinho
function calcularSubtotal($conn) {
    $subtotal = 0;
    $itensCarrinho = obterItensCarrinho();
    
    if (!empty($itensCarrinho)) {
        $ids = implode(",", array_keys($itensCarrinho));
        $sql = "SELECT id, preco FROM produtos WHERE id IN ($ids)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($produtos as $produto) {
            $id = $produto['id'];
            $quantidade = $itensCarrinho[$id];
            $subtotal += $produto['preco'] * $quantidade;
        }
    }
    
    return $subtotal;
}

?>