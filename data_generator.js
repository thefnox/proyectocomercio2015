var iterations = 10

function randomDigit(){
  return Math.floor(Math.random() * 10);
}

function makeName()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    for( var i=0; i < 6; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function randomDate(start, end) {
    return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
}

var clients = [];
var querystr = "DELETE FROM TARJETA;\nDELETE FROM CLIENTE;\n";
var i = 0;

for (i=0; i<iterations; i++){
  var ci = Math.floor(Math.random() * 30000000);
  var birthdate = randomDate(new Date(1960, 0, 1), new Date(2000,12,31))
  birthdate = (birthdate.getFullYear()) + "-" + (birthdate.getMonth() + 1) + "-" + (birthdate.getDate());
  querystr = querystr + "INSERT INTO CLIENTE (CI, NOMBRE,  APELLIDO, FECHA_NAC) VALUES (" + ci + ",'" + makeName() + "', '" + makeName() + "', '" + birthdate + "');\n";
  clients.push(ci);
}

querystr += "\n";

for (i=0; i<iterations; i++){
  var cardtype = 0;
  if (Math.random() < 0.5) cardtype = "4";
  else cardtype = "5";
  var seccode = "" + randomDigit() + "" + randomDigit() + "" + randomDigit();
  var cardnumber = "";
  for (var j=0; j<12; j++){
    cardnumber = cardnumber + randomDigit();
  }
  var banknumber = "" + randomDigit() + "" + randomDigit() + "" + randomDigit();
  cardnumber = cardtype + banknumber + cardnumber;
  var expiration = new Date(2017,12, 12, 12, 0, 0, 0);
  expiration = expiration.getFullYear() + "-" + (expiration.getMonth() + 1) + "-" + (expiration.getDate());
  var emission = new Date();
  emission = emission.getFullYear() + "-" + (emission.getMonth() + 1) + "-" + (emission.getDate());
  var ci = Math.floor(Math.random() * 30000000);
  var amount = Math.floor(Math.random() * 50000);
  var credit = Math.floor(Math.random() * 1000000);
  var limit = Math.floor(Math.random() * 1000000) + 5000;
  //console.log("https://proyectocomercio2015-fnox.c9users.io/CEMON.php?N_TDC="+cardnumber+"&COD_SEG="+seccode+"&FECHA_EXP="+expiration+"&MONTO="+amount+"&CI="+ci);
  querystr = querystr + "INSERT INTO TARJETA (N_TDC, COD_SEG, LIMITE_CRED, FECHA_EXP, FECHA_EMI, CRED_DISP, SALDO, CI) VALUES (" + cardnumber + "," + seccode + "," + limit + ",'" + expiration + "','" + emission + "'," + credit + "," + amount + "," + clients[i] + ");\n";
}

console.log(querystr);
