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

        .btn{
            margin:25px;
            width:200px;
            height:40px;
            font-weight: 600;
        }

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

        .btn.btn-primary2{
          background-color: #f0a94e;
         }

         .btn.btn-secondary2{
          background-color: #dd3652;
         }

         body{
            font-weight: bold;
         }

    </style>
</head>

<body>
  <div class="container-fluid">
      <div class="row">
          <!--Main-->
          <div class="col-12" id="topbar-wrapper">
            <div class="col-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/assettrack/index.php">
                  <img src="img/egpaf.png" height="60" class="d-inline-block align-top"
                alt="mdb logo">
                </a>
                <h3 class="col icontext">Asset Management - Add Asset</h3>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                  aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <ul class="nav justify-content-end">
                  <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home <i class="fa fa-home"></i></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Add <i class="fa fa-plus"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./assignAsset.php">Assign <i class="fa fa-sync"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./exportData.php">Export <i class="fa fa-file-download"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#!"><?php echo $_SESSION['user-admin'];?><i class="fa fa-caret-down"></i></a>
                  </li>
                </ul>
              </nav>
            </div>

            <div class="row">
              <div class="col-1 text-center d-flex flex-column z-depth-3" id="sidebar-wrapper">
                <h4>Pick Type</h4>
                <div class="side-menu-items itpool active">
                  <i class="material-icons">devices_other</i>
                  <span>IT Devices</span>
                </div>
                
                <div class="side-menu-items cat">
                  <i class="material-icons">blur_on</i>
                  <span>Catridges</span>
                </div>

                <div class="side-menu-items for_loan">
                  <i class="material-icons">note_add</i>
                  <span>For Loaning</span>
                </div>
              </div>

              <div class="col-11" id="main-wrapper">
                <h2 class="text-center">Add to <span id="view-title">IT Devices</span></h2><hr>
                <div class="col-12 flex-center" id="main-inside-wrapper-2">
                  <form id="addITAsset">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">  
                            <label for="quantity">Asset Category</label>
                            <select class="form-control" id="add_category" name="category">
                              <option id="option-1">Select Category</option>
                              <option>Access Point</option>
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
                        </div>
                    
                        <div class="col-6">
                            <div class="form-group">
                              <label for="manufacturer">Manufacturer<span style="color:red;margin:10px">*</span></label>
                              <select class="form-control addit" id="manufacturer" name="manufacturer">
                                <option id="option-3">Select Manufacturer</option>
                                <option>Acer</option>
                                <option>Asus</option>
                                <option>Canon</option>
                                <option>Cisco</option>
                                <option>Dell</option>
                                <option>Lenovo</option>
                                <option>Linksys</option>
                                <option>HP</option>
                                <option>Huawei</option>
                                <option>Microsoft</option>
                                <option>None</option>
                              </select>
                            </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="laptopName">Device Name</label>
                            <input id="device_name" type="text" class="form-control addit" name="device_name" aria-describedby="emailHelp" placeholder="Enter Device Name">
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="quantity">AssetID</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="margin:0">ZIM -</span>
                              </div>
                              <input type="text" id="item_asset_id" name="asset_id" maxlength="5" class="form-control addit" placeholder="eg 67876">
                            </div>
                          </div>
                        </div>
                      
                        <div class="col-12" id="serialno-wrapper">
                          <div class="form-group">
                            <label for="serialNum">Serial Number<span style="color:red;margin:10px">*</span></label>
                            <input type="text" class="form-control addit" id="serialno" name="serial_num" placeholder="eg SER23BSH">
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                              <label for="condition">Condition</label>
                              <select class="form-control addit" name="condition" id="item_condition">
                                <option>Select Condition</option>
                              </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                              <label for="serialNum">Donor<span style="color:red;margin:10px">*</span></label>
                              <select class="form-control addit" name="donor" id="donor">
                                <option>Select Donor</option>
                              </select>
                            </div>
                        </div>
                      </div>

                      <small style="font-weight:600;color:red;margin:0">* Insert Where Neccessary</small>

                      <div class="text-center">
                          <button type="button" class="btn btn-primary2 addit btn-sm" id="submitAsset">Add Asset</button>
                          <button type="button" class="btn btn-secondary2 btn-sm resetButton">Reset Form</button>
                      </div>
                  </form>

                  <form id="addCat" style="width:80%">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="vendor">Vendor</label>
                            <select class="form-control" name="vendor">
                              <option id="option-3">Select Vendor</option>
                              <option>HP</option>
                              <option>Ricoh</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="cat_type">
                              <option id="option-4">Select Type</option>
                              <option>22</option>
                              <option>05A</option>
                              <option>126A</option>  
                              <option>128A</option>
                              <option>201A</option>
                              <option>650A</option>
                              <option>940</option>
                              <option>940XL</option>
                              <option id="ricoh">MP2501</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-8">
                          <div class="form-group">
                            <label for="color">Color</label>
                            <select class="form-control" name="color" >
                              <option>Select Color</option>
                              <option id="black">Black</option>
                              <option>Cyan</option>
                              <option>Magenta</option>
                              <option>Yellow</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-4">
                          <div class="form-group">
                              <label for="quantity">Quantity</label>
                              <input type="text" class="form-control" name="quantity" placeholder="Enter Quantity">
                          </div>
                        </div>
                      </div>

                      <div class="text-center">
                          <button type="button" class="btn btn-primary2 btn-sm" id="submitCat">Add Catridge</button>
                          <button type="button" class="btn btn-secondary2 btn-sm resetButton">Reset Form</button>
                      </div>
                  </form>

                  <form id="addLoan" style="height:70vh;width:80%;padding-top:20px;display:none">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="loan_choice">Choose Entry Type</label>
                          <select id="loan_choice" class="form-control">
                            <option>New Entry To Loan</option>
                            <option>Pick from IT Devices</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-6 loan_item">
                        <div class="form-group">
                          <label for="loan_item">Enter Item Name</label>
                          <input class="form-control" type="text" name="loan_item">
                        </div>
                      </div>

                      <div class="col-6 loan_device" style="display:none">
                        <div class="form-group">
                          <label for="loan_pick">Pick Device</label>
                          <select id="loan_pick" class="form-control" name="loan_pick">
                            <option>Select Device</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <label for="loan_description">Item Quantity</label>
                        <input type="number" name="loan_quantity" class="form-control" id="loan_quantity">
                      </div>  
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary2 btn-sm" id="submitLoan">Add Item</button>
                        <button type="button" class="btn btn-secondary2 btn-sm resetButton">Reset Form</button>
                    </div>
                  </form>
                </div>
                <div class="col-12 text-center" style="height:10vh;">
                 <p>Copyrights Reserved @ 2018 By Daveson Mukuna</p>
                </div>
            </div>
            </div>
          </div>
          <!--Main-->
      </div>
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

    getDevice("Projector","shorter");

      function getDevice(device,period){

      $.get("phpscripts/getDevices.php",{'for':device,'period':period},function(data,status){
        
        jsonData = JSON.parse(data);

        $("#loan_pick").empty();
        $("#loan_pick").append("<option>Select Device</option>");

        for(i in jsonData){
          $("#loan_pick").append("<option>" + jsonData[i].details + "</option>");
        }
          
      });

    }

    $("#loan_choice").change(function(){

      var choice = $("#loan_choice").val();

      if(choice == "New Entry To Loan"){
        $(".loan_item").show();
        $(".loan_device").hide();
        $("#loan_quantity").val("");
        $("#loan_quantity").removeAttr('disabled');
      }

      else{
        $(".loan_item").hide();
        $(".loan_device").show();
        $("#loan_quantity").val("1");
        $("#loan_quantity").attr('disabled','true');
      }
    })

        $(".itpool").click(function() { 
            $("#addITAsset").show();
            $("#addCat").hide();
            $("#addLoan").hide();
         })

        $(".cat").click(function() { 
          $("#addITAsset").hide();
          $("#addLoan").hide();
          $("#addCat").show();
        })

        $(".for_loan").click(function() { 
          $("#addITAsset").hide();
          $("#addCat").hide();
          $("#addLoan").show();
        })


      $(document).ready(function () {
          var new_title = 'All';

        $('#reload').click(function() {
            fetchData(new_title);
        });

        $('#menu-header-1').click(function() {
            $("#menu-item-1").toggle();
            if($("#arrow-1").attr("class") == 'fa fa-angle-down'){
              $("#arrow-1").attr("class","fa fa-angle-up");
            }
            
            else{
              $("#arrow-1").attr("class","fa fa-angle-down");
            }
        });

        $('#menu-header-2').click(function() {
            $("#menu-item-2").toggle();
            if($("#arrow-2").attr("class") == 'fa fa-angle-down'){
              $("#arrow-2").attr("class","fa fa-angle-up");
            }
            
            else{
              $("#arrow-2").attr("class","fa fa-angle-down");
            }
        });

        $('#menu-header-3').click(function() {
            $("#menu-item-3").toggle();
            if($("#arrow-3").attr("class") == 'fa fa-angle-down'){
              $("#arrow-3").attr("class","fa fa-angle-up");
            }
            
            else{
              $("#arrow-3").attr("class","fa fa-angle-down");
            }
        });

        $(".side-menu-items").click(function(){
              $(".side-menu-items.active").attr("class","side-menu-items");
              $(this).attr("class","side-menu-items active");

              var new_icon = $(this).children("i.material-icons").html();
              new_title = $(this).children("span").html();

              $("#view_icon").html(new_icon);
              $("#view-title").html(new_title);

              if(new_title == "Catridges"){
                var newString = new_title.replace("s","");
                fetchCatridge(newString);
              }

              else if (new_title == "All Assets"){
                  fetchDataAll();
              }

              else if(new_title == "Available"){
                fetchAvailableLoan();
              }

              else if(new_title == "Catridge"){
                fetchCatridgeFor();
              }

              else if(new_title == "Loaning"){
                fetchLoanedOut();
              }

              else if(new_title == "Others"){
                fetchData(new_title);
              }

              else{
                var newString = new_title.replace("s","");
                fetchData(newString);
              }
              
        });

        fetchDataAll();

      });

      $(".resetButton").click(function () { 
       $("form").trigger("reset");
       })

      function fetchCatridge(d){

          $.get("phpscripts/getTableData.php",{'for':d},function(data,status){

              $("#dataTable").hide();
              $("#dataTable2").show();
              $("#dataTable3").hide();
              $("#dataTable4").hide();
              $("#dataTable5").hide();
              $("#dataTable6").hide();


              $('#dataTable').DataTable().destroy();
              $('#dataTable2').DataTable().destroy();
              $('#dataTable3').DataTable().destroy();
              $('#dataTable4').DataTable().destroy();
              $('#dataTable5').DataTable().destroy();
              $("#dataTable6").DataTable().destroy();

              var jsonResponse = JSON.parse(data);
              
              $('#dataTable2').DataTable( {
                  
                  data: jsonResponse,

                  columns: [
                      { data: 'catridge',width:'33.3333%'},
                      { data: 'color',width:'33.3333%'},
                      { data: 'quantinty',width:'33.3333%'}
                  ],
                  buttons:[
                      'pdf',
                  ],
                  bAutoWidth:false,
                  "scrollY": "64vh",
                  "scrollCollapse": true,
              } );
          });
      }

      function fetchDataAll(){
          
          $.get("phpscripts/getTableData.php",{'for':'All'},function(data,status){
              
            $("#dataTable").show();
            $("#dataTable2").hide();
            $("#dataTable3").hide();
            $("#dataTable4").hide();
            $("#dataTable5").hide();
            $("#dataTable6").hide();

            $('#dataTable').DataTable().destroy();
            $('#dataTable2').DataTable().destroy();
            $('#dataTable3').DataTable().destroy();
            $('#dataTable4').DataTable().destroy();
            $('#dataTable5').DataTable().destroy();
            $("#dataTable6").DataTable().destroy();

              var jsonResponse = JSON.parse(data);
              
              $('#dataTable').DataTable( {
                  
                  data: jsonResponse,

                  columns: [
                      { data: 'device',width:'20%'},
                      { data: 'category',width:'20%'},
                      { data: 'barcode' ,width:'20%'},
                      { data: 'serialnumber',width:'20%'},
                      { data: 'assigned_to',
                        width:'20%',
                        render: function ( data, type, row, meta ) { 
                          if(data == null){
                            return '-';
                          }

                          else{
                            return data;
                          }
                        }
                      }
                  ],
                  buttons:[
                      'pdf',
                  ],
                  bAutoWidth:false,
                  "scrollY": "64vh",
                  "scrollCollapse": true,
              } );
          });
      }

      function fetchData(data){
          
          $.get("phpscripts/getTableData.php",{'for':data},function(data,status){
              
            $("#dataTable").hide();
            $("#dataTable2").hide();
            $("#dataTable3").show();
            $("#dataTable4").hide();
            $("#dataTable5").hide();
            $("#dataTable6").hide();

            $('#dataTable').DataTable().destroy();
            $('#dataTable2').DataTable().destroy();
            $('#dataTable3').DataTable().destroy();
            $('#dataTable4').DataTable().destroy();
            $('#dataTable5').DataTable().destroy();
            $("#dataTable6").DataTable().destroy();

              var jsonResponse = JSON.parse(data);
              
              $('#dataTable3').DataTable( {
                  
                  data: jsonResponse,

                  columns: [
                      { data: 'device',width:'25%'},
                      { data: 'barcode' ,width:'25%'},
                      { data: 'serialnumber',width:'25%' },
                      { data: 'assigned_to',
                        width:'25%',
                        render: function ( data, type, row, meta ) { 
                          if(data == null){
                            return '-';
                          }

                          else{
                            return data;
                          }
                        }
                      },
                  ],
                  buttons:[
                      'pdf',
                  ],
                  bAutoWidth:false,
                  "scrollY": "64vh",
                  "scrollCollapse": true,
              } );
          });
      }

      function fetchLoanedOut(){
        
        $.get("phpscripts/getITPool.php",{'option':'loan'},function(data,status){

          $("#dataTable").hide();
          $("#dataTable2").hide();
          $("#dataTable3").hide();
          $("#dataTable4").hide();
          $("#dataTable5").show();
          $("#dataTable6").hide();

          $('#dataTable').DataTable().destroy();
          $('#dataTable2').DataTable().destroy();
          $('#dataTable3').DataTable().destroy();
          $('#dataTable4').DataTable().destroy();
          $('#dataTable5').DataTable().destroy();
          $("#dataTable6").DataTable().destroy();

            var jsonResponse = JSON.parse(data);
            
            $('#dataTable5').DataTable( {
                
                data: jsonResponse,

                columns: [
                    { data: 'username' ,width:'25%'},
                    { data: 'item' ,width:'25%'},
                    {data : 'status',
                        width:'25%',
                        render: function (data,type,row,meta) { 
                            if(data==null){
                                return "-";
                            }

                            else{
                                return data;
                            }
                         }
                    },
                    { data: 'date_loaned',
                        width:'25%',
                        render: function ( data, type, row, meta ) { 
                          var d = new Date(data['date']);
                          var minutes;

                          if(d.getMinutes() < 10){
                            minutes = "0"+ d.getMinutes();
                          }

                          else{
                            minutes = d.getMinutes();
                          }

                          return d.toDateString() + " , " + d.getHours() + ":" + minutes;
                        }
                    }
                ],
                buttons:[
                    'pdf',
                ],
                bAutoWidth:false,
                "scrollY": "67vh",
                "scrollCollapse": true,
            } );
        });
      }

      function fetchCatridgeFor(){
        $.get("phpscripts/getITPool.php",{'option':'catridge'},function(data,status){

          $("#dataTable").hide();
          $("#dataTable2").hide();
          $("#dataTable3").hide();
          $("#dataTable4").show();
          $("#dataTable5").hide();
          $("#dataTable6").hide();

          $('#dataTable').DataTable().destroy();
          $('#dataTable2').DataTable().destroy();
          $('#dataTable3').DataTable().destroy();
          $('#dataTable4').DataTable().destroy();
          $('#dataTable5').DataTable().destroy();
          $("#dataTable6").DataTable().destroy();

            var jsonResponse = JSON.parse(data);
            
            $('#dataTable4').DataTable( {
                
                data: jsonResponse,

                columns: [
                  { data: 'name' ,width:'33.333%'},
                  { data: 'catridge_name' ,width:'33.333%'},
                  { data: 'date_given',
                      width:'33.333%',
                      render: function ( data, type, row, meta ) { 
                        
                        var d = new Date(data['date']);
                        var minutes;

                        if(d.getMinutes() < 10){
                          minutes = "0"+ d.getMinutes();
                        }

                        else{
                          minutes = d.getMinutes();
                        }

                        return d.toDateString() + " , " + d.getHours() + ":" + minutes;
                      }
                  },
                ],
                buttons:[
                    'pdf',
                ],
                bAutoWidth:false,
                "scrollY": "67vh",
                "scrollCollapse": true,
            } );
        });
      }

      function fetchAvailableLoan(){

          $.get("phpscripts/getITPool.php",{'option':'available'},function(data,status){

              $('#dataTable6').show();
              $('#dataTable').hide();
              $('#dataTable2').hide();
              $('#dataTable3').hide();
              $('#dataTable4').hide();
              $('#dataTable5').hide();

              $('#dataTable').DataTable().destroy();
              $('#dataTable3').DataTable().destroy();
              $('#dataTable2').DataTable().destroy();
              $('#dataTable4').DataTable().destroy();
              $('#dataTable5').DataTable().destroy();
              $("#dataTable6").DataTable().destroy();

              var jsonResponse = JSON.parse(data);
              
              $('#dataTable6').DataTable( {
                  
                  data: jsonResponse,

                  columns: [
                      { data: 'name' ,width:'25%'},
                      { data: 'barcode',
                          width:'25%',
                          render: function ( data, type, row, meta ) { 
                              if(data == ''){
                                  return "-";
                              }

                              else{
                                  return data;
                              }
                          }
                      },
                      { data: 'serialnumber' ,
                          width:'25%',
                          render: function ( data, type, row, meta ) { 
                              console.log(data);
                              if(data == ''){
                                  return "-";
                              }

                              else{
                                  return data;
                              }
                          }
                      },

                      {data:'quantity',width:'25%'},
                  ],
                  buttons:[
                      'pdf',
                  ],
                  bAutoWidth:false,
                  "scrollY": "67vh",
                  "scrollCollapse": true,
              } );
          });
      }

      $("#dataTable tbody").on('click','tr',function() { 

        $("#addITAssetModal").modal("show");

        $(".addit").prop('disabled',false);

        var mydata = $("#dataTable").DataTable().row(this).data();

        $("#add_category").val(mydata['category']);
        $("#device_name").val(mydata['device'].replace(mydata['manufacturer'],'').replace('&quot;','"').trim());
        $("#item_asset_id").val(mydata['barcode'].replace("ZIM-",''));
        $("#serialno").val(mydata['serialnumber']);
        $("#item_condition").val(mydata['condition']);
        $("#donor").val(mydata['donorid']);
        $("#manufacturer").val(mydata['manufacturer']);

       })

      $("#dataTable3 tbody").on('click','tr',function() { 

        var mydata = $("#dataTable3").DataTable().row(this).data();

        console.log(mydata['barcode']); 
        })

      $("#assign_from_cat").change(function(){
          $("#assign_from_device").empty();

          $("#assign_from_device").append("<option>Select Device</option>");

          if($(this).val() == 'IT Pool'){
              $.get("phpscripts/getFrom.php",{user:$("#assign_from_user").val(),for:'itpool'},function(data,status){
                  var jsonData = JSON.parse(data);

                  for(i in jsonData){
                      $("#assign_from_device").append("<option>" + jsonData[i].details + "</option>");
                    }
              })
          }

          if($(this).val() == 'Asset Register'){
              $.get("phpscripts/getFrom.php",{user:$("#assign_from_user").val(),for:'assetregister'},function(data,status){
                  var jsonData = JSON.parse(data);

                  for(i in jsonData){
                      $("#assign_from_device").append("<option>" + jsonData[i].details + "</option>");
                    }
              })
          }
      })

      $("#submitAsset").click(function(){
        var data = $("#addITAsset").serialize() + '&' + $.param({'for':'any'});
        $.post('phpscripts/add.php',data,function(data,status){
          
          if(data.trim() == 'success'){
            document.getElementById("addITAsset").reset();
            alert("Successfully Added");
          }

          else{
            alert("Failed To Add");
          }
        })
      });

      $("#submitCat").click(function(){

      var data = $("#addCat").serialize() + '&' + $.param({'for':'cat'});
      
          $.post('phpscripts/add.php',data,function(data,status){

              if(data == 'success_insert' || data == 'success_update'){
                  fetchCatridge("Catridge");
                  $("#addCat").trigger('reset');
                  $("#addCatridge").modal('hide');
                  alert("Successfully Added");
              }

              else{
                  alert("Failed To Add");
              }

          })
      });

      $("#submitLoan").click(function(){
        
        var data = "";

        if($("#loan_choice").val() == "New Entry To Loan"){
          data = $("#addLoan").serialize() + '&' + $.param({'for':'itpool'});
        }

        else{
          data = {'loan_item':$("#loan_pick").val().split("/")[0],'for':'itpool','loan_quantity': $('#loan_quantity').val(),'serialnum':$("#loan_pick").val().split("/")[2],'assetid':$("#loan_pick").val().split("/")[1]};
        }
      
          $.post('phpscripts/add.php',data,function(data,status){

              if(data == 'success'){
                  $("#addLoan").trigger('reset');
                  getDevice("Projector","shorter");
                  alert("Successfully Added");
              }

              else{
                  alert(data);
              }

          })
      });

      $("#assign_to").click(function(){

        var choice = $("#assign_to_cat").val();

        if(choice.length < 12){
          if(choice == "Catridge"){

            $.post("phpscripts/assign_cat.php",
              {
                username:$("#assign_to_user").val(),
                color:$("#assign_to_color").val(),
                type:$("#assign_to_cat_type").val(),

              },function(data,status){
                  alert(data);
                  $("#formAssignCto").trigger("reset");
                  $("#assignTo").modal("hide");
            });
          }

          else if(choice == 'IT Pool'){
              var data = {
                  for:'itpool',
                  username:$("#assign_to_user").val(),
                  device:$("#assign_to_device").val()
              }

              $.post("phpscripts/assign.php",data,function(data,status){
                  $("#formAssignCto").trigger("reset");
                  $("#assignTo").modal("hide");
                  alert(data);

            });
          }

          else{
            var data = {
              username:$("#assign_to_user").val(),
              assetid:$("#assign_to_device").val().split("/")[1],
            };

            $.post("phpscripts/assign.php",data,function(data,status){
              alert(data);
              $("#formAssignCto").trigger("reset");
              $("#assignTo").modal("hide");
            });
          }
        }
      })

      $("#assign_to_cat").change(function(){
        
        choice = $(this).val();

        if(choice == "Catridge"){
          $(".cat").show();
          $(".cat_color").show();
          $(".device").hide();
        }

        else{
          $(".cat").hide();
          $(".cat_color").hide();
          $(".device").show();

          if(choice == 'IT Pool'){
              getDevice(choice,'short');
          }

          else{
              getDevice(choice,'long');
          }

        }
      })

      

    function getEmployees(){
      $.get("phpscripts/getAdditionalData.php?query=Employees",function(data,status){
        
        jsonData = JSON.parse(data);
        for(i in jsonData){
          $(".users").append("<option>" + jsonData[i].FirstName + " " + jsonData[i].Lastname + "</option>")
        }
        
      })
    }

    function getDonors(){
      $.get("phpscripts/getAdditionalData.php?query=Donors",function(data,status){
        
        jsonData = JSON.parse(data);

        for(i in jsonData){
          $("#donor").append("<option>" + jsonData[i].DonorName + "</option>");
        }

      })
    }

    function getConditions(){
      $.get("phpscripts/getAdditionalData.php?query=Conditions",function(data,status){
        jsonData = JSON.parse(data);
        for(i in jsonData){
          $("#item_condition").append("<option>" + jsonData[i].Condition + "</option>");
        }
        
      })
    }

    getConditions();
    getDonors();
    getEmployees();
  
  $("#device_name").keyup(function(){

          if($("#device_name").val() == ''){
              $("#suggestions").hide();
          }

          else{
              //get category value...
              $.post("phpscripts/suggestions.php",
                  {   
                      category:$("#add_category").val(),
                      search:$("#device_name").val()
                  },
                  function(data,status){
                      var jsonData = JSON.parse(data);
                  
                      if(jsonData.length > 0){
                          $("#suggestions").show(); 

                          $("#suggestions").empty();

                          for(i in jsonData){
                              $("#suggestions").append('<p style="padding:5px;width:100%;cursor:pointer" class="result">'+ jsonData[i].result +'</p><hr>');
                          }
                      }

                      else{
                          $("#suggestions").hide();
                      }

                  });
          }
  });

      $("body").on('click','.result',function(){
          var value = $(this).html();
          $("#device_name").val(value);
          $("#suggestions").hide();
      });

      $(".addit").prop('disabled', true);

      $("#add_category").change(function(){
          if($(this).val() != 'Select Category'){
              $(".addit").prop('disabled',false);
          }

          else{
              $(".addit").prop('disabled', true); 
          }
      })

      $(".additpool").keyup(function(){
          if($(this).val() != ''){
              $("#pool_quantity").val(1);
              $("#pool_quantity").prop('disabled', true);
          }

          else{
              $("#pool_quantity").val('');
              $("#pool_quantity").prop('disabled', false);
          }
      })


      $("#submitFromAsset").click(function(){
          var table = '';
          var choice = $("#assign_from_cat").val();
          var data;

          if(choice == 'IT Pool'){
              table = 'itpool';
              data = $("#formAssignFrom").serialize() + '&' + $.param({'for':table});
          }

          else if(choice == 'Asset Register'){
              table = 'assetregister';
                data = {
                  'for':table,
                  assign_from_user:$("#assign_from_user").val(),
                  assign_from_device:$("#assign_from_device").val().split("/")[1],
              };
          }

          $.post("phpscripts/assignFrom.php",data,function(data,status){
              alert(data);
              $("#formAssignFrom").trigger("reset");
              $("#assignFrom").modal("hide");
          })
      })

  </script>
</body>

</html>
