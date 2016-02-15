<?php
	$servername = getenv('IP');
/*	
	$bd = mysql_connect($servername,'proyecto','000000');

	function conectarse(){
		if (!$bd){
		    $bd = mysql_connect($servername,'proyecto','000000');
			return $bd;
		} 
		if (!mysql_select_db('proyecto',$bd)){ 
			exit(); 
		}
		return $bd;
	}
	*/
	function conectarse(){
		if (!($link=mysql_connect($servername,"proyecto","000000"))){ 
			echo "Error conectando a la base de datos."; 
			exit(); 
		} 
		if (!mysql_select_db("proyecto",$link)){ 
			echo "Error seleccionando la base de datos."; 
			exit(); 
		}
		return $link;
	}

	function cerrarConexion($link){
		@mysql_close($link);
	}
?>