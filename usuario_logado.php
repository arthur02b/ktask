<?php
session_start();

if (isset($_SESSION['nome'])) {
    echo json_encode(['nome' => $_SESSION['nome']]);
} else {
    echo json_encode(['nome' => 'Usuário']);
}
?>