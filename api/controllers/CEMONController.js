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

    bdStatus: function(req, res){
        BDService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    appStatus: function(req, res){
        APPService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    hardwareStatus: function(req, res){
        HARDWAREService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    enlaceStatus: function(req, res){
        ENLACEService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

    routerStatus: function(req, res){
        ROUTERService.getStatus(function(str){
            res.setHeader( "Content-type", "text/xml" );
            res.send(str);
        });
    },

};
