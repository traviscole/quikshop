<?php
	//starting the session
	session_start();

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


// This is the actual SQL query, read it left to right. Only return 1 row. Save as "sql"
	$sql = "SELECT * FROM Users WHERE email='$username' LIMIT 1";
// Call the database, save the result in the variable RESULT
     $result = $mysqli->query($sql) or die( $mysqli->error );
	 $row = " ";
// If there was a response, perform more actions, else return "error"
     if($result)
     {
		$row = mysqli_fetch_assoc($result);	// Gather the data (row in DB) that was found when the DB was queried
		$hashedPW = $row['password'];	// Get the value listed in the passHash field, save to a local PHP variable: hashedPW
		$userIdResponse = $row['userID'];	// Get the value listed in the userId field, save to local PHP variable: userIdResponse
    
		/*Response Array is what is returned. It is built dynamically and does not need to
		be initialized to an inital size. These simply add a slot and assign a value */
		$response_array['userID'] = $userIdResponse;
		$response_array['email'] = $username;
    
		$check = $mysqli->query("SELECT * FROM Logins WHERE userID='$userIdResponse';");
		if (mysqli_num_rows($check) == 0) {
			$sql="INSERT INTO Logins(userID) VALUES('$userIdResponse')";
			$result = $mysqli->query($sql) or die( $mysqli->error );
			if($result)
			{
				$result3 = $mysqli->query("SELECT cartID FROM Logins WHERE userID='$userIdResponse';");
				$row3 = mysqli_fetch_assoc($result3);
				$response_array['cartID'] = $row3['cartID'];
				$_SESSION['cartID'] = $row3['cartID'];

			}
		}
		else {
		$result2 = $mysqli->query("SELECT cartID FROM Logins WHERE userID='$userIdResponse';");
		$row2 = mysqli_fetch_assoc($result2);
		$response_array['cartID'] = $row2['cartID'];
		$_SESSION['cartID'] = $row2['cartID'];

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
		$_SESSION['userID'] = $userIdResponse;
			
			if($row['adminStore'] != NULL || $row['empStore'] != NULL ){
					
				$response_array['customer'] = false;
			}else{
			
				$response_array['customer'] = true;
			}
	
		$response_array['status'] = 'success'; // The program uses the value of "status" to know to move to logged in state or not
     }
     else
     {
     $response_array['status'] = 'error';
     $response_array['reason'] = 'ERROR: Password was Incorrect';
     }
    
// 	Encode the response in JSON, it is automatically passed back to the caller. Also echo this to the console
		echo json_encode($response_array);

	}
// 	Close the connection
	$mysqli->close();
?>
