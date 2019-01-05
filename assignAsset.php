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
              <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                  <a class="navbar-brand" href="/assettrack/index.php">
                    <img src="img/egpaf.png" height="60" class="d-inline-block align-top"
                      alt="mdb logo">
                  </a>
                    <h3 class="col icontext">Asset Management - Assign Asset</h3>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                      aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>

                    <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home <i class="fa fa-home"></i></a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="./addAsset.php">Add <i class="fa fa-plus"></i></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="./assignAsset.php">Assign <i class="fa fa-sync"></i></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="./exportData.php">Export <i class="fa fa-file-download"></i></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#!"><?php echo $_SESSION['user-admin']; ?><i class="fa fa-caret-down"></i></a>
                      </li>
                    </ul>
                  </nav>
              </div>

              <div class="row">
                <div class="col-1 text-center d-flex flex-column z-depth-3" id="sidebar-wrapper">
                  <h4>IT Devices</h4>

                  <div class="side-menu-items to-multiple">
                    <i class="fa fa-home"></i>
                    <span>To User</span>
                  </div>
                  
                  <div class="side-menu-items from-multiple">
                    <i class="material-icons">indeterminate_check_box</i>
                    <span>From User</span>
                  </div>

                  <h4 style="margin-top:30px">IT Loan</h4>

                  <div class="side-menu-items to">
                    <i class="material-icons">person_add</i>
                    <span>To User</span>
                  </div>
                  
                  <div class="side-menu-items from">
                    <i class="material-icons">indeterminate_check_box</i>
                    <span>From User</span>
                  </div>
                  
                </div>

                <div class="col-11" id="main-wrapper">
                  <h2 class="text-center">Assign <span id="view-title"> To User</span></h2><hr>
                  <div class="col-12 flex-center" id="main-inside-wrapper-2">
                  
                    <form id="formAssignCto" style="height:70vh;width:80%;display: none">  
                      <div class="form-group">
                        <label for="color">Assign To</label>
                        <select class="form-control users" id="assign_to_user" name="assign_to_user">
                          <option>Select User</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="vendor">Category</label>
                        <select class="form-control" id="assign_to_cat" name="assign_to_cat">
                          <option>Select Category</option>
                          <option>Catridge</option>
                          <option>Laptop</option>
                          <option>Printer</option>
                          <option>Monitor</option>
                          <option>IT Pool</option>
                        </select>
                      </div>
                      
                      <div class="form-group cat" style="display:none">
                        <label for="type">Catridge Type</label>
                        <select class="form-control" id="assign_to_cat_type" name="assign_to_cat_type">
                        <option id="option-4">Select Catridge Type</option>
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

                      <div class="form-group cat" style="display:none">
                        <label for="color">Color</label>
                        <select class="form-control" id="assign_to_color" name="assign_to_color">
                            <option>Select Color</option>
                            <option id="black">Black</option>
                            <option>Cyan</option>
                            <option>Magenta</option>
                            <option>Yellow</option>
                        </select>
                      </div>

                      <div class="form-group device">
                        <label for="color">Device</label>
                        <select class="form-control" id="assign_to_device" name="assign_to_device">
                            <option>Select Device</option>
                        </select>
                      </div>

                      <div class="text-center">
                          <button type="button" class="btn btn-primary btn-sm" id="assign_to">Submit Request</button>
                          <button type="button" class="btn btn-secondary btn-sm resetButton">Reset Form</button>
                      </div>  
                    </form>

                    <form id="formAssignFrom" style="height:70vh;width:80%;display:none">
                      <div class="form-group">
                        <label for="color">Assign From</label>
                        <select class="form-control users" name="assign_from_user" id="assign_from_user">
                          <option>Select User</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="color">Category</label>
                        <select class="form-control" name="assign_from_cat" id="assign_from_cat" >
                          <option>Select Category</option>
                          <option>Asset Register</option>
                          <option>IT Pool</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="color">Device</label>
                        <select class="form-control" name="assign_from_device" id="assign_from_device" >
                          <option>Select Device</option>
                        </select>
                      </div>
                    
                      <div class="text-center">
                        <button type="button" class="btn btn-primary btn-sm" id="submitFromAsset">Submit Request</button>
                        <button type="button" class="btn btn-secondary btn-sm resetButton">Reset Form</button>
                      </div>

                    </form>

                    <form id="formAssignToMultiple" style="height:70vh;width:80%;">
                      <div class="form-group">
                        <label for="color">Assign To</label>
                        <select class="form-control users" name="assign_to_multiple" id="assign_to_multiple">
                          <option>Select User</option>
                        </select>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="color">Laptop</label>
                            <select class="form-control" name="laptop_to" id="laptop_to" >
                              <option>Select Laptop</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="color">Printer</label>
                            <select class="form-control" name="printer_to" id="printer_to" >
                              <option>Select Printer</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="color">Monitor</label>
                            <select class="form-control" name="monitor_to" id="monitor_to" >
                              <option>Select Monitor</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <label for="color">Docking Station</label>
                            <select class="form-control" name="docking_station_to" id="docking_station_to" >
                              <option>Select Docking Station</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="color">Scanner</label>
                            <select class="form-control" name="scanner_to" id="scanner_to" >
                              <option>Select Scanner</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row text-center" style="margin-top:10px">
                        <div class="col-2">
                          <div class="form-group">
                            <label>Backpack</label>
                            <input type="checkbox" name="backpack" style="margin: 0 20px;">
                          </div>
                        </div>

                        <div class="col-2">
                          <div class="form-group">
                            <label>Lock</label>
                            <input type="checkbox" name="lock" style="margin: 0 20px;">
                          </div>
                        </div>

                        <div class="col-2">
                          <div class="form-group">
                            <label>Mouse</label>
                            <input type="checkbox" name="mouse" style="margin: 0 20px;">
                          </div>
                        </div>

                        <div class="col-2">
                          <div class="form-group">
                            <label>Keyboard</label>
                            <input type="checkbox" name="keyboard" style="margin: 0 20px;">
                          </div>
                        </div>

                        <div class="col-2">
                          <div class="form-group">
                            <label>Dongle</label>
                            <input type="checkbox" name="dongle" style="margin: 0 20px;">
                          </div>
                        </div>

                        <div class="col-2">
                          <div class="form-group">
                            <label>Flash Drive</label>
                            <input type="checkbox" name="usb_drive" style="margin: 0 20px;">
                          </div>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="button" class="btn btn-primary btn-sm" id="submitToMultiple">Submit Request</button>
                        <button type="button" class="btn btn-secondary btn-sm resetButton">Reset Form</button>
                      </div>

                    </form>

                    <form id="formAssignFromMultiple" style="height:70vh;width:80%;display:none">
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="color">Assign From</label>
                            <select class="form-control users" name="assign_from_multiple" id="assign_from_multiple">
                              <option>Select User</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div id="table_data" style="height:45vh;padding:0 15px;display:none">
                        <table id="dataTable7" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%">
                          <thead class="black white-text">
                          <tr class="col-12" id="thead">
                              <th scope="col">Device Name
                              </th>
                              
                              <th scope="col">AssetID
                              </th>

                              <th scope="col">Serial Number
                              </th>

                              <th scope="col">Category
                              </th>

                              <th scope="col">Mark</th>
                          </tr>
                          </thead>
                          <tbody id="tbody7">
                          
                          </tbody>
                      </table>
                    </div>
                    <div class="text-center">
                      <button class="btn btn-secondary btn-sm" type="button" id="submitMultiple">Submit</button>
                      <button class="btn btn-warning btn-sm" type="button" id="resetButton">Reset</button>
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
    resetForms();
    
    function resetForms(){
      $("#formAssignCto").trigger("reset");
      $("#formAssignToMultiple").trigger("reset");
      $("#formAssignFrom").trigger("reset");
      $("#formAssignFromMultiple").trigger("reset");

      getDeviceMultiple("Laptop","long","laptop_to");
      getDeviceMultiple("Monitor","long","monitor_to");
      getDeviceMultiple("Printer","long","printer_to");
      getDeviceMultiple("Scanner","long","scanner_to");
      getDeviceMultiple("Docking Station","long","docking_station_to");

    }

    $("#submitToMultiple").click(function(){
        var data = $("#formAssignToMultiple").serialize() + "&" + $.param({"for":$("#assign_to_multiple").val()}) + "&" + $.param({"enter":"multiple"});

        $.post("phpscripts/testMultiple.php",data,function(data,status){
          resetForms();
        })
    })

    var dataString = [];

    $("#assign_from_multiple").change(function(){
        $("#dataTable7").DataTable().destroy();
        $("#table_data").show();
        fetchDataFor($("#assign_from_multiple").val());
        dataString = [];
    })

        function fetchDataFor(u){
    
          $.get("phpscripts/getPrintData.php",{'for':'User','user':u},function(data,status){

              $("#dataTable").hide();
              $("#dataTable7").show();
              $("#dataTable3").hide();
              $("#dataTable4").hide();
              $("#dataTable5").hide();
              $("#dataTable6").hide();
              $("#dataTable2").hide();
              $("#dataTable7").DataTable().destroy();

              var jsonOBJ = JSON.parse(data);

              $("tbody").empty();

              for(i = 0;i < jsonOBJ.length;i++){

                  $("#tbody7").append("<tr><td>"+ jsonOBJ[i].device + "</td>" + "<td>"+jsonOBJ[i].barcode + "</td>"  + "<td>"+jsonOBJ[i].serialnumber + "</td>"  + "<td>"+jsonOBJ[i].category + "</td><td><input type='checkbox' class='assets' value='"+jsonOBJ[i].barcode+"'></td></tr>");
              }

              $('#dataTable7').DataTable({
                "scrollY":"20vh",
                "scrollCollapse": true,
                "search":false,
              })
              
          });
      }


      $("#dataTable7 tbody").on('click','tr',function(){

        var checkedState = $(this).children("input").prevObject[0].childNodes[4].childNodes[0].checked;

        if($(this).children("input").prevObject[0].childNodes[4].childNodes[0].checked == false){

          $(this).children("input").prevObject[0].childNodes[4].childNodes[0].checked = true;
          dataString.push($(this).children("input").prevObject[0].childNodes[1].innerHTML);
        
        }

        else{

          $(this).children("input").prevObject[0].childNodes[4].childNodes[0].checked = false;
          var indexOf = dataString.indexOf($(this).children("input").prevObject[0].childNodes[1].innerHTML);
          delete dataString[indexOf];
          dataString.sort();
          dataString.pop();
        }

      });


      $("#submitMultiple").click(function(){
          $.post("phpscripts/testMultiple.php",
              {
                "for":$("#assign_from_multiple").val(),
                "data":dataString
              },

              function(data,status){
                fetchDataFor($("#assign_from_multiple").val());
              }
              
            )
      })

        $(".to").click(function() { 
            $("#formAssignCto").show();
            $("#formAssignFrom").hide();
            $("#formAssignToMultiple").hide();
            $("#formAssignFromMultiple").hide();
            resetForms();
         })

        $(".from").click(function() { 
          resetForms();
          $("#formAssignFrom").show();
          $("#formAssignCto").hide();
          $("#formAssignToMultiple").hide();
          $("#formAssignFromMultiple").hide();
        })

        $('.from-multiple').click(function(){
            $("#formAssignCto").hide();
            $("#formAssignFrom").hide();
            $("#formAssignFromMultiple").show();
            $("#formAssignToMultiple").hide();
            resetForms();
        })

        $('.to-multiple').click(function(){
          resetForms();
          $("#formAssignCto").hide();
          $("#formAssignFrom").hide();
          $("#formAssignToMultiple").show();
          $("#formAssignFromMultiple").hide();
          
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
            if(data == "success"){
              document.getElementById("#addITAsset").reset();
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

      $("#submitITPool").click(function(){

      var data = $("#addtoITPool").serialize() + '&' + $.param({'for':'itpool'}) + '&' + $.param({'quantity': $('#pool_quantity').val()});
      
          $.post('phpscripts/add.php',data,function(data,status){

              if(data == 'success'){
                  $("#addtoITPool").trigger('reset');
                  $("#addITPool").modal('hide');
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

      function getDeviceMultiple(device,period,id){
        var id = "#" + id;

        $.get("phpscripts/getDevices.php",{'for':device,'period':period},function(data,status){
          
          jsonData = JSON.parse(data);

          $(id).empty();
          $(id).append('<option>Select '+device+'</option>');

          for(i in jsonData){
            $(id).append("<option>" + jsonData[i].details + "</option>");
          }
            
        });

      }

      function getDevice(device,period){

      $.get("phpscripts/getDevices.php",{'for':device,'period':period},function(data,status){
        
        jsonData = JSON.parse(data);

        $("#assign_to_device").empty();
        $("#assign_to_device").append('<option>Select Device</option>');

        for(i in jsonData){
          $("#assign_to_device").append("<option>" + jsonData[i].details + "</option>");
        }
          
      });

    }

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
