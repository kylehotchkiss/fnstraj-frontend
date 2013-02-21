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
		
	// Browsers will nag from old data sometimes, breaking our location support.
	jQuery("input[type=checkbox]").attr("checked", false);
		
	
	if ( navigator.geolocation ) {
		navigator.geolocation.getCurrentPosition(
			function( position ) {
				////////////////////////////
				// CASE: HAVE COORDINATES //
				////////////////////////////
				var latitude  = position.coords.latitude;
				var longitude = position.coords.longitude;
					
					
				jQuery(".geolocation label").html(latitude.toFixed(2) + ", " + longitude.toFixed(2));
					
				//
				// Now let's grab the location name. <3UX.
				// Progressive enhancement (as coordiantes are still shown if this fails.
				//
				
				// location name, if possible, goes here. Google api, probs :(
				
				jQuery(".geolocation input[type=checkbox]").removeAttr("disabled");
				
				jQuery(".geolocation input[type=checkbox]").change(function() {
						
					if ( jQuery(".geolocation input[type=checkbox]").is(':checked') ) {
						jQuery("input[name=latitude]").attr("value", latitude);
						jQuery("input[name=longitude]").attr("value", longitude);
						jQuery("#exactLocation").addClass("shade");
					} else {
						jQuery("input[name=latitude], input[name=longitude]").attr("value", "");							
						jQuery("#exactLocation").removeClass("shade");							
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