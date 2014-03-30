<?php
// Actually show errors to the console
	error_reporting(E_ALL);
//	ini_set('display_errors', '1');

/* General includes. Basically limit the actions this file can perform
to further protect your database from injections and hacks
Standard web stuff though aparently. It works, i'm leaving it
#GoForIt https://developer.mozilla.org/en-US/docs/HTTP/Access_control_CORS#Preflighted_requests */
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");	// This gets put in the response for file handling
	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop"); // Credentials to connnect to the DB

// This is the actual SQL query, read it left to right. Only return 1 row. Save as "sql"
	$sql = "SELECT name,address FROM AppStores";

// Run the query "SQL" against the database. Save as result, some error handling
	$result = $mysqli->query($sql) or die( $mysqli->error );
    
// If there was a response, perform more actions, else return "error"
    if($result)
    {
    	$jsonData = array();
		while ($array = mysqli_fetch_row($result)) {
    		$jsonData[] = $array;
		}
		echo json_encode($jsonData);
    } 

/* This takes the response array, converts it to a JSON type and returns it to the caller
	May need some work within the app, can't tell just yet. I know that HTML gets it no
	problem, automatically */
$mysqli->close();	// Close the connection
?>
