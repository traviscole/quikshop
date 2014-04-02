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
    
		$check = $mysqli->query("SELECT email FROM AppUsers WHERE  email = '$eMail';");
		if (mysqli_num_rows($check) == 0) {
			$sql="INSERT INTO AppUsers(email,fname,lname,address,city,state,zip,passHash) VALUES('$eMail','$fName','$lName','$address','$city','$state','$zip','$passwordHashed')";
    
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
