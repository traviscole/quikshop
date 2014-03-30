<?php
	error_reporting(E_ALL);
//	ini_set('display_errors', '1');
	header("access-control-allow-origin: *");
	header("access-control-allow-methods: GET, POST, OPTIONS");
	header("access-control-allow-credentials: true");
	header("access-control-allow-headers: Content-Type, *");
	header("Content-type: application/json");
	
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

//	$data = json_decode(file_get_contents('php://input'));
	$data = json_decode(file_get_contents('http://www.quikshop.co/App/addToCartTest.json'));
//	var_dump($data);

	if($data) {
   	 	$barcode 		= $data->barcode;
    	$userId 		= $data->undefined;		// can't figure out how to title this field so defaults all around
    	$quantity 		= $data->quantity;
    	
		$sql="SELECT * FROM AppItems WHERE storeID='$storeId', barcode='$barcode' LIMIT 1";
		$result = $mysqli->query($sql) or die( $mysqli->error );
		if($result)
    	{	
    		$row = mysqli_fetch_assoc($result);
    		$itemId = $row['itemID'];
    		$itemName = $row['name'];
    		$sql2="SELECT * FROM AppLogins WHERE userID='$userId' LIMIT 1";
    	
    		$result2 = $mysqli->query($sql2) or die( $mysqli->error );
    		if($result2)
			{
				$row2 = mysqli_fetch_assoc($result);
    			$cartId = $row2['cartID'];
    			$sql="INSERT INTO AppCarts(cartID,itemID,quantity) VALUES('$cartId','$itemId','$quantity')";
    
    			$result3 = $mysqli->query($sql) or die( $mysqli->error );
    			if($result3)
    			{
    		    	$response_array['status'] 	= 'success';
    		    	$response_array['status'] 	= '$itemName';
				}
				else
				{ 
					$response_array['status'] = 'error'; 
					$response_array['reason'] = 'ERROR: Query Was Not Successfully Processed'; 
				}
			}
			else{
				$response_array['status'] = 'error'; 
				$response_array['reason'] = 'ERROR: User Does Not Have a Cart'; 
			}
    	}
    	else{
    		$response_array['status'] = 'error'; 
			$response_array['reason'] = 'ERROR: Query failed'; 
		}
   	}	
	else {
   	 	$response_array['status'] = 'error'; 
   	 	$response_array['reason'] = 'ERROR: No Data Was Passed'; 
    }
	
	echo json_encode($response_array);
	$mysqli->close();
?>
