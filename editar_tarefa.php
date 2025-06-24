<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ktask", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST['id'] ?? null;
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $data_entrega = $_POST['data_entrega'] ?? null;
        $prioridade = $_POST['prioridade'] ?? 'baixa';

        if (!$id || !$titulo) {
            echo json_encode(['sucesso' => false, 'erro' => 'ID e título são obrigatórios.']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE tarefas SET titulo = ?, descricao = ?, data_entrega = ?, prioridade = ? WHERE id = ?");
        $success = $stmt->execute([$titulo, $descricao, $data_entrega, $prioridade, $id]);

        if ($success) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao atualizar tarefa.']);
        }
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Método não permitido.']);
    }
} catch (Exception $e) {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro de servidor: ' . $e->getMessage()]);
}
?>
