<?php
session_start();

// Configuração de erros
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/caminho/para/seu/error.log'); // Ajuste o caminho
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
  require 'conexao.php'; // Inclui o $pdo

  if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['sucesso' => false, 'erro' => 'Usuário não logado']);
    exit;
  }

  $usuario_id = $_SESSION['usuario_id'];
  $tarefa_id = $_POST['id'] ?? null;

  if (!$tarefa_id || !is_numeric($tarefa_id)) {
    echo json_encode(['sucesso' => false, 'erro' => 'ID da tarefa inválido ou não informado']);
    exit;
  }

  // Usando PDO
  $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ? AND usuario_id = ?");
  $stmt->execute([$tarefa_id, $usuario_id]);

  if ($stmt->rowCount() > 0) {
    echo json_encode(['sucesso' => true]);
  } else {
    echo json_encode(['sucesso' => false, 'erro' => 'Tarefa não encontrada ou não pertence ao usuário']);
  }

} catch (Exception $e) {
  error_log("Erro em excluir_tarefa.php: " . $e->getMessage());
  echo json_encode(['sucesso' => false, 'erro' => 'Erro no servidor: ' . $e->getMessage()]);
  exit;
}
?>