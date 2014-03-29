<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");
	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

	$data = json_decode(file_get_contents('php://input'));
	var_dump($data);

    	$email 		= $data->email;

	$sql = "SELECT userId, email, fName, lName, address FROM Users WHERE email='$email' LIMIT 1";
   
    	$result = $mysqli->query($sql) or die( $mysqli->error );
	
	if($result)
	{
    	$row = mysqli_fetch_assoc($result);
		$response_array['email'] = $username;
    	$userIdResponse = $row['userId'];
    		$response_array['userId'] = $userIdResponse;
    	$fNameResponse = $row['fName'];
    		$response_array['fName'] = $fNameResponse;
    	$lNameResponse = $row['lName'];
    		$response_array['lName'] = $lNameResponse;
    	$addressResponse = $row['address'];
		$response_array['address'] = $addressResponse;
	$userIdResponse = $row['userId'];
		$response_array['status'] = 'success'; 
	} 
	else { $response_array['status'] = 'error'; }
	
	echo json_encode($response_array);
	$mysqli->close();
?>
