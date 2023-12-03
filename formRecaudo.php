<?php
require_once 'clases/RecaudoService.php';

$host = "localhost";
$usuario = "root";
$contrasena = "12345678";
$base_de_datos = "database";

$recaudoService = new RecaudoService($host, $usuario, $contrasena, $base_de_datos);

$idCliente = filter_input(INPUT_POST, 'idcliente', FILTER_SANITIZE_NUMBER_INT);
$idFactura = filter_input(INPUT_POST, 'idfactura', FILTER_SANITIZE_NUMBER_INT);
$valorRecaudo = filter_input(INPUT_POST, 'valorecaudo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$recaudoFecha = filter_input(INPUT_POST, 'recaudoDate', FILTER_SANITIZE_STRING);

if ($recaudoService->insertarRecaudo($idCliente, $idFactura, $valorRecaudo, $recaudoFecha)) {
    echo "Datos insertados correctamente.";
} else {
    echo "Error al insertar datos. Por favor, inténtalo de nuevo más tarde.";
}

$recaudoService->cerrarConexion();
?>
