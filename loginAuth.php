<?php
// Actually show errors to the console
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

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

//	$data = json_decode(file_get_contents('php://input'));	// Accept JSON file input, decode it to a variable. Save this as data
	$data = json_decode(file_get_contents('http://www.quikshop.co/App/loginAuthTest.json'));

//	var_dump($data);	// var_dump is for debugging, prints all PHP variables to the console
	if($data) {

// Remove info passed in to PHP and save as local PHP variables username and password
    	$username 		= $data->username;
		$password 		= $data->password;

// This is the actual SQL query, read it left to right. Only return 1 row. Save as "sql"
		$sql = "SELECT * FROM AppUsers WHERE email='$username' LIMIT 1";

// Run the query "SQL" against the database. Save as result, some error handling
   	 	$result = $mysqli->query($sql) or die( $mysqli->error );
    
// If there was a response, perform more actions, else return "error"
    	if($result)
    	{
    		$row = mysqli_fetch_assoc($result);		// Gather the data (row in DB) that was found when the DB was queried
    		$hashedPW 		= $row['passHash'];		// Get the value listed in the passHash field, save to a local PHP variable: hashedPW
    		$userIdResponse = $row['userID'];		// Get the value listed in the userId field, save to local PHP variable: userIdResponse
    
    		/*Response Array is what is returned. It is built dynamically and does not need to 
    			be initialized to an inital size. These simply add a slot and assign a value */
    		$response_array['userId'] = $userIdResponse;
    		$response_array['email'] = $username;
    		$response_array['status'] 	= 'success';
    		
    		$check = $mysqli->query("SELECT * FROM AppLogins WHERE userId='$userIdResponse';");
			if (mysqli_num_rows($check) == 0) {
				$sql="INSERT INTO AppLogins(userID) VALUES('$userIdResponse')";
    			$result = $mysqli->query($sql) or die( $mysqli->error );
    			$cartIdResponse = $mysqli->insert_id;
    			$response_array['cartId'] = $cartIdResponse;
			}
    	} 
    	else 
    	{ 
    		$response_array['status'] = 'error'; 
    		$response_array['reason'] = 'ERROR: Query Was Unsuccessful'; 
    	}
    
   		/* PHP function to see if "password" (from the calling program) matches the value
   	 		we have in the database. We use a PHP function because we store the hashed value
    		the same sting can have basically unlimited hashes so the function handles matching
    		we never see the plaintext value (unless we drop variables to console which we 
    		shouldn't once these are working */
    
    	if (password_verify($password, $hashedPW)) 
    	{
    		$response_array['status'] = 'success'; 	// The program uses the value of "status" to know to move to logged in state or not
    	} 
    	else 
    	{ 
    		$response_array['status'] = 'error'; 
    		$response_array['reason'] = 'ERROR: Password was Incorrect'; 
    	}
    }
    else {
   	 	$response_array['status'] = 'error'; 
   	 	$response_array['reason'] = 'ERROR: No Data Was Passed'; 
    }
    /* This takes the response array, converts it to a JSON type and returns it to the caller
    	May need some work within the app, can't tell just yet. I know that HTML gets it no
		problem, automatically */
	echo json_encode($response_array);
	$mysqli->close();	// Close the connection
?>



    		}
    		else {
    			$cartIdResponse = $mysqli->query("SELECT cartID FROM AppLogins WHERE userId='$userIdResponse';");
    			$response_array['cartId'] = $cartIdResponse;
    		}