/**
 * CEMONController
 *
 * @description :: Server-side logic for managing CEMON
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {
    _config: {
        actions: true,
        shortcuts: false,
        rest: false
    },

    soapStatus: function(req, res){
        SOAPService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    uddiStatus: function(req, res){
        UDDIService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    wsdlStatus: function(req, res){
        WSDLService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    xmlStatus: function(req, res){
        XMLService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    available: function(req, res){

    }

};
