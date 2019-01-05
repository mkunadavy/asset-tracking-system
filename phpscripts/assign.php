<?php

session_start();

require 'connectSQLServer.php';

date_default_timezone_set('Africa/Harare');

$timestamp = date("Y-m-d H:i:s");

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$username = cleanStrings($_POST['username']);

	if(isset($_POST['for']) && !empty($_POST['for'])){
		
		$name = cleanStrings($_POST['device']);
		$query = "SELECT quantity from itpool where name = '$name'";
		
		if(sqlsrv_query($connSQLServer,$query)){

			$row = sqlsrv_fetch_array(sqlsrv_query($connSQLServer,$query), SQLSRV_FETCH_ASSOC);
			$new_quantity = $row['quantity'] - 1;

			$query = "UPDATE itpool set quantity = '$new_quantity' where name = '$name'";
			$run = sqlsrv_query($connSQLServer,$query);

			if($run){

				$query = "INSERT INTO loanregister(username,item,date_loaned) values ('$username','$name','$timestamp')";
				$run = sqlsrv_query($connSQLServer,$query);

				if($run){
					echo "Successfuly Loaned";
				}

				else{
					echo "Error Loaning";
				}
			} 

		}
	}

	else{
		$assetid = cleanStrings($_POST['assetid']);

		$query = "UPDATE AssetRegister SET given_to = '$username' where barcode = '$assetid' and given_to is null";
		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			
			$query = "SELECT notes,serialnumber,barcode from assetregister where given_to = '$username'";
			$runQuery = sqlsrv_query($connSQLServer,$query);
			$row = sqlsrv_fetch_array($runQuery, SQLSRV_FETCH_ASSOC);

			$array = explode(" ",$username);
			$initial = lcfirst(substr($array[0],0,1));
			$surname = lcfirst($array[1]);
			$domain = "@pedaids.org";
			$fullEmail = $initial.$surname.$domain;

			sendMail($fullEmail,$row['notes'],$row['barcode'],$row['serialnumber'],$username);

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

function sendMail($assigneeEmail,$device_name,$serialnum,$assetid,$username){

	$signature = "\n\nRegards,\n\nIT Support \nElizabeth Glaser Pediatric AIDS Foundation – Zimbabwe \nArundel Office Park\n107 Norfolk Rd. Block 5 – 1st Floor\nMt. Pleasant, Harare";
	$_SESSION['subjectAssign'] = 'An Item Has Assigned To An Employee';
	$_SESSION['msgAssign'] = "The following item has been assigned to ".$username.": \n\nItem Name: ".$device_name."\nAssetID: ".$assetid."\nSerial Number: ".$serialnum.$signature;
	$_SESSION['email'] = $assigneeEmail;

	header("Location: http://localhost:81/assettrack/assignmail.php?email=".$assigneeEmail);
}

?>