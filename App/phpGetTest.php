<?php
// Allow for errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Connect to the database NOTE: Hostgator may need another connection route than 'localhost'
$mysqli = new mysqli("quikshop.co","cx300_cen3031","[cEn..3031!]","cx300_quikshop");

// Various Includes
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, OPTIONS");
header("access-control-allow-credentials: true");
header("access-control-allow-headers: Content-Type, *");
header("Content-type: application/json");

// check connection
if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//	Find the correct table and row. Hardcode userId of 1
    $sql = "SELECT * FROM Users WHERE userId=1";
      
//	Assign this result to another veriable-->
	$result = $mysqli->query($sql) or die( $mysqli->error );
	$row = mysqli_fetch_assoc($result);

/*
	echo "userId: {$row['userId']} ".
        "email: {$row['email']} ".
        "passHash: {$row['passHash']} ".
        "currStoreId: {$row['currStoreId']} ".
        "currCartId: {$row['currCartId']} ".
        "fname: {$row['fname']} ".
        "lname: {$row['lname']} ";
*/

//	This builds the response array         
	$response_array['userId'] = $row['userId']; 
	$response_array['email'] = $row['email']; 
	$response_array['passHash'] = $row['passHash']; 
	$response_array['currStoreId'] = $row['currStoreId']; 
	$response_array['currCartId'] = $row['currCartId']; 
	$response_array['fname'] = $row['fname']; 
	$response_array['lname'] = $row['lname']; 
	

// Encode the response in JSON, it is automatically passed back to the caller. Also echo this to the console
	echo json_encode($response_array);

$mysqli->close();
?>

