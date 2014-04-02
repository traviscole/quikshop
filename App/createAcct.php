<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");
	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

<<<<<<< HEAD
	$data = json_decode(file_get_contents('php://input'));
//	$data = json_decode(file_get_contents('http://www.quikshop.co/App/createAccTest.json'));
//	var_dump($data);
	if($data) {
    	$eMail 		= $data->email;
    	$fName 		= $data->fName;
    	$lName 		= $data->lName;
    	$address 	= $data->address;
    	$city 		= $data->city;
		$state 		= $data->state;
    	$zip 		= $data->zip;
    	$pw 		= $data->password;
    	$passwordHashed 	= password_hash($pw, PASSWORD_DEFAULT);	
    
		$check = $mysqli->query("SELECT email FROM Users WHERE email = '$eMail';");
		if (mysqli_num_rows($check) == 0) {
			$sql="INSERT INTO Users(email,firstname,lastname,address,city,state,zip,password) VALUES('$eMail','$fName','$lName','$address','$city','$state','$zip','$passwordHashed')";
    
    		$result = $mysqli->query($sql) or die( $mysqli->error );
    		if($result)
    		{
    		    $response_array['status'] 	= 'success';
			}
			else
			{ 
				$response_array['status'] = 'error'; 
				$response_array['reason'] = 'ERROR: Query Was Not Successfully Processed'; 
			}
=======
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
>>>>>>> master
		}
		else {
			$response_array['status'] = 'error'; 
			$response_array['reason'] = 'ERROR: User Exists'; 
		}
	}
	else {
		$response_array['status'] = 'error'; 
		$response_array['reason'] = 'ERROR: No Data Was Passed'; 
	}
	echo json_encode($response_array);
	$mysqli->close();
?>
