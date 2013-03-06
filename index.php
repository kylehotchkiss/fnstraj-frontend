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
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIsWqs-P67ZWAhl1oawYoi1LmSCQjYXt8&sensor=false"></script>
		<script src="/assets/scripts/fnstraj-create.js"></script>

		<form class="setup" method="post" action="/queue.php" data-persist="garlic" data-destroy="false" data-validate="parsley" novalidate>
		
		<input type="hidden" name="interfaceKey" value="z6kDgFNJX977di" />
		
		<div class="light" id="introduction">
			<div class="wrapper">
				<h1>
					Welcome to <em>fnstraj.org</em>
				</h1>
				<p>
					This is a <em>new</em> trajectory predictor for ballooning projects. <br /> Ever wondered how people send their cameras into the sky <br /> and find them when they're done? That's where we come in.
				</p><p>
					Fill out the following few sections using information <br /> about your launch site, your balloon, and your payload.
				</p><p>
					Let's get started with some easy details - the details <br /> about you and your flight. Don't worry, we don't spam!
				</p>
				<div class="columns clearfix">
					<div class="column">
						<label for="program">
							Flight Program Name
						</label>
						<input type="text" name="program" />
					</div>
					<div class="column">
						<label for="name">
							Flight Name
						</label>
						<input type="text" name="name" />
					</div>
					<div class="column">
						<label for="email">
							Your Email Address
						</label>
						<input type="email" name="email" />
					</div>
				</div>
			</div>
		</div>
			
		<div class="dark" id="stepOne">
			<div class="wrapper">
				<h2>
					Weather Model Selection
				</h2>
				<p>
				 	There are several different weather models to base your prediction off of. <br /> Choose one based on what you're using your prediction for. <br />When in doubt, just choose the RAP model - it works great!
				</p>
				
				<div class="intensions">
					<div class="clearfix">
						<input type="radio" name="model" id="gfs" value="gfs" checked />
						<label for="gfs">I want to know where a balloon will go! <span class="model">NOAA GFS</span></label>
					</div>
						
					<div class="clearfix">
						<input type="radio" name="model" id="gfshd" value="gfshd" />
						<label for="gfshd">I want to see which day I should launch! <span class="model">NOAA GFS HD</span></label>
					</div>
						
					<div class="clearfix">
						<input type="radio" name="model" id="rap" value="rap" />
						<label for="rap">I am launching a balloon right now! <span class="model">NOAA RAP</span></label>
					</div>
				</div>
			</div>
		</div>
		
		<div class="light" id="stepTwo">
			<div class="wrapper">
				<h2>
					Launch Location
				</h2>
				<p>
					Tell us about where you are launching from. <br /> (You can cheat and use your computer's location, if possible!)
				</p>
				<div class="columns clearfix">
					<div class="column">
						<label for="latitude">
							Latitude* (decimal-degrees)
						</label>
						<input type="number" name="latitude" min="24.52083" max="49.38447" step=".00001" data-trigger="keyup" required />
					</div>
					<div class="column">
						<label for="longitude">
							Longitude* (decimal-degrees)
						</label>
						<input type="number" name="longitude" min="-124.73305" max="-66.94977" step=".00001" data-trigger="keyup" required />
					</div>
					<div class="column">
						<label for="altitude">
							Altitude* (Metres)
						</label>
						<input type="number" name="altitude" min="0" max="44307" step="1" data-trigger="keyup" required />
					</div>
				</div>
			</div>
		</div>
		
		<div class="dark" id="stepThree">
			<div class="wrapper">
				<h2>
					Balloon, Payload, and Parachute Details
				</h2>
				<p>
					The following will be the hardest section to complete. <br /> You will need to get these details from your balloon manufacturer, <br /> your payload, and from launch-day variables. (Or you can guesstimate)
				</p>
				<div class="columns clearfix">
					<div class="column">
						<label for="lift">
							Free Lift* (grams)
						</label>
						<input type="number" name="lift" min="0" data-trigger="keyup" required />
					</div>
					<div class="column">
						<label for="burst">
							Burst Altitude* (metres)
						</label>
						<input type="number" name="burst" min="0" max="44307" data-trigger="keyup" required />
					</div>
					<div class="column">
						<label for="launchRadius">
							Balloon Radius at Launch* (metres)
						</label>
						<input type="number" name="launchRadius" min="0" data-trigger="keyup" required />
					</div>
				</div>
				
				<div class="columns clearfix">
					<div class="column">
						<label for="latitude">
							Balloon Radius at Burst* (metres)
						</label>
						<input type="number" name="burstRadius" min="0" data-trigger="keyup" required />
					</div>
					<div class="column">
						<label for="longitude">
							Payload Weight* (grams)
						</label>
						<input type="number" name="weight" min="0" data-trigger="keyup" required />
					</div>
					<div class="column">
						<label for="altitude">
							Parachute Radius* (metres)
						</label>
						<input type="number" name="chuteRadius" min="0" data-trigger="keyup" required />
					</div>
				</div>
				
				<p style="margin:60px 0;">
					Live Tracking via SPOT Satellite Messenger <br /> Enter your SPOT Shared Page ID to live track your flight
				</p>
				
				<label for="spot">
					SPOT Shared Page ID
				</label>
				<input type="text" name="spot" style="width:440px;" />

			</div>
		</div>
		
		<div class="light" id="stepFour">
			<div class="wrapper">
				<h2>
					Disclaimers... then predict Flight Path!
				</h2>
				<p>
					<em>Usage of fnstraj.org implies that you know this software <br /> is experimental and does not guarantee accurate results.</em>
				</p><p>
					Please be sure to read the laws regarding weather balloons before flying. <br /> Be careful and godspeed to your hard work and dedication!
				</p>
				<input type="submit" value="Predict Flight Path" />
			</div>
		</div>
		
		</form>

<?php include "includes/footer.php"; ?>