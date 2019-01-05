<?php

require 'connectSQLServer.php';

date_default_timezone_set('Africa/Harare');

$timestamp = date("Y-m-d h:i:sa");

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$color = cleanStrings($_POST['color']);
	$type = cleanStrings($_POST['type']);
	$username = cleanStrings($_POST['username']);

	$query = "SELECT quantinty from catridges where color = '$color' and type = '$type'";
	$run = sqlsrv_query($connSQLServer,$query);

	if($run){
		
		$row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC);
		$new = $row['quantinty'] - 1;

		$query = "UPDATE catridges SET quantinty = '$new' where color = '$color' and type = '$type'";
		$run = sqlsrv_query($connSQLServer,$query);
		
		if($run){
			
			$query = "INSERT INTO catridgeregister values('$timestamp','$username','$type','$color')";
			$run = sqlsrv_query($connSQLServer,$query);

			echo "Successfuly assigned - ".$type." ".$color." to ".$username;
		}
		
	}
}

function cleanStrings($string)
{
	$string = trim($string);
	$string = stripcslashes($string);
	$string = htmlspecialchars($string);

	return $string;
}

?>