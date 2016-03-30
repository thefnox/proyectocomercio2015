<?php
	header('Access-Control-Allow-Origin: *');
	
	include_once 'lib/nusoap.php';
	//include_once 'PAGO.php';
	$URL = 'https://proyectocomercio2015-fnox.c9users.io/PAGOService.php';
	$N_TDC = $_GET['N_TDC'];
	$COD_SEG = $_GET['COD_SEG'];
	$FECHA_EXP = $_GET['FECHA_EXP'];
	$MONTO = $_GET['MONTO'];
	$CI = $_GET['CI'];
	$COD_TIENDA = "232";
	
	$PAGO = PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA);

	function PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA){
		$cemon = new nusoap_client($URL, false);
		$req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
		$res = $cemon->call('pagar_al_banco', $req);
		$cemon = null;
		
		return $res;
	}
	
	//var_dump($PAGO);
	
	switch($PAGO){
		case "00":
			echo 'ACEPTADO';
			break;
		case "01":
			echo 'SALDO INSUFICIENTE';
			break;
		case "10":
			echo 'DATOS INVALIDOS';
			break;
		case "99":
			echo 'SIN CONEXION';
			break;
		case "11":
		default:
			echo 'OTROS';
			break;
		
	}
	
?>