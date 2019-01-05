<?php

  require('oauth.php');
  
  $_SESSION['api_url'] = "https://outlook.office.com/api/v2.0/me/sendmail";
  $loggedIn = !is_null($_SESSION['access_token']);
  $subject = $_SESSION['subjectAssign'];
  $message = $_SESSION['msgAssign'];
  $to = "";

  if(isset($_GET['email'])){
    $to = $_GET['email'];
  }

  $messageHeader = '{"Message": {"Subject": "'.$subject.'","Body": {"ContentType": "Text","Content": "'.$message.'"},';
  $ccRecepients = '"CcRecipients":[{"EmailAddress":{"Address":"dmukuna@gmail.com"}},{"EmailAddress":{"Address":"mkunadavy@gmail.com"}}]}}';
  $recipientHeader ='"ToRecipients": [{"EmailAddress": {"Address":"'.$to.'"}}],';

  $request = $messageHeader.$recipientHeader.$ccRecepients;

    $headers = array(
        "User-Agent:asset-track",
        "Authorization: Bearer ".$_SESSION["access_token"],
        "Accept: application/json",
        "Content-Type: application/json",
        "Content-Length: ". strlen($request)
    );

    $response = runCurl($_SESSION["api_url"], $request, $headers,$to);
    //ECHO $request;

    function runCurl($url, $post = null, $headers = null,$to) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $post == null ? 0 : 1);
        if($post != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if($headers != null) {
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if($http_code >= 400) {
            
            echo "Error executing request to Office365 api with error code=$http_code<br/><br/>\n\n";
            echo "<pre>"; print_r($response); echo "</pre>";
            die();
        }

        else if($http_code == 202){

            echo "Successfully assigned and an email has been send to ".$to;
            die();
        }

        else{
            echo "failure";
        }

        //return array("code" => $http_code, "response" => $response);
        
    }

?>
