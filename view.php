<?php 
/**
 *
 * fnstraj frontend | View Flight Page
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */ 
  
	if ( isset($_GET["id"]) ) {
		////////////////////
		// Initalize View //
		////////////////////
		include "database.php";
		$couchdb = new Database();	
		$flightID =  $_GET["id"];


		/////////////////////////////
		// GRAB DATA FROM DATABASE //
		/////////////////////////////
		$flightData = $couchdb->read("/fnstraj-flights/" . $flightID );

		
		///////////////////////
		// START PAGE OUTPUT //
		///////////////////////
		$pageTitle = "View Flight";
		include "includes/header.php"; 	
		
		
		/////////////////////
		// DATA PROCESSING //
		/////////////////////
		if ( $flightData !== false ) {
			if ( !isset( $flightData->error ) ) {
				$frames = "";
				
				/////////////////////////////////////////
				// GENERATE JS FRIENDLY LIST OF POINTS //
				/////////////////////////////////////////
				foreach ( $flightData->prediction as $frame ) {
					$frames .= "[" . $frame->longitude . ", " . $frame->latitude . "], ";
				}
				
				$frames = substr( $frames, 0, strlen($frames) - 2 ); 
		
?>
				<script src="/assets/scripts/leaflet.js"></script>		
				<?php if ( $flightData->parameters->meta->program != "" && $flightData->parameters->meta->name != "" ) { ?>
				
					<h3>Flight Prediction for <?php echo $flightData->parameters->meta->program . " " . $flightData->parameters->meta->name; ?> </h3>
				
				<?php } else { ?>
				
					<h3>Flight Prediciton</h3>
				
				<?php } ?>
				
				<div class="viewFlight">
					<script>
				  		jQuery(document).ready(function() {
				  			var points = [{
				  				"type": "LineString",
				  				"coordinates": [
				  					<?php echo $frames; ?>
				  				]
				  			}];
				  			
				  			var linestyle = {
				  			    "color": "#FFFFFF",
				  			    "weight": 7,
				  			    "opacity": 1
				  			};
				  		
							var map = new L.Map("map", { dragging: false, touchZoom: false, scrollWheelZoom: false, doubleClickZoom: false, boxZoom: false, zoomControl: false, attributionControl: false, trackResize: false });
							
					  		map.setView(new L.LatLng(<?php echo $flightData->analysis->midpoint->latitude ?>, <?php echo $flightData->analysis->midpoint->longitude ?>), 8);
						  	
						  	L.tileLayer('http://api.tiles.mapbox.com/v3/hotchkissmade.map-atljnf88/{z}/{x}/{y}.png').addTo(map);
						  
						  	L.geoJson(points, { style: linestyle }).addTo(map); 
				  		});
					</script>
				
					<div id="map"></div>
					
					<div class="analysis">
					
						<div class="overview columns clearfix">
						
							<div class="distance column">

								<div class="label">
									Distance Travelled
								</div>
							
								<div class="value">
									<?php echo intval($flightData->analysis->distance); ?>km
								</div>
						
							</div>
							
							<div class="heading column">
							
								<div class="label">
									Final Heading
								</div>
								
								<div class="value">
									<?php echo intval($flightData->analysis->heading); ?>&deg;
								</div>
							
							</div>
						
						
							<div class="column">
							
								<div class="label">
									Landing Location
								</div>
								
								<div class="value">
									<?php echo $flightData->parameters->points->landing->name ?>
								</div>
							
							</div>
						</div>
					
						<div class="exports">
							<a href="/export/kml/<?= $flightID; ?>">View in Google Earth</a>
							<a href="/export/json/<?= $flightID; ?>">Download JSON export</a>
						</div>
					
					</div>
				</div>

<?php			
			
			} else {
				/////////////////////////////////
				// CASE: FLIGHT DOES NOT EXIST //
				/////////////////////////////////
?>
				<script src="/assets/scripts/database.js"></script>
				<script src="/assets/scripts/fnstraj-queue.js"></script>
	
				Flight does not {yet} exist - If you just created it, this page will update when it is complete!
				
				<input type="hidden" name="flightID" id="flightID" value="<?php echo $flightID; ?>" />
<?php
			}
		} else {
			//////////////////////////////////////
			// CASE: CANNOT CONNECT TO DATABASE //
			//////////////////////////////////////
?>

	Cannot connect to database at <? echo $couchdb_host; ?> or Flight Doesn't Exist

<?php			
			
		}
		
		include "includes/footer.php"; 
	} else {
		///////////////////////////////
		// CASE: NO FLIGHT ID IN URL //
		///////////////////////////////
        
        header( 'Location: /' );
    } 
?>