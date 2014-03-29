<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");
	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

	if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["address"])) {
    	$fName 			= mysqli_real_escape_string($mysqli,$_POST['fname']);
    	$lName 			= mysqli_real_escape_string($mysqli,$_POST['lname']);
    	$eMail 			= mysqli_real_escape_string($mysqli,$_POST['email']);
    	$address 		= mysqli_real_escape_string($mysqli,$_POST['address']);
    	$pw 			= mysqli_real_escape_string($mysqli,$_POST['password']);
    	$passwordHashed = password_hash($pw, PASSWORD_DEFAULT);	
    
		$sql="INSERT INTO Users(email,passHash,fname,lname,address) VALUES('$eMail','$passwordHashed','$fName','$lName','$address')";

		$result = $mysqli->query($sql) or die( $mysqli->error );
		if($result){
			$sql2 = "SELECT currCartId FROM Users WHERE email='$eMail' LIMIT 1";
			$result2 = $mysqli->query($sql2) or die( $mysqli->error );
			
			if($result2) { 
				$row2 = mysqli_fetch_assoc($result2);
    			$cartIdResponse = $row2['cartId']; 
    			$userIdResponse = $row2['userId']; 	
    			$response_array['cartId'] = $cartIdResponse;
    			$response_array['userId'] = $userIdResponse;
    			$response_array['status'] = 'success';
    			if(is_null($cartIdResponse)){
    				$response_array['status'] = 'error';
   				}
    			if(is_null($userId)){
    				$response_array['status'] = 'error';
    			}
			} else { $response_array['status'] = 'error'; }
		} else{ $response_array['status'] = 'error'; }
	} else { $response_array['status'] = 'error'; }
	echo json_encode($response_array);
	$mysqli->close();
?>
