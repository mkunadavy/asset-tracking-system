<?php

require 'connectSQLServer.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$username = cleanStrings($_POST['username']);
	$password = cleanStrings($_POST['password']);

	$query = "SELECT * FROM tblusers WHERE username = '$username' and password = '$password'";
	$run = sqlsrv_query($connSQLServer,$query);

	if(sqlsrv_has_rows($run)){
		echo "authorised";
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