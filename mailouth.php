<?php
  session_start();
  require('oauth.php');
  
  $loggedIn = !is_null($_SESSION['access_token']);
?>

<html>
  <head>
    <title>PHP Mail API Tutorial</title>
  </head>
  <body>
    <?php 
      if (!$loggedIn) {
    ?>
      <!-- User not logged in, prompt for login -->
      <p>Please <a href="<?php echo oAuthService::getLoginUrl('http://localhost:81/assettrack/authorize.php')?>">sign in</a> with your Office 365 account.</p>
    <?php
      }
      else {
    ?>
      <!-- User is logged in, do something here -->
      <p>Access token: <?php echo $_SESSION['access_token'] ?></p>
    <?php
        header("Location:http://localhost:81/assettrack/homemail.php");    
      }
    ?>
  </body>
</html>