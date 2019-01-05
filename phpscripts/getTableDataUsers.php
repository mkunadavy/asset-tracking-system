<?php

require 'connectSQLServer.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	
	$for = "";

	if(isset($_GET['for'])){
		$for = cleanStrings($_GET['for']);
	}
	
	$option = cleanStrings($_GET['option']);
	$run = '';
	
	$jsonArray = array();

	if($option == "assets"){
		$query = "SELECT notes as device,barcode,serialnumber,category from assetregister WHERE given_to = '$for'";
	}

	else if($option == "loan"){
		$query = "SELECT status,item,date_loaned from loanregister WHERE username = '$for'";
	}

	else if($option == "catridge"){
		$query = "SELECT date_given,concat(color,' ',type) as catridge_name from catridgeregister WHERE name = '$for' order by date_given desc";
	}

	else if($option == "available"){
		$query = "SELECT name,serialnumber,assetid as barcode from itpool where quantity > 0";
	}

	$run = sqlsrv_query($connSQLServer,$query);

	if($run){
		while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
			$jsonArray[] = $row;
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