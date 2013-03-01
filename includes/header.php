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
		<title>
		 	<?php if ( isset($pageTitle) ) { echo $pageTitle . " | "; } ?>fnstraj
		</title>
		<meta name="description" content="fnstraj is a balloon trajectory and analysis service." />
		<meta name="keywords" content="trajectory, balloon, flight, near space, service" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="/assets/styles/fnstraj.css" rel="stylesheet" />	
		<link href="/assets/styles/symbolset.css" rel="stylesheet" />
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="/assets/scripts/ss-standard.js"></script>
		<script type="text/javascript" src="//use.typekit.net/zpr0vqp.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	</head>
	<body>
		<div class="wrapper clearfix">
			<div class="header">
				<a href="/"><img src="/assets/images/logo2.png" /></a>
			</div>
			<div class="body">