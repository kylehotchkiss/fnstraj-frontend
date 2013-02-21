<?php 
/**
 *
 * fnstraj frontend | database wrapper
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 * Aiming for API compatibility with fnstraj
 * located at > fnstraj/library/database.js <
 *
 * Future: research execution safeness by character stripping.
 *
 */ 
 
 	include("config.php");
 
 	class database {
 	 
 		function read( $path ) {
     		global $db_host, $db_port, $db_user, $db_pass;
     		
 			if ( substr( $path, -1 ) === "/" ) {
 				//////////////////////////////////////////////
 				// CASE: URL IS LISTING, RETURN ALL RESULTS //
 				//////////////////////////////////////////////
 			
				$path .= "_all_docs?include_docs=true";
 			}
 			
			$database = curl_init();
			
			curl_setopt( $database, CURLOPT_URL, "http://" . $db_host . ":" . $db_port . $path );
			curl_setopt( $database, CURLOPT_USERPWD, $db_user . ":" . $db_pass );
			curl_setopt( $database, CURLOPT_RETURNTRANSFER, 1); // Don't echo response.
			
			$response = curl_exec( $database );
			
			if ( $response ) {
				///////////////////////////////////
				// CASE: CURL REQUEST SUCCESSFUL //
				///////////////////////////////////
				
				$results = json_decode( $response );
			
				return $results;
			} else {
				///////////////////////////////
				// CASE: CURL REQUEST FAILED //
				///////////////////////////////
			
				echo curl_error( $database );
				
				return false;
			}
 		}
 	
 	
 		
 		function write( $path, $content ) {
     		global $db_host, $db_port, $db_user, $db_pass;
     		
 			$database = curl_init();
 			
			curl_setopt( $database, CURLOPT_URL, "http://" . $db_host . ":" . $db_port . $path );
			curl_setopt( $database, CURLOPT_USERPWD, $db_user . ":" . $db_pass );
 			curl_setopt( $database, CURLOPT_CUSTOMREQUEST, "PUT" );
 			curl_setopt( $database, CURLOPT_POSTFIELDS, json_encode( $content ) );
 			curl_setopt( $database, CURLOPT_RETURNTRANSFER, 1); // Don't echo response.
 			
 			$response = curl_exec( $database );
 			
 			if ( $response ) {
 				///////////////////////////////////
 				// CASE: CURL REQUEST SUCCESSFUL //
 				///////////////////////////////////
 				
 				$results = json_decode( $response );
 			
 				return $results;
 			} else {
 				///////////////////////////////
 				// CASE: CURL REQUEST FAILED //
 				///////////////////////////////
 			
 				return false;
 			}
 		}
 	
 	}
 
 