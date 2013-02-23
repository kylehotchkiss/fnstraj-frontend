<?php 
/**
 *
 * fnstraj frontend | Exports
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */ 
 
 	if ( isset($_GET["format"]) ) {
 	
	 	if ( isset($_GET["id"]) ) {
	 		//////////////////////////////////////////////
	 		// PASS PRECHECKS, SETUP DATBASE CONNECTION //
	 		//////////////////////////////////////////////
	 		include "database.php";
	 		$couchdb = new Database();	
	 		$flightID = $_GET["id"];
	 		
	 		
	 		/////////////////////
	 		// GET FLIGHT DATA //
	 		/////////////////////
	 		$flightData = $couchdb->read("/fnstraj-flights/" . $flightID );
	 		
	 		
	 		if ( $flightData !== false ) {
	 		
				if ( !isset( $flightData->error ) ) {
				
					if ( $_GET["format"] == "kml" && isset($_GET["live"]) ) {
						////////////////////////////////////////////////
						// GOOGLE EARTH LIVE EXPORT FOR SPOT TRACKING //
						////////////////////////////////////////////////
						header("Content-Type: application/vnd.google-earth.kml+xml");
						header("Content-disposition: attachment;filename=fnstraj-" . $flightID . ".live.kml");
				
						
					} else if ( $_GET["format"] == "kml" ) {
						////////////////////////////////
						// GOOGLE EARTH STATIC EXPORT //
						////////////////////////////////
						
						header("Content-Type: application/vnd.google-earth.kml+xml");
						header("Content-disposition: attachment;filename=fnstraj-" . $flightID . ".kml");
						
						echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
						
?>
<kml xmlns="http://earth.google.com/kml/2.1">
	<Document>
		<name>fnstraj Balloon Trajectory</name>
		<Style id="track">
	  		<LineStyle>
				<color>FFBDC5A7</color>
				<width>3</width>
	  		</LineStyle>
	  		<PolyStyle>
				<color>64BDC5A7</color>
	  		</PolyStyle>
		</Style>
		<Placemark>
			<name>Balloon Trajectory</name>
			<styleUrl>#track</styleUrl>
			<LineString>
				<tessellate>0</tessellate>
				<extrude>1</extrude>
				<altitudeMode>absolute</altitudeMode>
				<coordinates>
<?php						

						foreach ( $flightData->prediction[0] as $frame ) {
							echo "				    " . $frame->longitude . "," . $frame->latitude . "," . $frame->altitude . "\n";
						}

?>
				</coordinates>
        	</LineString>
    	</Placemark>
	</Document>
</kml>
<?php							
						
					} else if ( $_GET["format"] == "json" ) {
						/////////////////////////////////////
						// JSON EXPORT FOR FUTURE PROJECTS //
						/////////////////////////////////////
						header("Content-Type: application/json");	
						header("Content-disposition: attachment;filename=fnstraj-" . $flightID . ".json");											
						
						echo json_encode( $flightData->parameters );
					} else if ( $_GET["format"] == "csv" ) {
						/////////////////////////////////////////
						// CSV EXPORT FOR EXCEL-BASED ANALYSIS //
						/////////////////////////////////////////
						
						// DANGER!!! POINTS NEED TO BE PLACED IN PROPER PREDICTION LOCATION PER TIMING
		 		
						header("Content-Type: text/csv");
						header("Content-disposition: attachment;filename=fnstraj-" . $flightID . ".csv");						
		 		
					} else {
						/////////////////////////////
						// CASE: INVALID format/DIE //
						/////////////////////////////
						header( 'Location: /' );
					}
				} else {
					//////////////////////////////////////////
					// CASE: FLIGHT DATA RETURNED ERROR/DIE //
					//////////////////////////////////////////
					include "includes/error-corrupt.php";
				}
			} else {
				///////////////////////////////////////////
				// CASE: DATABASE CONNECTIVITY ERROR/DIE //
				///////////////////////////////////////////
				include "includes/error-database.php";
			}
	 	} else {
		 	///////////////////////////////////
		 	// CASE: NO FLIGHT ID IN URL/DIE //
		 	///////////////////////////////////
		 	header( 'Location: /' );    		 	
	 	} 	
	} else {
		/////////////////////////////////////
		// CASE: NO OUTPUT format IN URL/DIE //
		/////////////////////////////////////
    	header( 'Location: /' );    
	}
?>