<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['erro' => 'Usuário não autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

try {
    $stmt = $pdo->prepare("SELECT nome, email, criado_em FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        echo json_encode([
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'data_cadastro' => $usuario['criado_em']
        ]);
    } else {
        echo json_encode(['erro' => 'Usuário não encontrado']);
    }
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro na consulta: ' . $e->getMessage()]);
}
