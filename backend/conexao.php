<?php
$servername = "localhost";
$username = "root";
$password = "";
// alterar a var database de acordo com o projeto
$database = "db_meio_ambiente";
// apenas alteramos as var acima para conexao do banco, o restante do codigo e padrão

// --------------- --------------- --------------- --------------- --------------

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


?>