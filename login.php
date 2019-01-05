<?php
  session_start();

  if(isset($_SESSION['user-admin']) || isset($_SESSION['user-normal'])){
    session_destroy();
  } 
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>EGPAF Asset Tracker | Log In</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=KoHo|Raleway" rel="stylesheet"> 
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
	
</head>

<body>
	<div class="container">
		<div class="row flex-center" style="height:90vh">
<form class="text-center border border-light p-5 myform" style="width:50%;background:#fff;opacity:.9;height:58vh">
	<img src="img/egpaf.png" style="width:300px">
    <h2 class="h2 mb-4">Sign Into ATS</h2>
    <!-- Email -->
    <input type="text" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Username" name="username">

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" name="password">

    <div id="error_notify"></div>

    <button class="btn btn-info btn-block my-4" type="button">Sign in</button>
	
	<small style="font-size:15px"><a href="./signup.php">Sign Up</a> | <a href="./reset.php">Reset Password</a> </small><br/>

	<small>Copyrights @ 2018</small>
</form>
<!-- Default form login -->
		</div>
	</div>
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="offline_docs/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>

  <script type="text/javascript">
  	$(document).ready(function() {

      $("#defaultLoginFormPassword").keyup(function() { 
        $("#error_notify").empty();
        $(".my-4").removeAttr("disabled","true");
      })

      $("#defaultLoginFormEmail").keyup(function() { 
        $("#error_notify").empty();
        $(".my-4").removeAttr("disabled","true");
      })

  		$(".my-4").click(function(){
        
        var data = $(".myform").serialize();

        $.post("verify.php",data,function(data,status){
          
          var jsonOBJ = JSON.parse(data);

          if(jsonOBJ[1].validation == "error"){
            $("#error_notify").append('<small id="validation_error" style="color:red;font-size:16px">Invalid Username or Password</small>');
            $(".my-4").attr("disabled","true");
          }

          else if(jsonOBJ[1].validation == "successful"){

            if(jsonOBJ[0].alevel == 1){
              window.location.replace("./");
            }

            else{
              window.location.replace("./assettrack/users.php");
            }
            
          }
        })
      })
  	})
  </script>

</body>

</html>
