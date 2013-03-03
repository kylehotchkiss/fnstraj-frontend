/**
 *
 * fnstraj frontend | Database Wrapper
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 * Aiming for API compatibility with fnstraj
 * located at > fnstraj/library/database.js <
 *
 */

var db_host = "hotchkissmade.cloudant.com";
var db_port = 80;
var db_root = "http://" + db_host + ":" + db_port;


///////////////////////////
// DATABASE READ REQUEST //
///////////////////////////
var database = {}; // Uncertain if we need namespacing

database.read = function( path, archive, callback ) {
    if ( path.substr(-1) === "/" ) {
        path += "_all_docs?ascending=true";
        
        if ( archive ) {
	        path += "&include_docs=true";
        }
    }
    
    jQuery.ajax( db_root + path, {
    	dataType: "jsonp", 
    	crossDomain: true,
    	timeout: 2000,
    	success: function( data ) {
    		callback( data );
    	}, error: function() {
    		callback( false, true );
    	}
    });
};