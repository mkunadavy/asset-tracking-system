<?php

require('connectSQLServer.php');

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	$query = $_GET['query'];
	
	$json = array();
	
	if($query == 'Employees'){
		
		$queryTest = "SELECT FirstName,Lastname,EmployeeID FROM EMPLOYEES order by FirstName";
		$run = sqlsrv_query($connSQLServer,$queryTest);
	
	
		while($row = sqlsrv_fetch_array( $run, SQLSRV_FETCH_ASSOC)){
			$json[] = $row;
		}
	
		echo json_encode($json);
	}
	
	else if($query == 'Donors'){
		
		$queryTest = "SELECT * FROM Donors order by DonorName";
		$run = sqlsrv_query($connSQLServer,$queryTest);
	
	
		while($row = sqlsrv_fetch_array( $run, SQLSRV_FETCH_ASSOC)){
			$json[] = $row;
		}
	
		echo json_encode($json);
	}

	else if($query == 'Conditions'){
		
		$queryTest = "SELECT * FROM Conditions order by ConditionID";
		$run = sqlsrv_query($connSQLServer,$queryTest);
	
	
		while($row = sqlsrv_fetch_array( $run, SQLSRV_FETCH_ASSOC)){
			$json[] = $row;
		}
	
		echo json_encode($json);
	}
	
	
}

else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>