<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // criptografia da senha em hash

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ktask", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            header("Location: cadastro.html?erro=email");
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $senha]);

        header("Location: login.html"); 
        exit;
    } catch (PDOException $e) {
        echo "Erro no cadastro: " . $e->getMessage();
    }
}
?>
