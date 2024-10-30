<?php

// Função generica que lista todos os dados de uma tabeela
function listar($conn, $tabela)
{
    $sql = "SELECT * FROM $tabela";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função generica que lista Todos os por ID
// Função recebe o parametro de conexao, a tabela e o id para o SELECT
function listarId($conn, $tabela, $id)
{
    $sql = "SELECT * FROM $tabela WHERE id=:id";
    $stmt = $conn->prepare($sql);

    // Anti SQL Injection
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Função generica de DELETE que deleta o item por ID
function deletar($conn, $tabela, $id)
{
    $sql = "DELETE FROM $tabela WHERE id=:id";
    $stmt = $conn->prepare($sql);

    // Anti SQL Injection
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}

?>