<?php
$host = getenv("DB_HOST");
$port = getenv("DB_PORT") ?: 5432;
$db   = getenv("DB_NAME");
$user = getenv("DB_USER");
$pass = getenv("DB_PASSWORD");

try {
  $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erro na conexão: " . $e->getMessage());
}


// Caso não esteja usando variáveis de ambiente, descomentar a seção abaixo e comentar a seção acima
/*
$host = "localhost";
$db   = "ktask";
$user = "root";
$pass = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erro na conexão: " . $e->getMessage());
}
*/
?>
