<?php
	include_once 'lib/nusoap.php';
	//include_once 'database.php';
	include_once 'PAGO.php';

	$servicio = new soap_server();

	$ns = "urn:PAGOService";
	$servicio->configureWSDL("PAGOService", $ns);
	$servicio->schemaTargetNamespace = $ns;

	$servicio->register("pagar_al_banco", array('monto' => 'xsd:int', 'cod_comercio' => 'xsd:string', 'tipo_tarjeta' => 'xsd:string', 'num_tarjeta' => 'xsd:int', 'fecha_venc' => 'xsd:string', 'cod_seguridad' => 'xsd:int', 'ci_titular' => 'xsd:string'),array('cod_operacion' => 'xsd:string'), $ns);

	function pagar_al_banco($MONTO, $COD_TIENDA, $N_TDC_T, $N_TDC, $FECHA_EXP, $COD_SEG, $CI){
		$pago = hacerPago($MONTO, $COD_TIENDA, $N_TDC_T, $N_TDC, $FECHA_EXP, $COD_SEG, $CI);
		return $pago;
	}

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';
	$servicio->service($HTTP_RAW_POST_DATA);
?>