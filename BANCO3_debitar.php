<?php
	include_once 'lib/nusoap.php';
	include_once 'database.php';

	$servicio = new soap_server();

	$ns = "urn:BANCO3_debitar";
	$servicio->configureWSDL("BANCO3_debitar", $ns);
	$servicio->schemaTargetNamespace = $ns;

	$servicio->register("PAGO", array('N_TDC' => 'xsd:string', 'COD_SEG' => 'xsd:number', 'FECHA_EXP' => 'xsd:string', 'MONTO' => 'xsd:float', 'CI' => 'xsd:string'),array('COD_OPERACION' => 'xsd:string', 'N_TRANS' => 'xsd:string'), $ns);
	
	function actualizar_saldo($conexion,$N_TDC,$new_saldo){
		return mysql_query("UPDATE TARJETA SET SALDO = '".$new_saldo."' WHERE N_TDC = '".$N_TDC."'",$conexion);
	}
	
	function crear_transaccion($conexion,$N_TDC, $COD_OPERACION, $MONTO, $CI){
			$FECHA_TRANS = date_create()->format('Y-m-d');
			$query = "INSERT INTO TRANSACCION (N_TDC,CI,FECHA_TRANS,MONTO,COD_OPERACION) VALUES ('$N_TDC','$CI','$FECHA_TRANS','$MONTO','$COD_OPERACION')";
			return mysql_query($query,$conexion);
	}
	
	function acreditar($conexion,$N_TDC,$MONTO){
		$TipoTarjeta = $N_TDC[0];
		$Banco = $N_TDC[1].$N_TDC[2].$N_TDC[3];
		$Numero = '';
		for($i=4;$i<=20;$i++) $Numero = $Numero.$N_TDC[$i];
		
		if($Banco == "333"){
			//abonar en la cuenta de la tienda el monto 
			$TDC_COMERCIO = '5333000000123456';
			$consulta = mysql_query("SELECT SALDO FROM TARJETA WHERE N_TDC='".$TDC_COMERCIO."'",$conexion);
			$registro = mysql_fetch_array($consulta);
			$consumo = $registro[0] + $MONTO;
			actualizar_saldo($conexion,$TDC_COMERCIO,$consumo);
			return true;
		}
		
		return false;
	}

	function PAGO($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI){
        $COD_OPERACION = "99";
        
        /*$conexion = conectarse();
        
        $consulta = mysql_query("SELECT * FROM TARJETA WHERE N_TDC='".$N_TDC."' AND FECHA_EXP='".$FECHA_EXP."' AND COD_SEG='".$COD_SEG."' AND CI='".$CI."'", $conexion);
		
		if($registro = mysql_fetch_array($consulta)){
			$fecha_actual = date_create()->format('Y-m-d');
			
			$timestamp1 = strtotime($fecha_actual);
			$timestamp2 = strtotime($registro['FECHA_EXP']);
			
			if($timestamp1 <= $timestamp2){
				$consulta = mysql_query("SELECT SALDO FROM TARJETA WHERE N_TDC='".$N_TDC."' AND COD_SEG='".$COD_SEG."' AND CI='".$CI."'",$conexion);
				$registro = mysql_fetch_array($consulta);
				$consumo = $registro[0] - $MONTO;
				if($consumo >= 0){ 
					if(acreditar($conexion,$N_TDC,$MONTO)){ 
						if(actualizar_saldo($conexion,$N_TDC,$consumo)){
							$COD_OPERACION = "00";
						}else{
							$COD_OPERACION = "100";
						}
					}else{
						$COD_OPERACION = "100";
					}
				}else{
					$COD_OPERACION = "01";
				}
			}else{
				$COD_OPERACION = "11";
			}
		}else{
			$COD_OPERACION = "10";
		}
		crear_transaccion($conexion,$N_TDC, $COD_OPERACION, $MONTO, $CI);
		$consulta = mysql_query("SELECT MAX(N_TRANS) FROM TRANSACCION",$conexion);
		$registro = mysql_fetch_array($consulta);
		$N_TRANS = $registro[0];
		
		if($N_TRANS == NULL || $N_TRANS == '') $N_TRANS = "100";*/
		
		return array('COD_OPERACION' => $COD_OPERACION, 'N_TRANS' => '10');
	}

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';
	$servicio->service($HTTP_RAW_POST_DATA);
?>