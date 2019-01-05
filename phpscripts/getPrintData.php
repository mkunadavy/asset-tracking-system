<?php

require 'connectSQLServer.php';

if($_SERVER['REQUEST_METHOD'] == "GET"){

	$for = cleanStrings($_GET['for']);
	
	$jsonArray = array();

	if($for == "All"){

		$query = "SELECT notes as device,barcode,serialnumber,given_to as assigned_to,category,manufacturer,donorid,device_name from assetregister order by category,given_to";
		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	else if($for == "Catridge"){

		$query = "SELECT quantinty,color,notes as catridge from catridges";
		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
    }
    
    else if($for == "Loan"){

		$query = "SELECT username,item,status,date_loaned as catridge from catridges";
		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	else if($for == "Others"){

		$query = "SELECT notes as device,barcode,serialnumber,given_to as assigned_to,category from assetregister where category != 'laptop' and category != 'printer' and category != 'monitor'";
		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	else if($for == 'User'){
		$user = $_GET["user"];
		$query = "SELECT notes as device,barcode,serialnumber,category from assetregister WHERE given_to = '$user'";
		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	else{

		$query = "SELECT notes as device,barcode,serialnumber,given_to as assigned_to,category from assetregister where category = '$for'";
		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	echo json_encode($jsonArray);
}

function cleanStrings($string)
{
	$string = trim($string);
	$string = stripcslashes($string);
	$string = htmlspecialchars($string);

	return $string;
}

?>