<?php
require 'conexao.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(["erro" => "Usuário não autenticado."]);
    exit;
}

$id = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;

if (!$id || !$status) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados incompletos."]);
    exit;
}

try {
    $sql = "UPDATE tarefas SET status = ? WHERE id = ? AND usuario_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$status, $id, $_SESSION['usuario_id']]);

    echo json_encode(["sucesso" => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao atualizar status: " . $e->getMessage()]);
}
?>
