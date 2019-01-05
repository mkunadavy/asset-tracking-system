<?php

$format="%Y-%m-%dT%H:%M:%S";
$time_stamp=strftime($format);
$validation = "error";
$json = array();

$json[0] = ["alevel" => null];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$serverName = "DAVIDO-PC\sqlexpress"; //serverName\instanceName

	// Since UID and PWD are not specified in the $connectionInfo array,
	// The connection will be attempted using Windows Authentication.
	$connectionInfo = array( "Database"=>"AssetTrack");
	$connSQLServer = sqlsrv_connect( $serverName, $connectionInfo);

	if(!$connSQLServer){
		echo("Error Connecting To SQL Server");
	}


	else{

		$username = strtolower($_POST['username']);
		$password = $_POST['password'];

		$query = "SELECT top(1) username,firstname,surname,alevel,password FROM tblusers WHERE username = '$username'";
		$run = sqlsrv_query($connSQLServer,$query);
		$rows = sqlsrv_has_rows($run);

		if( $run && ($rows === true)){

			$row = sqlsrv_fetch_array( $run, SQLSRV_FETCH_ASSOC);
			
			$validation = "successful";

			$json[0] = ["alevel" => $row['alevel']];

			$full_name = $row['firstname'].' '.$row['surname'];

			if($row['alevel'] == 1 && password_verify($password,$row['password'])){
				session_start();
				$_SESSION["user-admin"] = "Admin - ".$full_name;
			}

			else if($row['alevel'] == 0 && password_verify($password,$row['password'])){
				session_start();
				$_SESSION["user-normal"] = $full_name;
			}
			
		}

		$json[] = ['validation' => $validation];

		echo json_encode($json);
	}
}

?>