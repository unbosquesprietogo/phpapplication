<?php

require_once 'clases/RecaudoService.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

    class serviceSOAP {

        private $conexion;

        public function obtenerRecaudosPendientes()
        {
            $host = "localhost";
            $usuario = "root";
            $contrasena = "12345678";
            $base_de_datos = "neardb";

            // Corregir la referencia a la propiedad
            $this->conexion = new RecaudoService($host, $usuario, $contrasena, $base_de_datos);

            $consulta = $this->conexion->prepare("SELECT * FROM RECAUDO WHERE ESTADO_RECAUDO = 'Cancelado' AND ESTADO_ENVIO = 'Falso'");

            $consulta->execute();

            $result = $consulta->get_result();

            $recaudos = array();

            while ($row = $result->fetch_assoc()) {
                $recaudos[] = $row;
            }

            $consulta->close();

            // Cerrar la conexión después de obtener los resultados
            $this->conexion->cerrarConexion();

            return $recaudos;
        }

        public function cerrarConexion()
        {
            $this->conexion->cerrarConexion();
        }
    }


    
        // Crear el servidor SOAP
        $wsdlConfig = array(
            'uri' => 'http://localhost/phpapplication/serviceSOAP.php',
            'encoding' => 'UTF-8',
            'soap_version' => SOAP_1_2,
        );
        $wsdlFile =  'wsdl/recaudo.wsdl';
        $server = new SoapServer($wsdlFile, $wsdlConfig);
        $server->setClass('serviceSOAP');
        $server->handle();
?>