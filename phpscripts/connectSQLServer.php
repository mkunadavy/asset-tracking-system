<?php

$serverName = "DAVIDO-PC\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"AssetTrack");
$connSQLServer = sqlsrv_connect( $serverName, $connectionInfo);

if(!$connSQLServer){
	die( print_r( sqlsrv_errors(), true));
}

?>