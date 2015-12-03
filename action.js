/*
	$name = "BDService";
	$fecha = "10/5/2015";

	$req = array('name' => $name, 'fecha' => $fecha);

	array('name' => 'xsd:string', 'disp' => 'xsd:float')
*/

function consultar(){
	var mes = document.getElementById("mes").value;
	var ano = document.getElementById("ano").value;

	document.getElementById("resultado").textContent = "Cargando... Espere un momento por favor";

	var xhttp = new XMLHttpRequest();
	xhttp.open("GET","http://www.alstelecom.com/Prueba_Johan/CEMON.php?mes="+mes+"&ano="+ano, true);
  	xhttp.send();

	xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    	var datos = xhttp.responseText.split("-");
	    	if(datos[1] == "1")	document.getElementById("resultado").innerHTML = datos[0] + "<br>"+ datos[2];
	    	else document.getElementById("resultado").innerHTML = datos[2];
	    }
  	};
}