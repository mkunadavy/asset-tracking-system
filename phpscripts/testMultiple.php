<?php

require 'connectSQLServer.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){

	if(isset($_POST['enter']) && $_POST['enter'] == 'multiple'){
		
		$arrayItems = array();
		$laptop = $printer = $monitor = $docking_station = $scanner = $notify = "";
		$user = $_POST['for'];

		if(isset($_POST['laptop_to']) && $_POST['laptop_to'] != "Select Laptop"){
			$laptop = cleanStrings(explode("/",$_POST['laptop_to'])[1]);
			array_push($arrayItems, $laptop);
		}

		if(isset($_POST['printer_to']) && $_POST['printer_to'] != "Select Printer"){
			$printer = cleanStrings(explode("/",$_POST['printer_to'])[1]);
			array_push($arrayItems, $printer);
		}
		if(isset($_POST['monitor_to']) && $_POST['monitor_to'] != "Select Monitor"){
			$monitor = cleanStrings(explode("/",$_POST['monitor_to'])[1]);
			array_push($arrayItems, $monitor);
		}
		if(isset($_POST['docking_station_to']) && $_POST['docking_station_to'] != "Select Docking Station"){
			$docking_station = cleanStrings(explode("/",$_POST['docking_station_to'])[1]);
			array_push($arrayItems, $docking_station);
		}

		if(isset($_POST['scanner_to']) && $_POST['scanner_to'] != "Select Scanner"){
			$scanner = cleanStrings(explode("/",$_POST['scanner_to'])[1]);
			array_push($arrayItems, $scanner);
		}

		
		for ($i=0; $i < count($arrayItems); $i++) {
			
			$query = "UPDATE assetregister set given_to = '$user' where barcode = '$arrayItems[$i]'";

			if(sqlsrv_has_rows(sqlsrv_query($connSQLServer,$query))){
				$notify = "success";
			}
		}

		echo $notify;

		
	}

	else{
		$notify = 0;

		$for = cleanStrings($_POST['for']);
		$data = $_POST['data'];

		 for ($i=0; $i < count($data); $i++) {
			
			$query = "UPDATE assetregister set given_to = null where barcode = '$data[$i]'";

			if(sqlsrv_has_rows(sqlsrv_query($connSQLServer,$query))){
				$notify = $notify + 1;
			}
		}

		echo $notify." have been processed";
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