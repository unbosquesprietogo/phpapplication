<?php

class RecaudoService
{
    private $conexion;

    public function __construct($host, $usuario, $contrasena, $base_de_datos)
    {
        $this->conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

        if ($this->conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conexion->connect_error);
        }
    }

    public function insertarRecaudo($idCliente, $idFactura, $valorRecaudo, $recaudoFecha)
    {
        $consulta = $this->conexion->prepare("INSERT INTO RECAUDO (ID_CLIENTE_RECAUDO, ID_FACTURA_RECAUDO, VALOR_RECAUDO, FECHA_RECAUDO) VALUES (?, ?, ?, ?)");
        $consulta->bind_param("iiid", $idCliente, $idFactura, $valorRecaudo, $recaudoFecha);

        if ($consulta->execute()) {
            return true;
        } else {
            error_log("Error al insertar datos: " . $consulta->error, 0);
            return false;
        }
    }

    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}

?>
