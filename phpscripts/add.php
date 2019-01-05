<?php

session_start();

require 'connectSQLServer.php';

date_default_timezone_set('Africa/Harare');

$timestamp = date("Y-m-d H:i:s");

$notify = 'error';

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$for = cleanStrings($_POST['for']);

	if($for == 'any'){

		$device_name = ucwords(cleanStrings($_POST['device_name']));
		$manufacturer = cleanStrings($_POST['manufacturer']);
		$asset_id = "ZIM-".cleanStrings($_POST['asset_id']);
		$condition = cleanStrings($_POST['condition']);
		$category = cleanStrings($_POST['category']);
		$donor = cleanStrings($_POST['donor']);
		$serial_num = strtoupper(cleanStrings($_POST['serial_num']));
		$notes = $manufacturer." ".$device_name;

		$run_check = "SELECT barcode from assetregister where barcode = '$asset_id'";

		if(sqlsrv_has_rows(sqlsrv_query($connSQLServer,$run_check))){

			$query = "DELETE assetregister where barcode = '$asset_id'";
			sqlsrv_query($connSQLServer,$query);
		}

		$query_1 = "SELECT ConditionID from Conditions WHERE condition = '$condition'";
		$query_2 = "SELECT DonorId from Donors WHERE donorname = '$donor'";

		$run_check_1 = sqlsrv_query($connSQLServer,$query_1);
		$run_check_2 = sqlsrv_query($connSQLServer,$query_2);

		$row_1 = sqlsrv_fetch_array($run_check_1, SQLSRV_FETCH_ASSOC);
		$row_2 = sqlsrv_fetch_array($run_check_2, SQLSRV_FETCH_ASSOC);

		$conditionID = $row_1['ConditionID'];
		$donorID =$row_2['DonorId'];

		if(sqlsrv_has_rows($run_check_1) && sqlsrv_has_rows($run_check_2)){

			$query = "";
			if($category == 'Projector'){
				$query = "INSERT INTO assetregister(manufacturer,device_name,serialnumber,barcode,category,CONDITION,dONORID,Notes,flag) VALUES('$manufacturer','$device_name','$serial_num','$asset_id','$category','$conditionID','$donorID','$notes',1)";
			}

			else{
				$query = "INSERT INTO assetregister(manufacturer,device_name,serialnumber,barcode,category,CONDITION,dONORID,Notes,flag) VALUES('$manufacturer','$device_name','$serial_num','$asset_id','$category','$conditionID','$donorID','$notes',0)";
			}

			if(sqlsrv_query($connSQLServer,$query)){
				
				$notify = 'success';

				sendMail($notes,1,$serial_num,$asset_id);
			}

			else{
				$notify = "failure";
			}
		}
		

	}

	if($for == 'itpool'){

		$assetid = "";
		$serialnum = "";
		$name = cleanStrings($_POST['loan_item']);

		if(isset($_POST['assetid'])){
			$assetid = cleanStrings($_POST['assetid']);
		}
		
		if(isset($_POST['serialnum'])){

			if(!empty(cleanStrings($_POST['serialnum']))){
				$serialnum = cleanStrings($_POST['serialnum']);
			}
		}
		
		$quantity = cleanStrings($_POST['loan_quantity']);

		$query = "SELECT quantity from itpool WHERE name = '$name' and serialnumber = '' and assetid = ''";
		$run_check = sqlsrv_query($connSQLServer,$query);

		if(sqlsrv_has_rows($run_check)){

			$row = sqlsrv_fetch_array($run_check, SQLSRV_FETCH_ASSOC);

			$old_quantity = $row['quantity'];
			$new_quantity = $old_quantity + $quantity;

			$query = "UPDATE itpool set quantity = '$new_quantity' where name = '$name'";

			if(sqlsrv_query($connSQLServer,$query)){
				$notify = 'success';
			}

			else{
				$notify = "failure 1";
			}
		}

		else{

			$query = "INSERT INTO itpool(name,quantity,serialnumber,assetid) values ('$name','$quantity','$serialnum','$assetid')";

			if(sqlsrv_query($connSQLServer,$query)){

				$query = "UPDATE assetregister set flag = '2' where barcode = '$assetid'";

				if (sqlsrv_query($connSQLServer,$query)) {
					$notify = 'success';
				}
			}

			else{
				$notify = $name." ".$quantity." ".$serialnum." ".$assetid;
			}

		}

	}

	if($for == 'cat'){

		$vendor = cleanStrings($_POST['vendor']);
		$cat_type = cleanStrings($_POST['cat_type']);
		$color = cleanStrings($_POST['color']);
		$quantity = cleanStrings($_POST['quantity']);
		$notes = $vendor." ".$cat_type;

		$check_type = "SELECT quantinty FROM catridges WHERE type='$cat_type' AND color='$color'";
		$run_check = sqlsrv_query($connSQLServer,$check_type);

		if(sqlsrv_has_rows($run_check)){
					
			$row = sqlsrv_fetch_array($run_check, SQLSRV_FETCH_ASSOC);
			
			$new_quantity = $row['quantinty'] + (int)$quantity;
			$update_cat = "UPDATE catridges SET quantinty='$new_quantity' WHERE type='$cat_type' AND color='$color'";
			$run_update = sqlsrv_query($connSQLServer,$update_cat);
			
			if($run_update){
				$notify = "success_update";
			}
		}

		else{
					
			$query = "INSERT INTO catridges(vendor,type,color,quantinty,added_by,date_added,notes) VALUES ('$vendor','$cat_type','$color','$quantity','','$timestamp','$notes')";

			if(sqlsrv_query($connSQLServer,$query)){
				$notify = "success_insert";
				sendCatridgeMail($vendor." ".$cat_type,$color,$quantity);
			}

			else{
				$notify = "error_insert";
			}
		}

		
	}

}

echo $notify;

function cleanStrings($string)
{
	$string = trim($string);
	$string = stripcslashes($string);
	$string = htmlspecialchars($string);

	return $string;
}

function sendMail($name,$quantity,$serialnum,$assetid){
	
	unset($_SESSION['address']);
	$signature = "\n\nRegards,\n\nIT Support \nElizabeth Glaser Pediatric AIDS Foundation – Zimbabwe \nArundel Office Park\n107 Norfolk Rd. Block 5 – 1st Floor\nMt. Pleasant, Harare";
	$_SESSION['subject'] = 'New Item Added To The IT Pool Database';
	$_SESSION['msg'] = "The following item has been added to the Database: \n\nItem Name: ".$name."\nAssetID: ".$assetid."\nSerial Number: ".$serialnum."\nQuantity: ".$quantity.$signature;

	header("Location: http://localhost:81/assettrack/homemail.php");
}

function sendCatridgeMail($cat_name,$color,$quantity){

	$signature = "\n\nRegards,\n\nIT Support \nElizabeth Glaser Pediatric AIDS Foundation – Zimbabwe \nArundel Office Park\n107 Norfolk Rd. Block 5 – 1st Floor\nMt. Pleasant, Harare";
	$_SESSION['subject'] = 'Addtions to the Catridge Pool Database';
	$_SESSION['msg'] = "The following item has been added to the Database:".$cat_name."\nColor: ".$color."\nQuantity: ".$quantity.$signature;

	header("Location: http://localhost:81/assettrack/homemail.php");
}

?>