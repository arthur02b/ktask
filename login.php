<?php
require 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
  session_start();
  $_SESSION['usuario_id'] = $usuario['id'];
  $_SESSION['nome'] = $usuario['nome'];
  echo "login_sucesso";
} else {
  echo "erro_login";
}
?>
