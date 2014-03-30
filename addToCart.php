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
//	var_dump($data);

    $barcode 		= $data->barcode;
    $storeId 		= $data->undefined;		// can't figure out how to title this field so defaults all around
    $quantity 		= $data->quantity;
    	
	$sql="SELECT * FROM AppItems WHERE storeID='$storeId', barcode='$barcode' LIMIT 1";
	$result = $mysqli->query($sql) or die( $mysqli->error );
	if($result)
    {	
    	$row = mysqli_fetch_assoc($result);
    	$itemId = $row['itemID'];
    	$sql="INSERT INTO AppUsers(email,fname,lname,address,city,state,zip,passHash) VALUES('$eMail','$fName','$lName','$address','$city','$state','$zip','$passwordHashed')";
    	
    	$result = $mysqli->query($sql) or die( $mysqli->error );
    	if($result)
		{
		}
    }
    else{
    	$response_array['status'] = 'error'; 
		$response_array['reason'] = 'ERROR: Item Does Not Exist'; 
    }	
	
	echo json_encode($response_array);
	$mysqli->close();
?>
