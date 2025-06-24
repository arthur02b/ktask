<?php
$pdo = new PDO("mysql:host=localhost;dbname=ktask", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE tarefas SET titulo=?, descricao=?, data=?, status=? WHERE id=?");
    $stmt->execute([$titulo, $descricao, $data, $status, $id]);

    header("Location: listar_tarefas.php");
    exit;
}
?>
