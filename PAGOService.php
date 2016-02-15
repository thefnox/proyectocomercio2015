<?php
	include_once 'lib/nusoap.php';
	//include_once 'database.php';
	include_once 'PAGO.php';

	$servicio = new soap_server();

	$ns = "urn:PAGOService";
	$servicio->configureWSDL("PAGOService", $ns);
	$servicio->schemaTargetNamespace = $ns;

	$servicio->register("PAGO", array('N_TDC' => 'xsd:string', 'COD_SEG' => 'xsd:number', 'FECHA_EXP' => 'xsd:string', 'MONTO' => 'xsd:float', 'CI' => 'xsd:string', 'COD_TIENDA' => 'xsd:string'),array('COD_OPERACION' => 'xsd:string', 'N_TRANS' => 'xsd:string'), $ns);

	function PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA){
		
		return hacerPago($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA);
	}

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';
	$servicio->service($HTTP_RAW_POST_DATA);
?>