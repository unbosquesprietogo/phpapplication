<?php
// Iniciar o reanudar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["username"])) {
    // Si la sesión no está iniciada, redirigir a la página de inicio de sesión
    header("Location: login.html");
    exit(); // Asegúrate de detener la ejecución del script después de la redirección
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
    <h1>Hola, Bienvenido!</h1>
    <p>Esta es tu página principal.</p>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
