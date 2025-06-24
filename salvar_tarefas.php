<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['erro' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$titulo = $_POST['titulo'] ?? '';
$descricao = $_POST['descricao'] ?? null;
$data_entrega = $_POST['data_entrega'] ?? null;
$prioridade = $_POST['prioridade'] ?? 'media';
$status = $_POST['status'] ?? 'a-fazer';

// Normaliza campos vazios
$descricao = $descricao !== '' ? $descricao : null;
$data_entrega = $data_entrega !== '' ? $data_entrega : null;

try {
    $stmt = $pdo->prepare("INSERT INTO tarefas (usuario_id, titulo, descricao, data_entrega, prioridade, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$usuario_id, $titulo, $descricao, $data_entrega, $prioridade, $status]);

    echo json_encode(['sucesso' => true]);
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro ao salvar tarefa: ' . $e->getMessage()]);
}
