<?php 
/**
 *
 * fnstraj frontend | database proxy
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 * Rename to queue.php for consistancy.
 *
 */ 
 

 
 	
	if ( $_POST["interfaceKey"] == "z6kDgFNJX977di" ) {
		//////////////////////////////
		// PRE-WRITE INITIALIZATION //
		//////////////////////////////
		include "library/database.php";
		$couchdb = new Database();
		
		$now = new DateTime();
	
		$flightID = $now->getTimestamp();
	
		$content = array(
			"parameters" => array(
				"flags" => array(
					"spot" => false,
					"active" => false,
					"lastActivity" => false
				), "meta" => array(
					"name" => $_POST["name"],
					"email" => $_POST["email"],
					"program" => $_POST["program"]
				), "options" => array(
					"model" => $_POST["model"]
				), "launch" => array(
					"altitude" => $_POST["altitude"],
					"latitude" => $_POST["latitude"],
					"longitude" => $_POST["longitude"]
				), "balloon" => array(
					"lift" => $_POST["lift"],
					"burst" => $_POST["burst"],
					"burstRadius" => $_POST["burstRadius"],
					"launchRadius" => $_POST["launchRadius"]
				), "payload" => array(
					"weight" => $_POST["weight"],
					"chuteRadius" => $_POST["chuteRadius"]
				)
			)	
		);
		
		$response = $couchdb->write('/queue/' . $flightID, $content);

		///////////////////////
		// START PAGE OUTPUT //
		///////////////////////
		include "includes/header.php";

		if ( $response ) {
			//////////////////////////////////////////////////
			// CASE: SUCCESSFUL HTTP, EVALUATE THE RESPONSE // 
			//////////////////////////////////////////////////
			
			$status = json_decode( $response );
			
			if ( $status->ok && $status->id == $flightID ) {
				/////////////////////////////////////
				// CASE: SUCCESSFUL DATABASE WRITE //
				/////////////////////////////////////
?>
			<script src="/assets/scripts/fnstraj-queue.js"></script>
			<h3>
				Added to Queue 
			</h3>
			<div class="columns clearfix">
				
				<div class="column">
					<div class="label">
						Weather Model
					</div>
					<div class="value caps">
						<?php echo $content["parameters"]["options"]["model"]; ?>
					</div>
				</div>
				
				<div class="column">
					<div class="label">
						# in Queue
					</div>
					<div class="value" id="queueOrder">
						??
					</div>
				</div>
				
				<div class="column">
					<div class="label">
						Estimated Time
					</div>
					<div class="value" id="estimatedTime">
						??
					</div>
				</div>
				
			</div>
			<p>
				When your prediction is complete, this page will redirect automatically<?php if ( $_POST["email"] != "" ) { ?> and you will receive an email at <strong><?php echo $_POST["email"] ?></strong><?php } ?>. Or you can bookmark <a href="http://fnstraj.org/view/<?php echo $flightID; ?>">http://fnstraj.org/view/<?php echo $flightID; ?></a> and come back later!
			</p>
			
			<input type="hidden" name="flightID" id="flightID" value="<?php echo $flightID; ?>" />

<?php						
			} else {
				/////////////////////////////////
				// CASE: FAILED DATABASE WRITE //
				/////////////////////////////////
?>

			<h3>
				Unsuccessfully Posted.
			</h3>
			
			<p>
				Sorry, but for some reason, your request did not complete. Here's the code:
			</p>
			
			<code>
				<?php echo $response; ?>
			</code>

<?php					
			} 	
			
			include "includes/footer.php";
				
		} 	
	} else {
		///////////////////////////
		// CASE: DATA NOT POSTED //
		///////////////////////////
		header( 'Location: /' );
	}
?>