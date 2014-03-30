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
	
//	$data = json_decode(file_get_contents('php://input'));
	$data = json_decode(file_get_contents('http://www.quikshop.co/App/getCartTest.json'));

	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop"); // Credentials to connnect to the DB
	
	if($data) {
		$cartID = $data->cartId;

		$sql = "SELECT AppCarts.itemID,AppItems.name, AppItems.price, AppItems.description
			FROM AppCarts, AppItems
			WHERE AppItems.itemID = AppCarts.itemID AND AppCarts.cartID  = $cartId";

// Run the query "SQL" against the database. Save as result, some error handling
		$result = $mysqli->query($sql) or die( $mysqli->error );
    
// If there was a response, perform more actions, else return "error"
    	if($result)
    	{
			$rows = array();
	
			//retrieve and print every record
			while($r = mysqli_fetch_assoc($result)){
    			$rows[] = $r;
			}
			echo json_encode($rows);
    	} 
    }
    else {
   	 	$response_array['status'] = 'error'; 
		$response_array['reason'] = 'ERROR: No Data Was Passed'; 
		echo json_encode($response_array);
    }

/* This takes the response array, converts it to a JSON type and returns it to the caller
	May need some work within the app, can't tell just yet. I know that HTML gets it no
	problem, automatically */
$mysqli->close();	// Close the connection
?>
