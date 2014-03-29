<?php
// Actually show errors to the console
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
// General includes. Basically limit the actions this file can perform
// to further protect your database from injections and hacks
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
// This gets put in the response for file handling
	header("Content-type: application/json");
// Credentials to connnect to the DB	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

// Accept JSON file input, decode it to a variable. Save this as data
	$data = json_decode(file_get_contents('php://input'));
// var_dump is for debugging, prints all PHP variables to the console
	var_dump($data);

// Remove info passed in to PHP and save as local PHP variables username and password
    $username 		= $data->username;
	$password 		= $data->password;

// This is the actual SQL query, read it left to right. Only return 1 row. Save as "sql"
	$sql = "SELECT userId, email, passHash FROM Users WHERE email='$username' LIMIT 1";

// Run the query "SQL" against the database. Save as result, some error handling
    $result = $mysqli->query($sql) or die( $mysqli->error );
// If there was a response, perform more actions, else return "error"
    if($result){
		// Gather the data (row in DB) that was found when the DB was queried
    	$row = mysqli_fetch_assoc($result);
    	// Get the value listed in the passHash field, save to a local PHP variable: hashedPW
    	$hashedPW = $row['passHash'];
    	// Get the value listed in the userId field, save to local PHP variable: userIdResponse
    	$userIdResponse = $row['userId'];
    	// Get the value listed in the cartId field, save to local PHP variable: cartId 
    	$cartIdResponse = $row['cartId'];  
		
		// Response Array is what is returned. It is built dynamically and does not need to 
		// Be initialized to an inital size. These simply add a slot and assign a value 
    	$response_array['userId'] = $userIdResponse;
    	$response_array['email'] = $username;	
    	$response_array['cartId'] = $cartIdResponse;
	} else { $response_array['status'] = 'error'; }
	
	// PHP function to see if "password" (from the calling program) matches the value
	// we have in the database. We use a PHP function because we store the hashed value
	// the same sting can have basically unlimited hashes so the function handles matching
	// we never see the plaintext value (unless we drop variables to console which we 
	// shouldn't once these are working 
	if (password_verify($password, $hashedPW)) {
		// The program uses the value of "status" to know to move to logged in state or not
    	$response_array['status'] = 'success'; 
    } else { $response_array['status'] = 'error'; }
    
    // This takes the response array, converts it to a JSON type and returns it to the caller
    // May need some work within the app, can't tell just yet. I know that HTML gets it no
    // problem, automatically
	echo json_encode($response_array);
	// Close the connection
	$mysqli->close();
?>
