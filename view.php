<?php 
/**
 *
 * fnstraj frontend | View Flight Page
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */ 
  
	if ( isset($_GET["id"]) && $_GET["id"] !== "" ) {
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
				foreach ( $flightData->prediction[0] as $frame ) {
					$frames .= "[" . $frame->longitude . ", " . $frame->latitude . "], ";
				}
				
				$frames = substr( $frames, 0, strlen($frames) - 2 ); 
?>
			<script src="/assets/scripts/leaflet.js"></script>		
			
			<div class="light" id="flightSummary">
				<div class="wrapper">
				<?php if ( $flightData->parameters->meta->program != "" && $flightData->parameters->meta->name != "" ) { ?>
				
					<h2>Flight Prediction for <?php echo $flightData->parameters->meta->program . " " . $flightData->parameters->meta->name; ?> </h2>
				
				<?php } else { ?>
				
					<h2>Flight Prediction</h2>
				
				<?php } ?>
					<p>
						Your flight is estimated to fly <?php echo intval($flightData->analysis->distance); ?>km at <?php echo intval($flightData->analysis->heading); ?>&deg;. <br /> It's predicted to land in <?php echo $flightData->parameters->points->landing->name ?>.
					</p><p>
						You can download this flight for <a href="/export/kml/<?php echo $flightID; ?>">Google Earth</a>, <br /> in <a href="/export/json/<?php echo $flightID; ?>">JSON format</a>, or in <a href="/export/csv/<?php echo $flightID; ?>">CSV Format</a> for your records.
					</p>
				</div>
			</div>
			
			<div class="dark" id="flightView">
				<div class="wrapper">
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
				
			  		<h2>
			  			Predicted Flight Path
			  		</h2>
				
				  	<div id="map"></div>
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
			
			<input type="hidden" name="flightID" id="flightID" value="<?php echo $flightID; ?>" />			
			
			<div class="light">
				<div class="wrapper">
	
					<h2>Flight Not Found</h2>
				
					<p>
						The flight you have requested has not been found <br />
						(If it is currently being processed, you will be redirected)
					</p>
				</div>
			</div>
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