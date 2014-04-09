<?php 
//Jose Prado

sleep(2);
//Sanitize incoming data and store in variable
$zipcode = trim(stripslashes(htmlspecialchars($_POST['zipcode'])));	
$long = trim(stripslashes(htmlspecialchars($_POST['long'])));
$lat = trim(stripslashes(htmlspecialchars($_POST['lat'])));   
$humancheck = $_POST['humancheck'];
$honeypot = $_POST['honeypot'];

if ($honeypot == 'http://' && empty($humancheck)) {	
		
		//Validate data and return success or error message
		$error_message = '';	


		if (empty($zipcode) && empty($long)) {
				    
					$error_message .= "<p>A valid zipcode is required .</p>";			   
		}
		if (!empty($error_message)) {
					$return['error'] = true;
					$return['msg'] = "<h3>Oops! The request was successful but your form is not filled out correctly.</h3>".$error_message;					
					echo json_encode($return);
					exit();
		} else {


			//Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
//			$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

			//check if we made a connection
//			if ($mysqli->connect_errno) {
  // 				$return['error'] = true;
	//			$return['msg'] = "<h3>Oops! We could not connect to the server.</h3>".$error_message;					
	//			echo json_encode($return);

    	//			exit();
	//		}

	//		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
							  

	//		if($mysqli->query("SELECT name, address from Stores where zip = $zipcode") == False){
	//			$return['error'] = true;
	//			$return['msg'] = "<h3>Oops! We could not do the query.</h3>".$error_message;					
	//			echo json_encode($return);

    	//			exit();
					
	//		}

	//		//Close the connection
	//		$mysqli->close();

			$return['error'] = false;
			$return['msg'] = "<p>Select one of the stores </p>"; 
			echo json_encode($return);
		  }		
} else {
	
	$return['error'] = true;
	$return['msg'] = "<h3>Oops! There was a problem with your submission. Please try again.</h3>";	
	echo json_encode($return);
}
	
?> 
