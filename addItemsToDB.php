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
//	$data = json_decode(file_get_contents('http://www.quikshop.co/App/addToDbTest.json'));

	if($data) {
    	$name 			= $data->name;
    	$description	= $data->description;
   	 	$barcode 		= $data->barcode;
   	 	$brand 			= $data->brand;
   	 	
   	 	for ($i = 1; $i <= 10; $i++) {
   	 		$decimal = mt_rand(1,99)/100;
   	 		$tens = mt_rand(0,15); 
   	 		$price = $tens + $decimal;
   	 		
   	 		
   	 		$storeID = $i;
   	 		$mysqli->query("INSERT INTO Items(storeID,name,description,price,barcode,brand) VALUES('$storeID','$name','$description','$price','$barcode','$brand')");
		}
		$response_array['status'] = 'success'; 
		$response_array['reason'] = 'Successfully added to DB'; 
	}	
	else {
   	 	$response_array['status'] = 'error'; 
   	 	$response_array['reason'] = 'ERROR: No Data Was Passed'; 
    }
	
echo json_encode($response_array);
$mysqli->close();
?>
