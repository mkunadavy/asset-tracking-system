<?php

require 'connectSQLServer.php';

if($_SERVER['REQUEST_METHOD'] == "GET"){

	$jsonArray = array();

	if(isset($_GET['for']) && isset($_GET['user'])){

		$for = $_GET['for'];
		$user = $_GET['user'];

		if($for == 'assetregister'){
			$query = "select CONCAT(Notes,' / ',barcode, ' / ',SerialNumber) as details from AssetRegister where given_to = '$user'";
		}

		if($for == 'itpool'){
			$query = "select item as details from loanregister where username = '$user'";
		}

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