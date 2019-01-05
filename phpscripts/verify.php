<?php

require ("connectSQLServer.php");

// $plaintext = "message to be encrypted FT";
// $cipher = "aes-128-gcm";
// if (in_array($cipher, openssl_get_cipher_methods()))
// {
//     $ivlen = openssl_cipher_iv_length($cipher);
//     $iv = openssl_random_pseudo_bytes($ivlen);
//     $key = "EGPAFZIM";
//     $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
//     //store $cipher, $iv, and $tag for decryption later
//     $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
//     echo $original_plaintext."\n";
// }

$format="%Y-%m-%dT%H:%M:%S";
$time_stamp=strftime($format);
$validation = "error";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT username,firstname,surname FROM tblusers WHERE username = '$username' AND password = '$password'";
	$run = sqlsrv_query($connSQLServer,$query);
	$rows = sqlsrv_has_rows($run);

	if( $run && ($rows === true)){
		
		setcookie("user",$username,time() + 3600);
		$validation = "successful";

		// $row = sqlsrv_fetch_array( $run, SQLSRV_FETCH_ASSOC);

		// $firstname = $row['firstname'];

		// $lastname = $row['surname'];

		// $cookie_name = randomString();
		
		// $cookie_value = $username;

		// $query2 = "INSERT INTO active_users(userID,userKey,timeIn) VALUES ('$userID','$cookie_name','$time_stamp')";
		
		// $run2 = sqlsrv_query($connSQLServer,$query2);
		
		// if($run2) {
			
		// }
		
	}

	echo $validation;
	
}

function randomString($length = 10) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

?>