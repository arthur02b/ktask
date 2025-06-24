<?php
if (extension_loaded('pdo_pgsql')) {
    echo "✅ pdo_pgsql está habilitado!";
} else {
    echo "❌ pdo_pgsql NÃO está habilitado.";
}
?>
