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
//	$data = json_decode(file_get_contents('http://www.quikshop.co/App/getStoreIdTest.json'));

	if($data) {
    	$name 		= $data->name;
    	
    	$sql = "SELECT * FROM Stores WHERE name = '$name'";
    	$result = $mysqli->query($sql) or die( $mysqli->error );
    
// If there was a response, perform more actions, else return "error"
    	if($result)
    	{		
    		$row = mysqli_fetch_assoc($result);	
    		$response_array['status'] 	= 'success';
    		$storeIdResponse = $row['storeID'];
    		$response_array['storeID'] 	= $storeIdResponse;
		}
		else {
			$response_array['status'] = 'error'; 
			$response_array['reason'] = 'ERROR: SQL call failed'; 
		}
	}
	else {
		$response_array['status'] = 'error'; 
		$response_array['reason'] = 'ERROR: No Data Was Passed'; 
	}
	echo json_encode($response_array);
	$mysqli->close();
?>
