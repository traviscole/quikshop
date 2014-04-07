<?php 
//Jose Prado

sleep(2);
//Sanitize incoming data and store in variable
$name = trim(stripslashes(htmlspecialchars($_POST['fname'])));	
$lname = trim(stripslashes(htmlspecialchars($_POST['lname'])));	  		
$email = trim(stripslashes(htmlspecialchars($_POST['email'])));
$password = trim(stripslashes(htmlspecialchars($_POST['password'])));	    
$humancheck = $_POST['humancheck'];
$honeypot = $_POST['honeypot'];

if ($honeypot == 'http://' && empty($humancheck)) {	
		
		//Validate data and return success or error message
		$error_message = '';	
		$reg_exp = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/";
		
		if (!preg_match($reg_exp, $email)) {
				    
					$error_message .= "<p>A valid email address is required.</p>";			   
		}
		if (empty($name) || empty($lname)) {
				   
				    $error_message .= "<p>Please provide your name.</p>";			   
		}
		if(empty($password)){
				    $error_message .= "<p>Please provide a password.</p>";

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

			$hashPassword = password_hash($password, PASSWORD_DEFAULT);
							  

			if($mysqli->query("INSERT INTO Users (firstName, lastName, email, password) values ('$name','$lname','$email','$hashPassword')") == False){
				$return['error'] = true;
				$return['msg'] = "<h3>Oops! We could not do the query.</h3>".$error_message;					
				echo json_encode($return);

    				exit();
					
			}

			//Close the connection
			$mysqli->close();

			$return['error'] = false;
			$return['msg'] = "<p>Your account has been created! </p>"; 
			echo json_encode($return);
		  }		
} else {
	
	$return['error'] = true;
	$return['msg'] = "<h3>Oops! There was a problem with your submission. Please try again.</h3>";	
	echo json_encode($return);
}
	
?> 

