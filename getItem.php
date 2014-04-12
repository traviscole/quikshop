<?php 
//Jose Prado

sleep(1);
//Sanitize incoming data and store in variable
$itemID = trim(stripslashes(htmlspecialchars($_POST['barcode'])));	   
$humancheck = $_POST['humancheck'];
$honeypot = $_POST['honeypot'];

if ($honeypot == 'http://' && empty($humancheck)) {	
		
		//Validate data and return success or error message
		$error_message = '';	

		if (empty($itemID)) {
				   
				    $error_message .= "<p>Please provide your name.</p>";			   
		}
			
		if (!empty($error_message)) {
					$return['error'] = true;
					$return['msg'] = "<h3>Oops! The request was successful but your form is not filled out correctly.</h3>".$error_message;					
					echo json_encode($return);
					exit();
		} else {
			
			
			//Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
			$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

			//check if we made a connection
			if ($mysqli->connect_errno) {
   				$return['error'] = true;
				$return['msg'] = "<h3>Oops! We could not connect to the server.</h3>".$error_message;					
				echo json_encode($return);

    				exit();
			}


			$info = $mysqli->query("Select * From Items where barcode ='$itemID' and storeID = 2");
			if($info == False){
				$return['error'] = true;
				$return['msg'] = "<h3>Oops! We could not do the query.</h3>".$error_message;					
				echo json_encode($return);

    				exit();
					
			}else{

				if(mysqli_num_rows($info) == 0){
			  
						$return['error'] = true;
					$return['msg'] = "<h3>The item does not exists in our database</h3>".$error_message;					
					echo json_encode($return);

    					exit();
					
				}else{

				 $itemInfo = mysqli_fetch_assoc($info);
				 $return['price'] = $itemInfo['price'];
				 $return['desc'] = $itemInfo['description'];
				 $return['name'] = $itemInfo['name'];
				 $return['brand'] = $itemInfo['brand'];
       			 //Close the connection
       			 $mysqli->close();

				//making error = false
      				  $return['error'] = false;
		
				//sending the data back to the user
        			echo json_encode($return);

				}
			}

		 }		
} else {
	
	$return['error'] = true;
	$return['msg'] = "<h3>Oops! There was a problem with your submission. Please try again.</h3>";	
	echo json_encode($return);
}
	
?> 

