<?php 
/**
 *
 * fnstraj frontend
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */ 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta name="description" content="fnstraj is a balloon trajectory and analysis service." />
		<meta name="keywords" content="trajectory, balloon, flight, near space, service" />
		<title>
			<?php if ( isset( $pageTitle ) ) { echo $pageTitle . " | "; } ?>fnstraj.org
		</title>
		<link href="/assets/styles/fnstraj.css" rel="stylesheet" />
		<link href="/assets/images/favicon.png" rel="shortcut icon" />
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="//use.typekit.net/ses4lbp.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-39937936-3']);
			_gaq.push(['_setSiteSpeedSampleRate', 100]);			
			_gaq.push(['_trackPageview']);
	
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
	  	</script>
	</head>
	<body>
		<div class="header">
			<div class="wrapper clearfix">
				<div class="logo">
					<a href="/">fnstraj.org</a>
				</div>
				
				<ul class="links">
					<li>
						<a href="/about.php">about</a>
					</li><li>
						<a href="/donate.php">donate</a>
					</li><li>
						<a href="http://flynearspace.org/">fly near space project</a>
					</li>
				</ul>
			</div>
		</div>
<?php ob_flush(); flush(); ?>