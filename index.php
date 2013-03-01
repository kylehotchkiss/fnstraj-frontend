<?php 
/**
 *
 * fnstraj frontend | Create Flight Page
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */ 

	$pageTitle = "Create Flight";
 	include "includes/header.php"; 
?>
			<script src="/assets/scripts/garlic.js"></script>
			<script src="/assets/scripts/parsley.js"></script>
		 	<script src="/assets/scripts/fnstraj-create.js"></script>
			<p> 
				Welcome to <span>fnstraj</span>, a new balloon trajectory prediction service. This service helps you find out where the stuff you're sending up with your weather balloon will land. That way you'll know if you're going to "accidentally" lose your expensive gear in the ocean or a military base (which is probably bad!) This is currently alpha-level software and should be used with discretion. If it is storming where you are currently launching <strong>fnstraj cannot help you</strong> (due to chaos in wind data).
			</p>
			<p>
				<em>Currently, GFS does not offer accurate enough results for predictions. Please try GFSHD or RAP instead.</em>
			</p>
		
			<form class="setup" method="post" action="/queue.php" data-persist="garlic" data-destroy="false" data-validate="parsley" novalidate><div class="createFlight">
				
				<input type="hidden" name="interfaceKey" value="z6kDgFNJX977di" />
				
				<div class="fieldset" id="stepOne">
					<h3>Step 1: Intension / Weather Model</h3>
						
					<div class="intension clearfix">
						<div class="radio">
							<input type="radio" name="model" id="gfs" value="gfs" checked />
						</div>
						<div class="description">
							<label for="gfs">I want to know where a balloon will go! <span class="model">NOAA GFS</span></label>
						</div>
					</div>
					
					<div class="intension clearfix">
						<div class="radio">
							<input type="radio" name="model" id="gfshd" value="gfshd" />
						</div>
						<div class="description">
							<label for="gfshd">I want to see which day I should launch! <span class="model">NOAA GFS HD</span></label>
						</div>
					</div>
					
					<div class="intension clearfix">
						<div class="radio">
							<input type="radio" name="model" id="rap" value="rap" />
						</div>
						<div class="description">
							<label for="rap">I am launching a balloon right now! <span class="model">NOAA RAP</span></label>
						</div>
					</div>
					
				</div>
				
				
				<div class="fieldset" id="stepTwo">					
					<h3>Step 2: Launch Location</h3>	
					
					<div class="clearfix">
						<!-- 
							These should be shielded by a white overlay with cursor:pointer; or something like that
						-->
						<div class="left">
							<p class="instructions">
								Use your general location?
							</p>
							
							<div class="geolocation clearfix">
								<label for="useGeo"><em>Waiting...</em></label>
								<input type="checkbox" name="useGeo" id="useGeo" disabled />
							</div>	
						</div>
					
						<div class="right" id="exactLocation">
							<p class="instructions">
								Use an exact location?
							</p><p>
								<label for="latitude">Latitude<i>*</i> <span>(decimal-degrees)</span></label>
								<input type="number" name="latitude" step="0.000000000000001" required />
							</p><p>
								<label for="longitude">Longitude<i>*</i> <span>(decimal-degrees)</span></label>
								<input type="number" name="longitude" step="0.000000000000001" required />
							</p><p>
								<label for="altitude">Altitude<i>*</i> <span>(meters)</span></label>
								<input type="number" name="altitude" step="1" min="0" max="44307" required />
							</p>
							
							<label for="useGeo" class="shade"></label>
						</div>
					</div>
				</div>


				<div class="fieldset" id="stepThree">
					<h3>Step 3: Flight Details</h3>		
					
					<p class="terms">
						The following variables need to be gathered from your balloon manufacturer (probably via their website) and a scale at your launch site. Make sure to get the most accurate numbers you can for everything so that the ascent profile is accurate. A cheap luggage scale is a good place to start! Also, choose a parachute that won't descend so quick you lose all the goodies in your payload :)
					</p>				
						
					<div class="clearfix">
						<div class="left half">
							<p class="instructions">
								Your Balloon
							</p>
							
							<p>
								<label for="lift">Free Lift<i>*</i> <span>(grams-force)</span></label>
								<input type="number" name="lift" min="0" step="0.00001" data-trigger="keyup" required />
							</p>
							
							<p>
								<label for="burst">Burst Altitude<i>*</i> <span>(metres)</span></label>
								<input type="number" name="burst" min="0" max="44307" step="0.00001" data-trigger="keyup" required />
							</p>
							
							<p>
								<label for="launchRadius">Launch Radius<i>*</i> <span>(metres)</span></label>
								<input type="number" name="launchRadius" min="0" step="0.00001" data-trigger="keyup" required />
							</p>
							
							<p>
								<label for="burstRadius">Burst Radius<i>*</i> <span>(metres)</span></label>
								<input type="number" name="burstRadius" min="0" step="0.00001" data-trigger="keyup" required />
							</p>
						</div>
						<div class="right half">
							<p class="instructions">
								Your Payload
							</p>
							
							<p>
								<label for="weight">Payload Weight<i>*</i> <span>(grams)</span></label>
								<input type="number" name="weight" min="0" step="0.00001" data-trigger="keyup" required />
							</p>
							<p>
								<label for="radius">Parachute Radius<i>*</i> <span>(metres)</span></label>
								<input type="number" name="chuteRadius" min="0" step="0.00001" data-trigger="keyup" required />
							</p>
																					
						</div>
					</div>
					<div>
						<p class="instructions">
							Advanced Settings
						</p>
						
						<p class="terms">
							SPOT integration is a neat technology in development that allows fnstraj to work with SPOT to recalculate a trajectory from the last location your balloon was. This will lower the circle of accuracy as your flight descends and making getting to the search location a little bit easier. The most reports that fnstraj will generate for a SPOT tracking instance is 20, which should be good for a little over 3 hours of flight time. Because this is resource intensive and blocks off other people from reciving their reports if abused, it's asked that you <strong>only</strong> use this for 1) actual flights with 2) active chase cars. Since this is an alpha quality feature, make sure your SPOT is still adequately prepared to be your only source of payload location.
						</p>
						
						<p>
							<label for="spot">SPOT Shared Page ID</label>
							<input type="text" name="spot" style="width:648px" placeholder="this feature is in development :)" />
						</p>
							
						</p>
					</div>
				</div>
				
				
				<div class="fieldset" id="stepFour">
					<h3>Step 4: About You</h3>				
						
					<p class="instructions">
						About You (and your flight)
					</p><p>
						<input type="email" name="email" placeholder="Email Address" />
					</p><p>
						<input type="text" name="program" placeholder="Flight Program" />
					</p><p>
						<input type="text" name="name" placeholder="Flight Name" />
					</p>
				</div>
				
				
				
				<div class="fieldset" id="stepFive">
					<h3>Step 5: Let's Fly!</h3>
					<p class="terms">
						By using this software, you agree that Kyle Hotchkiss and associated parties are not responsible for any damage caused by your flight, <a href="http://www.chem.hawaii.edu/uham/part101.html">any laws broken</a> due to your irresponsibility to play by the rules, or any losses caused by inaccurate predictions. You need to be aware that this is <strong>alpha quality</strong> software and no formal testing has been done to verify the accuracy of this predictor (although directionality and distance are replicating well within bounds of similar predictors). <em>Personal request: if you don't understand the simple math behind ballooning, you probably don't have enough passion to fly something safely and retrieve it - so research before you fly</em>.
						<br /><br />
						<em>tl;dr the legal terms</em>: <strong>Don't be stupid and you alone are responsible for any consequences resulting from your flight choices</strong>.
					</p>
					<input type="submit" value="Let's Fly Some Balloons!" />
					
				</div>
		
		
			</div></form>
<?php include "includes/footer.php"; ?>