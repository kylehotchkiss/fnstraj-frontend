<?php 
/**
 *
 * fnstraj frontend
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */ 

 include "includes/header.php"; 
?>
		<script src="/assets/scripts/database.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="/assets/scripts/fnstraj-statistics.js"></script>
		
		<div class="light">
			<div class="wrapper">
				<h1>Predictor Statistics and Analysis</h1>		
				<p>
					The data below is calculated from <span class="amount" style="font-weight:normal !important;color:inherit !important;">?</span> predictions. <br />Data is weighted towards the NOAA RAP model because of its versatility.
				</p>
			</div>
		</div>
		
		<div class="dark">
			<div class="wrapper">
				<div id="averagePredictorTime" style="height:360px;margin-bottom:60px"></div>
			</div>
		</div>
		
		<div class="light">
			<div class="wrapper">
				<div id="averageCachePerformance" style="height:360px"></div>
			</div>
		</div>

<?php include "includes/footer.php"; ?>