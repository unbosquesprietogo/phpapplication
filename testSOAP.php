<?php

echo "<script>";
echo "console.log('hola');";
echo "</script>";

$wsdlUrl = 'http://localhost/phpapplication/wsdl/recaudo.wsdl';
echo "<script>";
echo "console.log('wsdl');";
echo "</script>";
try {
    $soapClient = new SoapClient($wsdlUrl, array('trace' => 1));
    // El código a continuación de esta línea se ejecutará si la creación de SoapClient tiene éxito.
} catch (SoapFault $e) {
    // Se captura una excepción SoapFault en caso de que ocurra un error en la creación del cliente SOAP.
    echo "Error al crear el cliente SOAP: " . $e->getMessage();
} catch (Exception $e) {
    // Se captura cualquier otra excepción que no sea una SoapFault.
    echo "Error general: " . $e->getMessage();
}
echo "<script>";
echo "console.log('cliente');";
echo "</script>";

try {
    echo "<script>";
    echo "console.log('try');";
    echo "</script>";
    $resultado = $response->RecaudoResponse->resultado;
    $response = $soapClient->obtenerRecaudosPendientes();
    print_r($response);
} catch (SoapFault $e) {
    echo "<script>";
    echo "console.log('catch');";
    echo "</script>";
    echo 'Error: ' . $e->getMessage();
}
?>