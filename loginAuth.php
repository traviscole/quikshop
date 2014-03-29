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

    $username 		= $data->username;
	$password 		= $data->password;
	
	$sql = "SELECT userId, email, passHash FROM Users WHERE email='$username' LIMIT 1";
    $result = $mysqli->query($sql) or die( $mysqli->error );
    if($result){
    	$row = mysqli_fetch_assoc($result);
    	$hashedPW = $row['passHash'];
    	$userIdResponse = $row['userId'];
    	$sql2 = "SELECT cartId FROM Users WHERE ownerId='$userIdResponse' LIMIT 1";
    	$result2 = $mysqli->query($sql) or die( $mysqli->error );
    		if($result2){
    			$row2 = mysqli_fetch_assoc($result2);
    			$cartIdResponse = $row2['cartId'];   				
    		} else { $response_array['status'] = 'error'; }
    		$response_array['userId'] = $userIdResponse;
    		$response_array['email'] = $username;	
    		$response_array['cartId'] = $cartIdResponse;
	} else { $response_array['status'] = 'error'; }
	if (password_verify($password, $hashedPW)) {
    	$response_array['status'] = 'success'; 
    } else { $response_array['status'] = 'error'; }
	echo json_encode($response_array);
	$mysqli->close();
?>
