<?php
	header('Access-Control-Allow-Origin: *');
	
	include_once 'lib/nusoap.php';
	
	$N_TDC = $_GET['N_TDC'];
	$COD_SEG = $_GET['COD_SEG'];
	$FECHA_EXP = $_GET['FECHA_EXP'];
	$MONTO = $_GET['MONTO'];
	$CI = $_GET['CI'];
	
	$PAGO = PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI);

	function PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI){
		$cemon = new nusoap_client('https://proyectocomercio2015-fnox.c9users.io/BANCO3_debitar.php', false);
		$req = array('N_TDC' => $N_TDC, 'COD_SEG' => $COD_SEG, 'FECHA_EXP' => $FECHA_EXP, 'MONTO' => $MONTO, 'CI' => $CI);
		$res = $cemon->call('debitar', $req);
		$cemon = null;
		
		return $res;
	}
	
	echo 'Numero de Transaccion: ';
	echo $PAGO['N_TRANSAC'];
	echo '<br>';
	
	if($PAGO['COD_OPERACION'] == "00"){
		echo 'ACEPTADO';
	}else{
		if($PAGO['COD_OPERACION'] == "01"){
		echo 'SALDO INSUFICIENTE';
	}else{
		if($PAGO['COD_OPERACION'] == "10"){
		echo 'DATOS INVALIDOS';
	}else{
		if($PAGO['COD_OPERACION'] == "99"){
		echo 'SIN CONEXION';
	}else{
		if($PAGO['COD_OPERACION'] == "11"){
		echo 'TARJETA VENCIDA';
	}else{
		echo 'NEGADA';
	}
	}
	}
	}
	}


/*
	if($PAGO == null or $PAGO == "") $bool_PAGO = false ;
	else $bool_PAGO = true;

	$result = 1.00;
	$check = '0';

	echo 'Se excluyen: <br>';
	if($bool_bd) $result = $result * floatval($bd['disponibilidad']);
	else{ echo 'Base de Datos<br>'; $check = '1'; }

	if($bool_app) $result = $result * floatval($app['probabilidad']);
	else{ echo 'Aplicacion<br>'; $check = '1'; }
	
	if($bool_enl) $result = $result * floatval($enl['disp']);
	else{ echo 'Enlace<br>'; $check = '1'; }

	if($bool_hard) $result = $result * floatval($hard['disp']);
	else{ echo 'Hardware<br>'; $check = '1'; }

	if($bool_rout) $result = $result * floatval($rout['disp']);
	else{ echo 'Router<br>'; $check = '1'; }
	echo '-';
	echo $check;
	echo '-';
	echo $result;
	
	*/
?>