<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");
	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

	if (isset($_POST["barcode"]) && isset($_POST["cartId"]) && isset($_POST["userId"]) && isset($_POST["quantity"]) && isset($_POST["storeId"])) {
    	$barcode 		= mysqli_real_escape_string($mysqli,$_POST['fname']);
    	$cartId 		= mysqli_real_escape_string($mysqli,$_POST['lname']);
    	$userId 		= mysqli_real_escape_string($mysqli,$_POST['email']);
    	$quantity		= mysqli_real_escape_string($mysqli,$_POST['quantity']);
    	$storeId		= mysqli_real_escape_string($mysqli,$_POST['storeId']);
    	
		$sql="INSERT INTO Carts(barcode,cartId,userId,quantity,storeId) VALUES('$barcode','$cartId','$userId','$quantity','$storeId')";
		$result = $mysqli->query($sql) or die( $mysqli->error );
		if($result){
			$response_array['status'] = 'success';
		} else{ $response_array['status'] = 'error'; }
	} else { $response_array['status'] = 'error'; }
	echo json_encode($response_array);
	$mysqli->close();
?>
