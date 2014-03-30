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
	$sql = "SELECT * FROM AppStores";

// Run the query "SQL" against the database. Save as result, some error handling
	$result = $mysqli->query($sql) or die( $mysqli->error );
    
// If there was a response, perform more actions, else return "error"
    if($result)
    {
    	while($row = mysql_fetch_assoc($result))
		{
   			$response_array['status'] = 'success'; 
   			$storeIdResponse = $row['storeID'];
   				$response_array['storeId'] = $storeIdResponse; 
   			$storeNameResponse = $row['name'];
   				$response_array['name'] = $storeNameResponse; 
		}
    } 
    else 
    { 
    	$response_array['status'] = 'error'; 
    	$response_array['reason'] = 'ERROR: Query Was Unsuccessful'; 
    }

/* This takes the response array, converts it to a JSON type and returns it to the caller
	May need some work within the app, can't tell just yet. I know that HTML gets it no
	problem, automatically */
echo json_encode($response_array);
$mysqli->close();	// Close the connection
?>
