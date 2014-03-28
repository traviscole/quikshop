<?php
// 	Allow for errors
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

// 	Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

// 	Various Includes
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");

// 	Parse the log in form if the user has filled it out and pressed "Log In"
	if (isset($_POST["username"]) && isset($_POST["password"])) {

//	Assign the passed entry to variables
    		$username = mysqli_real_escape_string($mysqli,$_POST['username']);
    		$password = mysqli_real_escape_string($mysqli,$_POST['password']);
    	
//	Assign the username to the response array, for saving to local storage
//	back in default.html
			$response_array['email'] = $username;

//	Build the SQL call
    		$sql = "SELECT userId, email, passHash FROM Users WHERE email='$username' LIMIT 1";
//	Call the database, save the result in the variable RESULT
    		$result = $mysqli->query($sql) or die( $mysqli->error );
//	Extract the row data of the result. Save as ROQ
    		$row = mysqli_fetch_assoc($result);
//	Extract the hashed password out of the database
    		$hashDB = $row['passHash'];

//	Place the userId into the response    		
    		$userIdResponse = $row['userId'];
    		$response_array['userId'] = $userIdResponse;
    		
//	Search for the cartId    		
    		$sql2 = "SELECT cartId FROM Users WHERE ownerId='$userIdResponse' LIMIT 1";
//	Call the database, save the result in the variable RESULT2
    		$result2 = $mysqli->query($sql) or die( $mysqli->error );
//	Extract the row data of the result. Save as ROW2
    		$row2 = mysqli_fetch_assoc($result2);
//	Extract the cartId from the row, save to response    		
    		$cartIdResponse = $row2['cartId'];    			
    		$$response_array['cartId'] = $cartIdResponse;




//	See if the password matches
		if (password_verify($password, $hashDB)) {
//		If so, write success to the response aray
    			$response_array['status'] = 'success'; 
    		} 
    
    		else {
//		If not, write error to response
          		$response_array['status'] = 'error'; 
    		}
    
// 	Encode the response in JSON, it is automatically passed back to the caller. Also echo this to the console
//	Was told that this header is generally not important but smart to have
		header('Content-Type: application/json');
		echo json_encode($response_array);

	}
// 	Close the connection
	$mysqli->close();
?>
