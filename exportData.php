<?php
    require('oauth.php');

    if(!isset($_SESSION['user-admin'])){

      header("Location:http://localhost:81/assettrack/login.php");
    
    }

  // else{
  //   if(empty($_SESSION['access_token']) || !isset($_SESSION['access_token'])){
  //     $urlLogin = oAuthService::getLoginUrl('http://localhost:81/assettrack/authorize.php');
      
  //     header("Location: $urlLogin");
  //   }
  // }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EGPAFZIM Asset Tracker | Add Asset</title>
    <link rel="stylesheet" href="offline_docs/icon.css">
    <link rel="stylesheet" href="offline_docs/all.css">
    <link rel="stylesheet" href="offline_docs/bootstrap.min.css">
    <link rel="stylesheet" href="offline_docs/fontscss.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="offline_docs/mdb.min.css" />
    <script src="offline_docs/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

    <link href="css/addons/datatables.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/styleThree.css">

    <link rel="stylesheet" type="text/css" href="font-awesome/css/all.css">

    <style>

        a{
            color:#000;
            cursor:pointer;
        }

        a:hover{
            color:#777;
        }

        .nav-item{
            padding:0 37px;
        }

    </style>
</head>

<body>

  <div class="container-fluid">
      <div class="row">
          <!--Main-->
          <div class="col-12" id="topbar-wrapper">
              <div class="col-12" style="margin:0;padding:0;">
              <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="/assettrack/index.php">
                <img src="img/egpaf.png" height="60" class="d-inline-block align-top"
                  alt="mdb logo">
              </a>
                <h3 class="col icontext">Asset Management - Export Data</h3>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                  aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home<i class="fa fa-home"> </i></a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="./addAsset.php">Add <i class="fa fa-plus"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./assignAsset.php">Assign <i class="fa fa-sync"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#!">Export <i class="fa fa-file-download"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#!"><?php echo $_SESSION['user-admin'];?><i class="fa fa-caret-down"></i></a>
                  </li>
                </ul>
                
              </nav>
              </div>
              <div class="row">
                <div class="col-12" id="main-wrapper">
                <h2 class="text-center"><span id="view-title">Export</span> File</h2><hr>
                  <div class="col-12 flex-center" id="main-inside-wrapper-2">
                    <form id="formAssignCto" style="height:60vh;width:60%;"> 
                      <div class="form-group">
                          <label>Filter Options</label>
                          <select class="form-control" id="choice">
                              <option>All Assets</option>
                              <option>Specific Register</option>
                              <option>Specific User</option>
                              <option>Specific Category</option>
                              <option>Other (Include USB Flashes,Connectors etc.)</option>
                          </select>
                      </div>
                      
                      <div class="form-group  pickusr" style="display: none">
                          <label>Pick User</label>
                          <select class="form-control  users" name="file_user" id="user">
                              <option>Select User</option>
                          </select>
                      </div>

                      <div class="form-group pickcat" style="display: none">
                          <label>Pick Category</label>
                          <select class="form-control" name="file_category" id="cat">
                              <option>Select Category</option>
                              <option>Docking Station</option>
                              <option>Firewall</option>
                              <option>Laptop</option>
                              <option>Monitor</option>
                              <option>Printer</option>
                              <option>Projector</option>
                              <option>Recorder</option>
                              <option>Router</option>
                              <option>Scanner</option>
                              <option>Server</option>
                              <option>Switch</option>
                          </select>
                      </div>

                      <div class="form-group pickreg" style="display: none">
                          <label>Pick Register</label>
                          <select class="form-control" name="file_register" id="reg">
                              <option>Select Register</option>
                              <option>Catridge</option>
                              <option>Loan</option>
                          </select>
                      </div>

                      <div class="text-center">
                          <a id="printRedirect" href="./printData.php?datatype=All Assets&choice=All"><button type="button" class="btn btn-success btn-sm">Print</button></a>
                          <a href="./downloadData.php?for=All" id="downloadBtn"><button type="button" class="btn btn-primary btn-sm">Download</button></a>
                          <button type="button" class="btn btn-secondary btn-sm resetButton">Reset Form</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-12 text-center" style="height:10vh;">
                    <p>Copyrights Reserved @ 2018 By Daveson Mukuna</p>
                  </div>
                </div>
                  
              </div>
            </div>
              
        </div>
          <!--Main-->
      </div>
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- MDBootstrap Datatables  -->
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" charset="utf8" src="js/addons/datatables.js"></script>
  <script type="text/javascript">
    
    getEmployees();

    $("#printRedirect").click(function() { 
        $("form").trigger("reset");
        $(".pickusr").hide();
        $(".pickreg").hide();
        $(".pickcat").hide();
    })

    $("#downloadBtn").click(function() { 
        $("form").trigger("reset");
        $(".pickusr").hide();
        $(".pickreg").hide();
        $(".pickcat").hide();
    })

    $(".resetButton").click(function() {
        $("form").trigger("reset");
        $(".pickusr").hide();
        $(".pickreg").hide();
        $(".pickcat").hide();
    })
      
    $(".side-menu-items").click(function () { 
        $(".side-menu-items.active").attr("class","side-menu-items");
        $(this).attr("class","side-menu-items active");

        new_title = $(this).children("span").html();
        
        $("#view-title").html(new_title);
    });

    function getEmployees(){
      $.get("phpscripts/getAdditionalData.php?query=Employees",function(data,status){
        
        jsonData = JSON.parse(data);
        for(i in jsonData){
          $(".users").append("<option>" + jsonData[i].FirstName + " " + jsonData[i].Lastname + "</option>")
        }
        
      })
    }

    $("#choice").change(function () { 
        
        var choice = $(this).val();

        if(choice == "Specific User"){
            $(".pickusr").show();
            $(".pickcat").hide();
            $(".pickreg").hide();

        }

        else if(choice == "Specific Register"){
            $(".pickreg").show();
            $(".pickusr").hide();
            $(".pickcat").hide();
        }

        else if(choice == "Specific Category"){
            $(".pickusr").hide();
            $(".pickcat").show();
            $(".pickreg").hide();
        }

        else if(choice == "All Assets"){
            $(".pickusr").hide();
            $(".pickcat").hide();
            $(".pickreg").hide();
            $("#downloadBtn").attr("href","./downloadData.php?for=All");
            $("#printRedirect").attr("href","./printData.php?datatype=All Assets&choice=All");
        }

        else{
            $(".pickusr").hide();
            $(".pickcat").hide();
            $(".pickreg").hide();
            $("#downloadBtn").attr("href","./downloadData.php?for=Others");
            $("#printRedirect").attr("href","./printData.php?datatype=Others&choice=Others");
        }
     })

      $(".pickusr").change(function () { 
        var choice = $("#user").val();
        var datatype = $("#choice").val();
        $("#downloadBtn").attr("href","./downloadData.php?for=User&user="+choice);
        $("#printRedirect").attr("href","./printData.php?datatype="+datatype+"&choice=User"+"&user="+choice);
      });

      $(".pickreg").change(function () { 
        var choice = $("#reg").val();
        var datatype = $("#choice").val();
        $("#downloadBtn").attr("href","./downloadData.php?for="+choice);
        $("#printRedirect").attr("href","./printData.php?datatype="+datatype+"&choice="+choice);
      });

      $(".pickcat").change(function () { 
        var choice = $("#cat").val();
        var datatype = $("#choice").val();
        $("#downloadBtn").attr("href","./downloadData.php?for="+choice);
        $("#printRedirect").attr("href","./printData.php?datatype="+datatype+"&choice="+choice);
      });


  </script>
</body>

</html>
