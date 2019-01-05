<?php

require "phpscripts\connectSQLServer.php";

$arrayQuery = array();
$headers = array();

$for = cleanStrings($_GET['for']);

if($for == "All"){
    $headers = array("Device Name","Serial Number","AssetID","Assigned To","Category","Manufacturer");
    $query = "SELECT device_name,serialnumber,barcode,given_to as assigned_to,category,manufacturer from assetregister order by category,given_to";
}

else if($for == "Catridge"){

    $headers = array("Catridge Name","Color","Quantity");
    $query = "SELECT notes,color,quantity from catridges";
    
}

else if($for == "Loan"){

    $headers = array("User","Item","Status","Date Loaned");
    $query = "SELECT username,item,status,cast(date_loaned as varchar) from loanregister";

}

else if($for == "Others"){

    $headers = array("Device Name","AssetID","Serial Number","Quantity");
    $query = "SELECT name,assetid,serialnumber,quantity from itpool";
}

else if($for == 'User'){

    $for = $_GET["user"];
    $arrayQuery[] = array("Data For $for");
    $headers = array("Device Name","AssetID","Serial Number","Category");
    $query = "SELECT notes as device,barcode,serialnumber,category from assetregister WHERE given_to = '$for'";
}

else{
    $headers = array("Device Name","AssetID","Serial Number","Assigned To");
    $query = "SELECT notes as device,barcode,serialnumber,given_to as assigned_to from assetregister where category = '$for'";
}

$arrayQuery[] = $headers;
$run = sqlsrv_query($connSQLServer,$query);

if($run){
    while($row = sqlsrv_fetch_array($run,SQLSRV_FETCH_ASSOC)){
        $arrayQuery[] = $row;
    }
}

array_to_csv_download($arrayQuery,$for.".csv");

function array_to_csv_download($array, $filename, $delimiter=",") {
    // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w'); 
    // loop over the input array
    foreach ($array as $line) { 
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter); 
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
}

function cleanStrings($string)
{
	$string = trim($string);
	$string = stripcslashes($string);
	$string = htmlspecialchars($string);

	return $string;
}

?>