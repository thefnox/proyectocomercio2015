<?php
	include_once 'lib/nusoap.php';
	include_once 'database.php';

	$N_TDC = $_GET['N_TDC'];
	$COD_SEG = $_GET['COD_SEG'];
	$FECHA_EXP = $_GET['FECHA_EXP'];
	$MONTO = $_GET['MONTO'];
	$CI = $_GET['CI'];
	
	function actualizar_saldo($conexion,$N_TDC,$new_saldo){
		return mysql_query("UPDATE TARJETA SET SALDO = '".$new_saldo."' WHERE N_TDC = '".$N_TDC."'",$conexion);
	}
	
	function crear_transaccion($conexion,$N_TDC, $COD_OPERACION, $MONTO, $CI){
			$FECHA_TRANS = date_create()->format('Y-m-d');
			$query = "INSERT INTO TRANSACCION (N_TDC,CI,FECHA_TRANS,MONTO,COD_OPERACION) VALUES ('$N_TDC','$CI','$FECHA_TRANS','$MONTO','$COD_OPERACION')";
			return mysql_query($query,$conexion);
	}
	
	function acreditar($conexion,$COD_TIENDA,$MONTO){
		$consulta = mysql_query("SELECT MONTO FROM COMERCIO WHERE COD_TIENDA='".$COD_TIENDA."'",$conexion);
		$registro = mysql_fetch_array($consulta);
		$new_saldo = $registro[0] + $MONTO;
		mysql_query("UPDATE COMERCIO SET MONTO = '".$new_saldo."' WHERE COD_TIENDA = '".$COD_TIENDA."'",$conexion);
	}
	
	function debitar($conexion, $N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA){
		
		
		$FECHA = explode("/", $FECHA_EXP);
		
		$FECHA_EXP = $FECHA[1]."-".$FECHA[0]."-01";
		
        $consulta = mysql_query("SELECT * FROM TARJETA WHERE N_TDC='".$N_TDC."' AND FECHA_EXP='".$FECHA_EXP."' AND COD_SEG='".$COD_SEG."' AND CI='".$CI."'", $conexion);
		$registro = mysql_fetch_array($consulta);
		
		if($registro){
			$fecha_actual = date_create()->format('Y-m-d');
			
			$timestamp1 = strtotime($fecha_actual);
			$timestamp2 = strtotime($registro['FECHA_EXP']);
			
			if($timestamp1 <= $timestamp2){
				$consulta = mysql_query("SELECT SALDO FROM TARJETA WHERE N_TDC='".$N_TDC."' AND COD_SEG='".$COD_SEG."' AND CI='".$CI."'",$conexion);
				$registro = mysql_fetch_array($consulta);
				$consumo = $registro[0] - $MONTO;
				if($consumo >= 0){
					if(actualizar_saldo($conexion,$N_TDC,$consumo)){
						$COD_OPERACION = "00";
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
		
		return $COD_OPERACION;
	}
	
	function llamar_banco($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA){
        	
			$Banco = $N_TDC[1].$N_TDC[2].$N_TDC[3];
			$cod = "100";
			
			
			switch ($Banco) {
			    case "000":
					$link = "http://ecommerce.emgdesign.com.ve/banco/cliente2.php";
			        $req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    case "111":
					$link = "WWW.google.com";
			        $req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    case "222":
			    	$COD_TIENDA = "1";
					$link = "http://proyectocomercio.byethost4.com/proyecto_comercio/banco.php";
			        $req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    case "333":
			    	$COD_TIENDA = "232";
			    	$cod = "22";
				break;
			    case "444":
			    	$COD_TIENDA = "1010";
					$link = "https://make-payment.herokuapp.com/payment.php";
			        $req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    case "555":
					$link = "www.google.com";
			        $req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    case "666":
					$link = "http:// comerciorew.j.facilcloud.com/WSComercioElectronico/WScomercioElectronico?wsdl";
			        $req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    case "777":
					$link = "www.google.com";
			       	$req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    case "888":
			    	$COD_TIENDA = "232";
					$link = "http://www.yljcomercio.esy.es/tarea2/banco_jefferson.php?wsdl";
			        $req = array('monto' => $MONTO, 'cod_comercio' => $COD_TIENDA, 'tipo_tarjeta' => $N_TDC[0], 'num_tarjeta' => $N_TDC, 'fecha_venc' => $FECHA_EXP, 'cod_seguridad' => $COD_SEG, 'ci_titular' => $CI);
				break;
			    default:
			    	$cod = "99";
				break;
			}
			
			if($cod != "22" && $cod != "99"){ // si encontro un banco entra
				$callb = new nusoap_client($link, false);
				$codigo = $callb->call('pagar_al_banco', $req);
				$callb = null;
				
				return $codigo;
			}else{
				return $cod;
			}
	}

	
	
	function hacerPago($MONTO, $COD_TIENDA, $N_TDC_T, $N_TDC, $FECHA_EXP, $COD_SEG, $CI)
	{
			
		$COD_OPERACION = llamar_banco($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA);
		
		$conexion = conectarse();
		
		if($COD_OPERACION == "22"){
			$COD_OPERACION = debitar($conexion, $N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI, $COD_TIENDA);
		
			if($COD_OPERACION == "00" and $COD_TIENDA == "232") acreditar($conexion,$COD_TIENDA,$MONTO);
		}
 		
		crear_transaccion($conexion,$N_TDC, $COD_OPERACION, $MONTO, $CI);
		
		return $COD_OPERACION;
	}
////mysql-ctl cli
?>