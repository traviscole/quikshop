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
        $mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

        //check if we made a connection
        if ($mysqli->connect_errno) {
            $return['error'] = true;
            $return['msg'] = "<h3>Oops! We could not connect to the server.</h3>".$error_message;
            echo json_encode($return);

            exit();
        }

		//deciding which one to use depending on the user input
        if (!empty($zipcode))
            $result = $mysqli->query("SELECT name, storeId from Stores where zip = $zipcode");
        else
            $result = $mysqli->query("SELECT name, storeId from Stores where zip = 32608");

		//throw an error if the query didn't work
        if ($result == False) {
            $return['error'] = true;
            $return['msg'] = "<h3>Oops! We could not do the query.</h3>".$error_message;
            echo json_encode($return);

            exit();

        }

		//creating an array to store the names of the stores and to say if it was succesful or not
        $return = array();

		//getting all the names of the stores and we are going to store them in a json manner
        while ($t = mysqli_fetch_assoc($result)) {
            $return['stores'][$t['name']][] = $t['storeId'];
        }

        //Close the connection
        $mysqli->close();

		//making error = false
        $return['error'] = false;
		
		//sending the data back to the user
        echo json_encode($return);
    }
} else {

    $return['error'] = true;
    $return['msg'] = "<h3>Oops! There was a problem with your submission. Please try again.</h3>";
    echo json_encode($return);
}

?>



