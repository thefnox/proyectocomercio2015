<?php
	include_once 'lib/nusoap.php';
	include_once 'database.php';


	$servicio = new soap_server();

	//ns es name space
	$ns = "urn:BANCO3_acreditar";
	$servicio->configureWSDL("BANCO3_acreditar", $ns);
	$servicio->schemaTargetNamespace = $ns;
	$TDC_COMERCIO = '1333000000123456';

	$servicio->register("acreditar", array('N_TDC' => 'xsd:string', 'COD_SEG' => 'xsd:number', 'FECHA_EXP' => 'xsd:string', 'MONTO' => 'xsd:float', 'CI' => 'xsd:string'),array('N_TRANSAC' => 'xsd:number','COD_OPERACION' => 'xsd:string'), $ns);
	function actualizar_saldo($conexion,$N_TDC,$new_saldo){
		return mysql_query("UPDATE TARJETA SET SALDO = '".$new_saldo."' WHERE N_TDC = '".$N_TDC."'",$conexion);
	}

	function acreditar($N_TDC, $COD_SEG, $FECHA_EXP, $MONTO, $CI){
		// aqui realizar todas las operaciones pertinentes para debitar dinero del cliente y acreditar en la cuenta del negocio
		$TipoTarjeta = $N_TDC[0];
		$Banco = $N_TDC[1].$N_TDC[2].$N_TDC[3];
		$Numero = '';
		for($i=4;$i<=20;$i++) $Numero = $Numero.$N_TDC[$i];
		
		if($numero == "333"){
			$call = new nusoap_client('https://proyectocomercio2015-fnox.c9users.io/BANCO3_debitar.php', false);
			$req = array('N_TDC' => $N_TDC, 'COD_SEG' => $COD_SEG, 'FECHA_EXP' => $FECHA_EXP, 'MONTO' => $MONTO, 'CI' => $CI);
			$res = $call->call('debitar', $req);
			$call = null;
			
			if($res['COD_OPERACION'] == "00"){ 
							//abonar en la cuenta de la tienda el monto 	
				$conexion = conectarse();
				$consulta = mysql_query("SELECT SALDO FROM TARJETA WHERE N_TDC='".$TDC_COMERCIO."'",$conexion);
				$registro = mysql_fetch_array($consulta);
				$consumo = $registro[0] + $MONTO;
				
				actualizar_saldo($conexion,$TDC_COMERCIO,$consumo);
			}
			
		}else{
			$COD_OPERACION = "10"; // datos invalidos
		}
		
//Aqui tengo estas funciones de la conexion y el cierre con la BD que coloque en una app web que hice para mi trabajo:
/*
		function conectarse(){
			if (!($link=mysql_connect("localhost","user","password"))){ 
				echo "Error conectando a la base de datos."; 
				exit(); 
			} 
			if (!mysql_select_db("nameBD",$link)){ 
				echo "Error seleccionando la base de datos."; 
				exit(); 
			}
			return $link;
		}

		function cerrarConexion($link){
			@mysql_close($link);
		}
*/
//Ademas agrego unas funciones de consultas de Select, Update y Insert para que tengan como ejemplo:
/*
		function consultarDatos($link){
			@$que = mysql_query("SELECT suscripciones,visitas FROM t_conteo WHERE id=1",$link);
			$registro = mysql_fetch_array($que);
			echo $registro[0].'-'.$registro[1];
		}
	
		function subirImagen($link,$tipo,$dia,$mes,$ano,$tema,$name){
			$query = "INSERT INTO t_directorioImagenes (id_c_tipoImagen,diaPublicacion,mesPublicacion,anoPublicacion,tema,nombreArchivo,likes,activo) VALUES ('$tipo','$dia','$mes','$ano','$tema','$name','0','1')";
			$res = mysql_query($query,$link) or die("Error en consulta <br>".mysql_error());
		}
		function sumarLike($link,$id,$likes){
			$res = mysql_query("UPDATE t_directorioImagenes SET likes=".$likes." WHERE id=".$id,$link) or die("Error en consulta <br>".mysql_error());
		}	
*/
		$N_TRANSAC = 1234;
		
		//return array($Banco,$Numero);
		return array($N_TRANSAC,$COD_OPERACION);
	} 	

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';
	$servicio->service($HTTP_RAW_POST_DATA);
?>