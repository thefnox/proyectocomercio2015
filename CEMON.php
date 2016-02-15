<?php
	header('Access-Control-Allow-Origin: *');
	
	include_once 'lib/nusoap.php';
	//include_once 'PAGO.php';
	
	$N_TDC = $_GET['N_TDC'];
	$COD_SEG = $_GET['COD_SEG'];
	$FECHA_EXP = $_GET['FECHA_EXP'];
	$MONTO = $_GET['MONTO'];
	$CI = $_GET['CI'];
	$COD_TIENDA = "232";
	
	$PAGO = PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA);

	function PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA){
		//$cemon = new nusoap_client('https://proyectocomercio2015-fnox.c9users.io/BANCO3_debitar.php?wsdl', false);
		$cemon = new nusoap_client('https://proyectocomercio2015-fnox.c9users.io/PAGOService.php', false);
		$req = array('N_TDC' => $N_TDC, 'COD_SEG' => $COD_SEG, 'FECHA_EXP' => $FECHA_EXP, 'MONTO' => $MONTO, 'CI' => $CI, 'COD_TIENDA' => $COD_TIENDA);
		$res = $cemon->call('PAGO', $req);
		$cemon = null;
		
		return $res;
	}
	
	//echo '<'.$PAGO['COD_OPERACION'].'>';
	
	if($PAGO['COD_OPERACION'] == "00"){
		echo 'ACEPTADO';
	}else{
		if($PAGO['COD_OPERACION'] == "01") echo 'SALDO INSUFICIENTE';
		else{
			if($PAGO['COD_OPERACION'] == "10") echo 'DATOS INVALIDOS';
			else{
				if($PAGO['COD_OPERACION'] == "99") echo 'SIN CONEXION';
				else{
					if($PAGO['COD_OPERACION'] == "11") echo 'TARJETA VENCIDA';
					else echo 'NEGADA';
				}
			}
		}
	}
?>