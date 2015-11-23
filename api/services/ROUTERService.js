/**
 * WSDLService
 *
 * @description :: Finds the status of the WSDL component
*/
module.exports = {
    getStatus: function(callback) {
        //Actualmente el codigo genera un XML con el formato deseado el cual parsea inmediatamente.
        //En un futuro esto se va a hacer con una peticion asincrona a otro servidor.
        var name = "ROUTER";
        callback('<?xml version="1.0" encoding="UTF-8"?>\n\
		<!--Estado del componente seleccionado-->\n\
		<component>\n\
        <name>' + name + '</name>\n\
        <status>' + Math.random() + '</status>\n\
		</component>');
    }
};
