<?php
require 'conexao.php'; // usa seu PDO com variáveis de ambiente

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS usuarios (
  id SERIAL PRIMARY KEY,
  nome TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  senha_hash TEXT NOT NULL,
  criado_em TIMESTAMPTZ DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS tarefas (
  id SERIAL PRIMARY KEY,
  usuario_id INTEGER NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
  titulo TEXT NOT NULL,
  descricao TEXT,
  data_entrega DATE,
  prioridade TEXT DEFAULT 'media',
  status TEXT DEFAULT 'a-fazer',
  criado_em TIMESTAMPTZ DEFAULT NOW()
);
SQL;

try {
  $pdo->exec($sql);
  echo "<h3>Tabelas criadas com sucesso ✅</h3>";
} catch (PDOException $e) {
  echo "<h3>Erro ao criar tabelas ❌:</h3>";
  echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
