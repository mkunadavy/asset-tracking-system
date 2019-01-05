<?php

require('connectSQLServer.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$json = array();

	$category = $_POST['category'];
	$search = $_POST['search'];

	if(!empty($search)){

		$query = "select distinct device_name as result from assetregister where category = '$category' AND device_name like '%$search%'";

		$run = sqlsrv_query($connSQLServer,$query);

		if($run){
			while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
				$json[] = $row;
			}
		}
	}
	
	echo json_encode($json);
}

?>