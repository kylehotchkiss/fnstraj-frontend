/**
 *
 * fnstraj | Front-end Javascript
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */



jQuery("document").ready(function() {

	////////////////////////
	// CREATE FLIGHT PAGE //
	////////////////////////	
	if ( navigator.geolocation ) {
		navigator.geolocation.getCurrentPosition(
			function( position ) {
				////////////////////////////
				// CASE: HAVE COORDINATES //
				////////////////////////////
				var latitude  = position.coords.latitude;
				var longitude = position.coords.longitude;
					
					
				jQuery(".geolocation label").html(latitude.toFixed(5) + ", " + longitude.toFixed(5));
					
				//
				// Now let's grab the location name. <3UX.
				// Progressive enhancement (as coordiantes are still shown if this fails.
				//
				jQuery(".geolocation input[type=checkbox]").removeAttr("disabled");
				
				if ( jQuery(".geolocation input[type=checkbox]").is(':checked') ) {
					jQuery("input[name=latitude]").val(latitude.toFixed(5));
					jQuery("input[name=longitude]").val(longitude.toFixed(5));
				}
				
				jQuery(".geolocation input[type=checkbox]").change(function() {
					if ( jQuery(".geolocation input[type=checkbox]").is(':checked') ) {
						jQuery("input[name=latitude]").val(latitude.toFixed(5));
						jQuery("input[name=longitude]").val(longitude.toFixed(5));
					} else {
						jQuery("input[name=latitude], input[name=longitude]").val("");	
					}
				});
				
			}, function ( error ) {
				////////////////////////////////
				// CASE: POSITION UNAVAILABLE //
				////////////////////////////////
					
				jQuery(".geolocation").html("<em>Unavailable</em>");
			}, { 
				///////////////////////////////////////////////
				// GEOLOCATION CONFIG (Worst location evarr) //
				///////////////////////////////////////////////
				enableHighAccuracy: true, 
				timeout: 10000, 
				maximumAge: 600000 
			}
		);
			
	} else {
		//
		// CASE: NO GEOLOCATION //
		//
	}
});