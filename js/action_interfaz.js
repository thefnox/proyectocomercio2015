function feed(){    
    var i;

    for(i=0;i<5;i++){
        var cont = document.getElementById("cont-pastie");
        var pastie = document.getElementById("pastie1").cloneNode(true);
    
        cont.appendChild(pastie);
    }
}

function agregar(producto){
    document.getElementById("carrito_"+producto).style.display = "block";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block"))
        document.getElementById("monto_total").textContent = "8.000";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "none"))
        document.getElementById("monto_total").textContent = "6.000";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none"))
        document.getElementById("monto_total").textContent = "7.000";
    if((document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_zapatos").style.display == "none"))
        document.getElementById("monto_total").textContent = "3.000";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none") && (document.getElementById("carrito_audifonos").style.display == "none"))
        document.getElementById("monto_total").textContent = "5.000";
    if((document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none") && (document.getElementById("carrito_zapatos").style.display == "none"))
        document.getElementById("monto_total").textContent = "2.000";
    if((document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "none") && (document.getElementById("carrito_zapatos").style.display == "none"))
        document.getElementById("monto_total").textContent = "1.000";
}

function quitar(producto){
    document.getElementById("carrito_"+producto).style.display = "none";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block"))
        document.getElementById("monto_total").textContent = "8.000";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "none"))
        document.getElementById("monto_total").textContent = "6.000";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none"))
        document.getElementById("monto_total").textContent = "7.000";
    if((document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_zapatos").style.display == "none"))
        document.getElementById("monto_total").textContent = "3.000";
    if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none") && (document.getElementById("carrito_audifonos").style.display == "none"))
        document.getElementById("monto_total").textContent = "5.000";
    if((document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none") && (document.getElementById("carrito_zapatos").style.display == "none"))
        document.getElementById("monto_total").textContent = "2.000";
    if((document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "none") && (document.getElementById("carrito_zapatos").style.display == "none"))
        document.getElementById("monto_total").textContent = "1.000";
    if((document.getElementById("carrito_camiseta").style.display == "none") && (document.getElementById("carrito_audifonos").style.display == "none") && (document.getElementById("carrito_zapatos").style.display == "none"))        
        document.getElementById("monto_total").textContent = "0";    
}

function pasarMonto(indice,producto){
    if(indice == 1){
        if(producto == "zapatos") alert("5.000");
        if(producto == "audifonos") alert("2.000");
        if(producto == "camiseta") alert("1.000");
    }else{
        if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block"))
            alert("8.000");
        if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "none"))
            alert("6.000");
        if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none"))
            alert("7.000");
        if((document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_zapatos").style.display == "none"))
            alert("3.000");
        if((document.getElementById("carrito_zapatos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none") && (document.getElementById("carrito_audifonos").style.display == "none"))
            alert("5.000");
        if((document.getElementById("carrito_audifonos").style.display == "block") && (document.getElementById("carrito_camiseta").style.display == "none") && (document.getElementById("carrito_zapatos").style.display == "none"))
            alert("2.000");
        if((document.getElementById("carrito_camiseta").style.display == "block") && (document.getElementById("carrito_audifonos").style.display == "none") && (document.getElementById("carrito_zapatos").style.display == "none"))
            alert("1.000");
    }
}