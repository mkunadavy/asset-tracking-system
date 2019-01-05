<?php

require "connectSQLServer.php";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	
	$for = "";

	if(isset($_GET['for'])){
		$for = cleanStrings($_GET['for']);
	}
	
	$option = cleanStrings($_GET['option']);
	$run = '';
	
	$jsonArray = array();

	if($option == "loan"){
		$query = "SELECT status,item,date_loaned,username from loanregister";
	}

	else if($option == "catridge"){
		$query = "SELECT date_given,concat(color,' ',type) as catridge_name,name from catridgeregister order by name desc";
	}

	else if($option == "available"){
		$query = "SELECT name,serialnumber,assetid as barcode,quantity from itpool where quantity > 0";
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