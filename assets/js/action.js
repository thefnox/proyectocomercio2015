function consultarComp(){
	var componente = document.getElementById("componente").value;

	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    	if (xhttp.readyState == 4 && xhttp.status == 200) {
    		document.getElementById("resul").innerHTML = xhttp.responseText;
    	}
  	};
  	xhttp.open("GET", "http://localhost:1337/cemon/"+componente, true);
  	xhttp.send();
}

var res = 1;
var i = 0;

function consultarGlob(){
  res = 1;
	i = 0;
	ajax("bdStatus");
	ajax("appStatus");
	ajax("hardwareStatus");
	ajax("enlaceStatus");
	ajax("routerStatus");
}

function ajax(componente){
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    	if (xhttp.readyState == 4 && xhttp.status == 200) {
    		i = i + 1;
    		var res2 = parseFloat((((xhttp.responseText).split("<status>"))[1]).split("</status>")[0]);
    		res = res * res2;

    		if(i == 5){
    			document.getElementById("resul").innerHTML = res;
    		}
    	}
  	};
  	xhttp.open("GET", "http://localhost:1337/cemon/"+componente, true);
  	xhttp.send();
}