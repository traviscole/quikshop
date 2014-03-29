<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");
	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

	if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    	$fName 			= mysqli_real_escape_string($mysqli,$_POST['fname']);
    	$lName 			= mysqli_real_escape_string($mysqli,$_POST['lname']);
    	$eMail 			= mysqli_real_escape_string($mysqli,$_POST['email']);
    	$pw 			= mysqli_real_escape_string($mysqli,$_POST['password']);
    	$address		= mysqli_real_escape_string($mysqli,$_POST['address']);
    	$passwordHashed = password_hash($pw, PASSWORD_DEFAULT);	
		$sql="UPDATE Users SET fname='$fName', lname='$lName', address='$address' passHash='$passwordHashed' WHERE email='$email' LIMIT 1"
		$result = $mysqli->query($sql) or die( $mysqli->error );
		if($result){
			$response_array['status'] = 'success';
		} else{ $response_array['status'] = 'error'; }
	} else { $response_array['status'] = 'error'; }
	echo json_encode($response_array);
	$mysqli->close();
?>
