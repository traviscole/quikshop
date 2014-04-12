<?php 
//Jose Prado

session_start();

sleep(1);
//Sanitize incoming data and store in variable
$itemID = trim(stripslashes(htmlspecialchars($_POST['id'])));
$cartID = $_SESSION['cartID'];	
$qt = trim(stripslashes(htmlspecialchars($_POST['qt'])));

	//Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
	$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

	//check if we made a connection
	if ($mysqli->connect_errno) {
   		$return['error'] = true;
		$return['msg'] = "<h3>Oops! We could not connect to the server.</h3>".$error_message;					
		echo json_encode($return);

    		exit();
	}

	$check = $mysqli->query("Select quantity From Carts where cartID = '$cartID' and itemID = '$itemID' ");

	if($check == False){
		$return['error'] = true;
		$return['msg'] = "<h3>Oops! We could not do the query.</h3>".$error_message;					
		echo json_encode($return);

    		exit();
					
	}else{

		if(mysqli_num_rows($check) == 0){
			  

			if($mysqli->query("INSERT INTO Carts (cartID, itemID , quantity) values ('$cartID','$itemID','$qt')") == False){
				$return['error'] = true;
				$return['msg'] = "<h3>Oops! We could not do the query.</h3>".$error_message;					
				echo json_encode($return);

    				exit();
					
			}

					//Close the connection
					$mysqli->close();

					$return['cartID'] = $cartID;
					$return['qt'] = $qt;
					$return['error'] = false;
					$return['msg'] = "<p>Item has been added! </p>"; 
					echo json_encode($return);
		}else{

			$row = mysqli_fetch_assoc($check);
					
			$qt += $row['quantity'];

			if($mysqli->query("UPDATE Carts set quantity = '$qt' where cartID = '$cartID' and itemID = '$itemID'") == False){
				$return['error'] = true;
				$return['msg'] = "<h3>Oops! We could not do the query.</h3>".$error_message;					
				echo json_encode($return);

    				exit();
					
			}
					//Close the connection
					$mysqli->close();

					$return['cartID'] = $cartID;
					$return['qt'] = $qt ;
					$return['error'] = false;
					$return['msg'] = "<p>Your cart has been updated! </p>"; 
					echo json_encode($return);


		}
	}

	
?> 

