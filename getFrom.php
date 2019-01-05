<?php

require 'connectSQLServer.php';

if($_SERVER['REQUEST_METHOD'] == "GET"){

	$jsonArray = array();

	if(isset($_GET['for'])){

		$user = $_GET['for'];

		$query = "select CONCAT(Notes,' / ',barcode, ' / ',SerialNumber) as details from AssetRegister where given_to = '$user'";
		$run_check = sqlsrv_query($connSQLServer,$query);
		
		if($run_check){
			while($row = sqlsrv_fetch_array($run_check, SQLSRV_FETCH_ASSOC)){
				$jsonArray[] = $row;
			}
		}
	}

	echo json_encode($jsonArray);
}
?>