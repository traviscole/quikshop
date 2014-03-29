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

    $fName 		= $data->fName;
	$lName 		= $data->lName;
    $eMail 		= $data->email;
    $pw 		= $data->password;
    $address 	= $data->address;
    
    $passwordHashed = password_hash($pw, PASSWORD_DEFAULT);	
	$sql="UPDATE Users SET fname='$fName', lname='$lName', address='$address' passHash='$passwordHashed' WHERE email='$email' LIMIT 1"
	
	$result = $mysqli->query($sql) or die( $mysqli->error );
	if($result){
		$response_array['status'] = 'success';
	} else{ $response_array['status'] = 'error'; }
	
	echo json_encode($response_array);
	$mysqli->close();
?>
