<?php
require 'conexao.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401); // Não autorizado
    echo json_encode([
        "erro" => "Usuário não autenticado."
    ]);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

try {
    // Busca as tarefas do usuário logado
    $sql = "SELECT id, titulo, descricao, data_entrega, prioridade, status, criado_em 
            FROM tarefas 
            WHERE usuario_id = ?
            ORDER BY criado_em DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario_id]);
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tarefas);
} catch (PDOException $e) {
    http_response_code(500); // Erro do servidor
    echo json_encode([
        "erro" => "Erro ao buscar tarefas: " . $e->getMessage()
    ]);
}
?>
