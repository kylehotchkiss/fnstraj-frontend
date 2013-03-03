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
			
			<h3>Predictor Statistics and Analysis</h3>		
			
			<p>
				The data below is calculated from <span class="amount" style="font-weight:normal !important;color:inherit !important;">?</span> predictions. Data is weighted towards the NOAA RAP model because of its versatility. This data is maintained for planning purposes, it probably won't affect your predictions :).
			</p>

			<div id="averagePredictorTime" style="height:360px;margin-bottom:60px"></div>
			<div id="averageCachePerformance" style="height:360px"></div>

<?php include "includes/footer.php"; ?>