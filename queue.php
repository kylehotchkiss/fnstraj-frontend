<?php 
/**
 *
 * fnstraj frontend | Database Proxy
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */ 
 
 	
	if ( $_POST["interfaceKey"] == "z6kDgFNJX977di" ) {
		//////////////////////////////
		// PRE-WRITE INITIALIZATION //
		//////////////////////////////
		include "database.php";
		$couchdb = new Database();
		
		
		$now = new DateTime();
		$flightID = $now->getTimestamp();
	
	
		/////////////////////////////////
		// FLIGHT OBJECT ESTABLISHMENT //
		/////////////////////////////////
		if ( $_POST["spot"] != "" ) {
			$spot = $_POST["spot"];
		} else {
			$spot = false;
		}
		
		$content = array(
			"parameters" => array(
				"flags" => array(
					"spot" => $spot,
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
		
		
		//////////////////////////////////
		// WRITE QUEUE ITEM TO DATABASE //
		//////////////////////////////////
		$response = $couchdb->write('/fnstraj-queue/' . $flightID, $content);


		///////////////////////
		// START PAGE OUTPUT //
		///////////////////////
		$pageTitle = "Added to Queue";
		include "includes/header.php";


		if ( $response ) {
			//////////////////////////////////////////////////
			// CASE: SUCCESSFUL HTTP, EVALUATE THE RESPONSE // 
			//////////////////////////////////////////////////
			
			$status = $response;
			
			if ( $status->ok && $status->id == $flightID ) {
				/////////////////////////////////////
				// CASE: SUCCESSFUL DATABASE WRITE //
				/////////////////////////////////////
?>
		<script src="/assets/scripts/database.js"></script>
		<script src="/assets/scripts/fnstraj-queue.js"></script>
		
		<div class="light">
			<div class="wrapper">
				<h2>
					Added to Prediction Queue
				</h2>
				<p>
					Your flight has been added to the queue. It is currently item number <span id="queueOrder">???</span>.<br />When your prediction is complete, this page will redirect automatically<br /><?php if ( $_POST["email"] != "" ) { ?> and you will receive an email at <strong><?php echo $_POST["email"] ?></strong><br /><?php } ?> Or you can bookmark <a href="http://fnstraj.org/view/<?php echo $flightID; ?>">http://fnstraj.org/view/<?php echo $flightID; ?></a> and come back later!
				</p>
			</div>
		</div>
	
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
			
		} else {
?>	
		
			unspec error, working on it
			
<?php			
		}
		
		include "includes/footer.php";
	} else {
		///////////////////////////
		// CASE: DATA NOT POSTED //
		///////////////////////////
		header( 'Location: /' );
	}
?>