<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
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
    	$cartId 		= $data->cartId;
    	$quantity 		= $data->quantity;
    	$storeId 		= $data->storeId;
    	
		$sql="SELECT * FROM AppItems WHERE storeID='$storeId' AND barcode='$barcode' LIMIT 1";
		$result = $mysqli->query($sql) or die( $mysqli->error );
		if($result)
    	{	
    		$row = mysqli_fetch_assoc($result);
    		$itemId 	= $row['itemID'];
    		$itemName 	= $row['name'];
    		
    		$check = $mysqli->query("SELECT itemID, cartID FROM AppCarts WHERE itemID = '$itemId' AND cartID = '$cartId';");
			if (mysqli_num_rows($check) == 0) {
				$sql2="INSERT INTO AppCarts(cartID,itemID,quantity) VALUES('$cartId','$itemId','$quantity')";
    	
    			$result2 = $mysqli->query($sql2) or die( $mysqli->error );
    			if($result2)
    			{
    			    $response_array['status'] 	= 'success';
    			    $response_array['itemName']	= $itemName;
				}
				else
				{ 
					$sql2="SELECT * FROM AppItems WHERE storeID='$storeId' AND barcode='$barcode' LIMIT 1";
					$result2 = $mysqli->query($sql2) or die( $mysqli->error );
					if($result)
    				{	
    				}
    				else{
    					$response_array['status'] = 'error'; 
						$response_array['reason'] = 'ERROR: Already in Cart';
					} 
				}
			}
			else {
				$response_array['status'] = 'error'; 
				$response_array['reason'] = 'ERROR: Already in Cart'; 
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
