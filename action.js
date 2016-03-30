/*
	$name = "BDService";
	$fecha = "10/5/2015";

	$req = array('name' => $name, 'fecha' => $fecha);

	array('name' => 'xsd:string', 'disp' => 'xsd:float')
*/

function consultar(){
	var N_TDC = document.getElementById("N_TDC").value;
	var COD_SEG = document.getElementById("COD_SEG").value;
	var FECHA_EXP = document.getElementById("FECHA_EXP").value;
	var MONTO = document.getElementById("MONTO").value;
	var CI = document.getElementById("CI").value;
	var URL = "https://proyectocomercio2015-fnox.c9users.io/CEMON.php";
	
	
	alert(FECHA_EXP);
	document.getElementById("resultado").textContent = "Cargando... Espere un momento por favor";

	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", URL +"?N_TDC="+N_TDC+"&COD_SEG="+COD_SEG+"&FECHA_EXP="+FECHA_EXP+"&MONTO="+MONTO+"&CI="+CI, true);
  	xhttp.send();

	xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    	document.getElementById("resultado").innerHTML = xhttp.responseText;
	    }
  	};
}