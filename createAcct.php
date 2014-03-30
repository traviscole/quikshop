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

    $eMail 		= $data->eMail;
    $fName 		= $data->fName;
    $lName 		= $data->lName;
    $address 	= $data->address;
    $city 		= $data->city;
	$state 		= $data->state
    $zip 		= $data->zip;
    $pw 		= $data->pw;
    $passwordHashed 	= password_hash($pw, PASSWORD_DEFAULT);	
    
    $sql="INSERT INTO AppUsers(email,fname,lname,address,city,state,zip,passHash) VALUES('$eMail','$fName','$lName','$address','$city','$state','$zip','$passwordHashed')";
    
    $result = $mysqli->query($sql) or die( $mysqli->error );
    if($result)
    {
		$sql2 = "SELECT * FROM Users WHERE email='$eMail' LIMIT 1";
		$result2 = $mysqli->query($sql2) or die( $mysqli->error );
		
		if($result2) 
		{ 
			$row2 = mysqli_fetch_assoc($result2);
    			$cartIdResponse = $row2['cartId']; 
    			$uerIdResponse = $row2['userId']; 	
    			$response_array['cartId'] = $cartIdResponse;
    			$response_array['userId'] = $userIdResponse;
    			$response_array['status'] = 'success';
    			
    			if(is_null($cartIdResponse))
    			{
    				$response_array['status'] = 'error';
   			}
   			
    			if(is_null($userId))
    			{
    				$response_array['status'] = 'error';
    			}
		} 
		else 
		{ 
			$response_array['status'] = 'error';
		}
	}
	else
	{ 
		$response_array['status'] = 'error'; 
	}
	
	echo json_encode($response_array);
	$mysqli->close();
?>
