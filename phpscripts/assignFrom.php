<?php

session_start();

require 'connectSQLServer.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$for = cleanStrings($_POST['for']);

	$user = cleanStrings($_POST['assign_from_user']);
	$device = cleanStrings($_POST['assign_from_device']);

	if($for == 'itpool'){

		$query = "delete loanregister where username = '$user' and item = '$device'";

		$run = sqlsrv_query($connSQLServer,$query);

		if($run){

			$query = "SELECT quantity from itpool where name = '$device'";
			$run = sqlsrv_query($connSQLServer,$query);
			$row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC);

			$new_quantity = $row['quantity'] + 1;

			$query = "UPDATE itpool SET quantity = '$new_quantity' where name = '$device'";
			$run = sqlsrv_query($connSQLServer,$query);

			if($run){

				$query = "SELECT notes,serialnumber,barcode from assetregister where name = '$device'";
				$runQuery = sqlsrv_query($connSQLServer,$query);
				$row = sqlsrv_fetch_array($runQuery, SQLSRV_FETCH_ASSOC);
	
				$array = explode(" ",$user);
				$initial = lcfirst(substr($array[0],0,1));
				$surname = lcfirst($array[1]);
				$domain = "@pedaids.org";
				$fullEmail = $initial.$surname.$domain;
	
				sendMail($fullEmail,$row['notes'],$row['barcode'],$row['serialnumber'],$user);
			}

			else{
				echo "Failure";
			}
		}
	}

	else if($for == 'assetregister'){

		$query = "UPDATE assetregister SET given_to = null where barcode = '$device'";

		$run = sqlsrv_query($connSQLServer,$query);

		if($run){

			$query = "SELECT notes,serialnumber,barcode from assetregister where barcode = '$device'";
			$runQuery = sqlsrv_query($connSQLServer,$query);
			$row = sqlsrv_fetch_array($runQuery, SQLSRV_FETCH_ASSOC);

			$array = explode(" ",$user);
			$initial = lcfirst(substr($array[0],0,1));
			$surname = lcfirst($array[1]);
			$domain = "@pedaids.org";
			$fullEmail = $initial.$surname.$domain;

			sendMail($fullEmail,$row['notes'],$row['barcode'],$row['serialnumber'],$user);
			//echo ("Successfully De-assigned Asset - ".$device." for ".$user);
		}

		else{
			echo "Failure Asset Register";
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
	$_SESSION['subjectAssign'] = 'An Item Has Been Returned From An Employee';
	$_SESSION['msgAssign'] = "The following item has been returned from ".$username.": \n\nItem Name: ".$device_name."\nAssetID: ".$assetid."\nSerial Number: ".$serialnum.$signature;
	$_SESSION['email'] = $assigneeEmail;

	header("Location: http://localhost:81/assettrack/assignmail.php?email=".$assigneeEmail);
}

?>