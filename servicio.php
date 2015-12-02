<?php
include_once 'lib/nusoap.php';

$servicio = new soap_server();


//ns es name space
$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("miprimerwebservice", $ns);
$servicio->schemaTargetNamespace = $ns;

$servicio->register("MiFuncion", array('miparametro' => 'xsd:string'), array('return' => 'xsd:string'), $ns);

function MiFuncion($miparametro){

	$resultado = "mi parametro recibido es: " . $miparametro;

	return $resultado;
} 	

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';
$servicio->service($HTTP_RAW_POST_DATA);

?>