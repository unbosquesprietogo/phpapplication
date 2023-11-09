<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Mostrar información de la sesión
echo "Bienvenido, " . $_SESSION["username"] . "! Esta es tu página principal.";
?>
