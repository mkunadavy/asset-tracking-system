<?php
    session_start();
    require_once('oauth.php');
    $auth_code = $_GET['code'];

    $tokens = oAuthService::getTokenFromAuthCode($auth_code, 'http://localhost:81/assettrack/authorize.php');

    if ($tokens['access_token']) {

        $_SESSION['access_token'] = $tokens['access_token'];
        
        // Redirect back to home page
        header("Location: http://localhost:81/assettrack/");
      }
      else
      {
        echo "<p>ERROR: ".$tokens['error']."</p>";
      }
?>