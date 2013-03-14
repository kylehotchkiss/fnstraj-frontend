/**
 *
 * fnstraj | Front-end Javascript
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */
	
jQuery(document).ready(function() {
	navigator.geolocation.getCurrentPosition(
		function( position ) {
			////////////////////////////
			// CASE: HAVE COORDINATES //
			////////////////////////////
			var elevation = new google.maps.ElevationService();
			var latitude  = position.coords.latitude;
			var longitude = position.coords.longitude;
			var launchsite = new google.maps.LatLng(latitude, longitude);
						
			if ( latitude > 24.52083 && latitude < 49.38447 && longitude > -124.73305 && longitude < -66.94977 ) {
				elevation.getElevationForLocations({
					'locations': [ launchsite ]
				}, function( results, status ) {
					if (status == google.maps.ElevationStatus.OK) {
						if (results[0]) {									
							jQuery("input[name=altitude]").val(results[0].elevation.toFixed(0));
						} 
					} 
				});
						
				jQuery("input[name=latitude]").val(latitude.toFixed(5));
				jQuery("input[name=longitude]").val(longitude.toFixed(5));								
			} else {

				// Trigger no-USA warning

			}
		}, null, { 
			///////////////////////////////////////////////
			// GEOLOCATION CONFIG (Worst location evarr) //
			///////////////////////////////////////////////
			enableHighAccuracy: true, 
			timeout: 10000, 
			maximumAge: 600000 
		}
	);
});