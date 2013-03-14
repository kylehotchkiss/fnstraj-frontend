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