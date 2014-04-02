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

	if($data) {
   	 	$barcode 		= $data->barcode;
    	$cartId 		= $data->cartID;
    	$quantity 		= $data->quantity;
    	$storeId 		= $data->storeID;
    	
		$sql="SELECT * FROM Items WHERE storeID='$storeId' AND barcode='$barcode' LIMIT 1";
		$result = $mysqli->query($sql) or die( $mysqli->error );
		if($result)
    	{	
    		$row = mysqli_fetch_assoc($result);
    		$itemId 	= $row['itemID'];
    		$itemName 	= $row['name'];
    		
    		if($itemName != null){
    		  	$check = $mysqli->query("SELECT itemID, cartID FROM Carts WHERE itemID = '$itemId' AND cartID = '$cartId';");
				if (mysqli_num_rows($check) == 0) {
					$sql2="INSERT INTO Carts(cartID,itemID,quantity) VALUES('$cartId','$itemId','$quantity')";
    	
    				$result2 = $mysqli->query($sql2) or die( $mysqli->error );
    				if($result2)
    				{
    			 	   $response_array['status'] 	= 'success';
    			 	   $response_array['itemName']	= $itemName;
    			 	   $response_array['quantityReturned'] = $quantity;
					}
					else
					{ 
						$response_array['status'] = 'error'; 
						$response_array['reason'] = 'ERROR: Inserting item failed';
					}
				}
				else {
					$sql2="SELECT * FROM Carts WHERE cartID='$cartId' AND itemID='$itemId' LIMIT 1";
					$result2 = $mysqli->query($sql2) or die( $mysqli->error );
					if($result)
    				{	
    					$row3 = mysqli_fetch_assoc($result2);
    					$quantityFetched = $row3['quantity'];
    					$quantityReturn = $quantityFetched + $quantity;
    					$sql3="UPDATE Carts SET quantity='$quantityReturn' WHERE cartID='$cartId' AND itemID='$itemId' LIMIT 1";
	
						$result3 = $mysqli->query($sql3) or die( $mysqli->error );
						if($result3)
						{
							$response_array['status'] = 'success';
							$response_array['quantityReturned'] = $quantityReturn;
							$response_array['itemName']	= $itemName;
						} 
						else
						{
							$response_array['status'] = 'error';
						}
    				}
    				else{
    					$response_array['status'] = 'error'; 
						$response_array['reason'] = 'ERROR: Did not successfully update quantity';
					} 
				}
    		}
    		else{
    			$response_array['status'] = 'error'; 
				$response_array['reason'] = 'ERROR: That Item Does Not Exist In the Database'; 
			}
   		}
   		else{
    			$response_array['status'] = 'error'; 
				$response_array['reason'] = 'ERROR: Query Failed'; 
		}
	}	
	else {
   	 	$response_array['status'] = 'error'; 
   	 	$response_array['reason'] = 'ERROR: No Data Was Passed'; 
    }
	
echo json_encode($response_array);
$mysqli->close();
?>
