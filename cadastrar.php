<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'conexao.php'; // usa as variáveis de ambiente e driver correto

    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    try {
        // Verifica se o e-mail já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            header("Location: cadastro.html?erro=email");
            exit;
        }

        // Insere novo usuário
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $senha]);

        header("Location: login.html");
        exit;
    } catch (PDOException $e) {
        echo "Erro no cadastro: " . $e->getMessage();
    }
}
?>
