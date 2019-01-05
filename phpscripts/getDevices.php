<?php

if($_SERVER['REQUEST_METHOD'] == "GET"){

	
	$for = cleanStrings($_GET['for']);
	$period = cleanStrings($_GET['period']);

	fectchDevice($for,$period);

}

function fectchDevice($fetch_this,$period){

	require 'connectSQLServer.php';

	$jsonArray = array();

	if($period == 'long'){

		$query = "select CONCAT(Notes,' / ',barcode, ' / ',SerialNumber) as details from AssetRegister where category = '$fetch_this' and given_to is null order by notes";
		$run_check = sqlsrv_query($connSQLServer,$query);
		
		if($run_check){
			while($row = sqlsrv_fetch_array($run_check, SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	else if($period == 'shorter'){

		$query = "select CONCAT(Manufacturer,' ',category,' ',device_name,' / ',barcode, ' / ',SerialNumber) as details from AssetRegister where category = '$fetch_this' and flag = 1 order by notes";
		$run_check = sqlsrv_query($connSQLServer,$query);
		
		if($run_check){
			while($row = sqlsrv_fetch_array($run_check, SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	else if($period == 'short'){
		$query = "select distinct name as details from itpool where quantity > 0";
		$run_check = sqlsrv_query($connSQLServer,$query);
		
		if($run_check){
			while($row = sqlsrv_fetch_array($run_check, SQLSRV_FETCH_ASSOC)){
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