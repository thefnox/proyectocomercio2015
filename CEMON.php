<?php
include_once 'lib/nusoap.php';
/*
		EL TIPO DE PARAMETRO QUE RECIBE LA FUNCION ES EL SIGUIENTE
		UN ARREGLO CON
			$name = "BDService";
			$fecha = "10/5/2015";

			QUEDARIA COMO: 
							$req = array('name' => $name, 'fecha' => $fecha);

		LUEGO ESTA RETORNA EL NOMBRE Y LA DISPONIBILIDAD
*/

	function BDStatus($req){
		$cemon = new nusoap_client('http://localhost:8080/tarea/BDService.php#', false);
		$res = $cemon->call('Disponibilidad', $req);
		$cemon = null;
		return $res;
	}

	function APPStatus($req){
		$cemon = new nusoap_client('http://localhost:8080/tarea/APPService.php#', false);
		$res = $cemon->call('Disponibilidad', $req);
		$cemon = null;
		return $res;
	}

	function ENLACESStatus($req){
		$cemon = new nusoap_client('http://localhost:8080/tarea/ENLACESService.php#', false);
		$res =  $cemon->call('Disponibilidad', $req);
		$cemon = null;
		return $res;
	}

	function HARDWAREStatus($req){
		$cemon = new nusoap_client('http://localhost:8080/tarea/HARDWAREService.php#', false);
		$res =  $cemon->call('Disponibilidad', $req);
		$cemon = null;
		return $res;
	}

	function ROUTERStatus($req){
		$cemon = new nusoap_client('http://localhost:8080/tarea/ROUTERService.php#', false);
		$res =  $cemon->call('Disponibilidad', $req);
		$cemon = null;
		return $res;
	}

?>