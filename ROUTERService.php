<?php
include_once 'lib/nusoap.php';

$servicio = new soap_server();


//ns es name space
$ns = "urn:ROUTERService";
$servicio->configureWSDL("ROUTERService", $ns);
$servicio->schemaTargetNamespace = $ns;

$servicio->register("Disponibilidad", array('name' => 'xsd:string', 'fecha' => 'xsd:string'), array('name' => 'xsd:string', 'disp' => 'xsd:float'), $ns);

function Disponibilidad($name, $fecha){

	$disp = rand(0,1000)/1000;

	return array($name, $disp);
} 	

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';
$servicio->service($HTTP_RAW_POST_DATA);

?>