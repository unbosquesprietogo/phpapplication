<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

    class servicioSOAP{
        
        public function obtenerRecaudosPendientes()
        {
            console.log("obtener recaudos");
            $consulta = $this->conexion->prepare("SELECT * FROM RECAUDO WHERE ESTADO_RECAUDO = 'Cancelado' AND ESTADO_ENVIO = 'Falso'");
            console.log("preparacion lista");    
            $consulta->execute();
            console.log("Consulta lista");
            $result = $consulta->get_result();
            console.log("Resultado: " + get_result());
            $recaudos = array();
            console.log("Recaudos" + array());
            while ($row = $result->fetch_assoc()) {
                    $recaudos[] = $row;
            }

            $consulta->close();

            return $recaudos;

            console.log("Paso");
        }

        public function cerrarConexion()
        {
                $this->conexion->close();
        }
    }
    
        // Crear el servidor SOAP
        $server = new SoapServer(null, array('uri' => 'http://localhost/phpapplication/serviceSOAP.php'));
        $server->setClass('obtenerRecaudosPendientes');
        $server->handle();
?>