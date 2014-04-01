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
// 	Returns true if all these values were passed in
	if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["password"])) {

//	Assign the passed entry to variables
    		$fName 		= mysqli_real_escape_string($mysqli,$_POST['fname']);
    		$lName 		= mysqli_real_escape_string($mysqli,$_POST['lname']);
    		$eMail 		= mysqli_real_escape_string($mysqli,$_POST['email']);		// Required to not be NULL
    		$pw 		= mysqli_real_escape_string($mysqli,$_POST['password']);	// Required to not be NULL
    		var_dump($pw);
    		$passwordHashed = password_hash($pw, PASSWORD_DEFAULT);					// Hash PW before inserting
    
//	Build the query    
		$sql="INSERT INTO Users(email,password,firstname,lastname) VALUES('$eMail','$passwordHashed','$fName','$lName')";

//	Post the query, 
		$result = $mysqli->query($sql) or die( $mysqli->error );
		if($result){
			echo "Data for $fname inserted successfully!";
		}
		else{ 
			echo "An error occurred inserting user info";
		}
	}
	else {
		echo "The form was not filled out correctly";
	}

// 	Close the connection
	$mysqli->close();
?>
