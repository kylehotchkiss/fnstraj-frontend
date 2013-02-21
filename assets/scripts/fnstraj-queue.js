/**
 *
 * fnstraj | Post-Create Scripts
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 * Ugh, yes, we have to move our standardized database code over here too.
 * fnstraj/library/database.js (needs conversion to xmlhttpreq/jquery.getJOSN)
 *
 */

var COUCHDB_HOST = "hotchkissmade.cloudant.com";
var COUCHDB_PORT = 80;

var COUCHDB_URL ="http://" + COUCHDB_HOST + ":" + COUCHDB_PORT


jQuery(document).ready(function() {

	var flightID = jQuery("#flightID").val();

	queueLength(flightID, updateLength);

	checkUpdates(flightID, updateLength, function( updated ) {
	
		if ( updated ) {
			window.location = "/view/" + flightID;
		}
	
	}); 	

});


function checkUpdates( flightID, queueUpdateCallback, callback ) {
	//////////////////////////////////////////
	// CHECK TO SEE IF FLIGHT OBJECT EXISTS //
	//////////////////////////////////////////
	setTimeout(function() {
	
		setTimeout(function() {
		 
		 	queueLength(flightID, queueUpdateCallback);
		 
		 	database.read( "/flights/" + flightID, function( data, error ) {
		 
		 		if ( typeof data.parameters !== "undefined" ) {
		 
					callback( data );
							
				} else {
				
					checkUpdates( flightID, queueUpdateCallback, callback );
				
				}
				
			});
		
		}, 15000);
	
	}, 0);
};


var queueLength = function( flightID, callback ) {
	////////////////////////////////////////////////
	// GET AMOUNT OF ITEMS IN QUEUE BEFORE FLIGHT //
	////////////////////////////////////////////////
 
	database.read('/queue/', function( data, error ) {
	
		if ( typeof error !== "undefined" && error ) { 
			///////////////////////////////////////////
			// CASE: DATABASE CONNECTIVITY ERROR/DIE //
			///////////////////////////////////////////
			
		} else {
		
			var index = -1;
		
			for ( var i = 0; i < data.rows.length; i++ ) {
				if ( data.rows[i].id == flightID ) {
					index = i;
					
					break;
				}				
			}
			
			console.log( index );
			
			if ( index == -1 ) {
				//////////////////////////////
				// CASE: NOT FOUND IN QUEUE //
				//////////////////////////////
		
				callback( false, true );
			} else {
				callback( index );
			}
		
		}

	
	});

}


var updateLength = function( id, error ) {
	/////////////////////////////////
	// INFORM USER OF QUEUE LENGTH //
	/////////////////////////////////
	if ( typeof error !== "undefined" && error ) { 
	
	} else {
		jQuery("#queueOrder").html(id);
		
		jQuery("#estimatedTime").html( "< " + id * 2 + " min" );
	}
}