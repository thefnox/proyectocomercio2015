<?php
	header('Access-Control-Allow-Origin: *');
	
	include_once 'lib/nusoap.php';

	$fecha = $_GET['mes'].'/'.$_GET['ano'];

	$bd = BDStatus('Enlace Internet',$fecha);
	$app = APPStatus('aplicacion',$fecha);
	$enl = ENLACEStatus('ENLACEService',$fecha);
	$hard = HARDWAREStatus('HARDWAREService',$fecha);
	$rout = ROUTERStatus('ROUTERService',$fecha);

	function BDStatus($name,$fecha){
		$cemon = new nusoap_client('http://www.comeryljs.esy.es/enlaceInternet.php#', false);
		$req = array('name' => $name, 'fecha' => $fecha);
		$res = $cemon->call('CalcularDisponibilidad', $req);
		$cemon = null;

		//echo $res['nombreComponente'].': '.$res['disponibilidad'];
		//echo '<br>';
		return $res;
	}

	function APPStatus($name,$fecha){
		$cemon = new nusoap_client('http://ecomerce.pe.hu/servicio_apliscacion.php#', false);
		$req = array('name' => $name, 'fecha' => $fecha);
		$res = $cemon->call('disponibilidad_aplicacion', array('datos' => $req));
		$cemon = null;

		//echo $res['componente'].': '.$res['probabilidad'];
		//echo '<br>';
		return $res;
	}

	function ENLACEStatus($name,$fecha){
		$cemon = new nusoap_client('http://alstelecom.com/Prueba_Johan/ENLACEService.php#', false);
		$req = array('name' => $name, 'fecha' => $fecha);
		$res =  $cemon->call('Disponibilidad', $req);
		$cemon = null;

		//echo $res['name'].': '.$res['disp'];
		//echo '<br>';
		return $res;
	}

	function HARDWAREStatus($name,$fecha){
		$cemon = new nusoap_client('http://alstelecom.com/Prueba_Johan/HARDWAREService.php#', false);
		$req = array('name' => $name, 'fecha' => $fecha);
		$res =  $cemon->call('Disponibilidad', $req);
		$cemon = null;

		//echo $res['name'].': '.$res['disp'];
		//echo '<br>';
		return $res;
	}

	function ROUTERStatus($name,$fecha){
		$cemon = new nusoap_client('http://alstelecom.com/Prueba_Johan/ROUTERService.php#', false);
		$req = array('name' => $name, 'fecha' => $fecha);
		$res =  $cemon->call('Disponibilidad', $req);
		$cemon = null;

		//echo $res['name'].': '.$res['disp'];
		//echo '<br>';
		return $res;
	}

	if($bd == null or $bd == "") $bool_bd = false ;
	else $bool_bd = true;

	if($app == null or $app == "") $bool_app = false ;
	else $bool_app = true;
	
	if($enl == null or $enl == "") $bool_enl = false ;
	else $bool_enl = true;

	if($hard == null or $hard == "") $bool_hard = false ;
	else $bool_hard = true;

	if($rout == null or $rout == "") $bool_rout = false ;
	else $bool_rout = true;

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
?>