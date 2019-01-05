<?php
    require('oauth.php');

    if(!isset($_SESSION['user-admin'])){
      header("Location:./login.php");
    }

    // else{
    //   if(empty($_SESSION['access_token']) || !isset($_SESSION['access_token'])){
    //     $urlLogin = oAuthService::getLoginUrl('./authorize.php');
        
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
    <title>EGPAFZIM Asset Tracker | Dashboard</title>
    <!-- Font Awesome -->
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

    <style type="text/css">
      body{
        text-shadow: 0 0 #000;
      }

      #main-wrapper .form-control {
        height: 30px;
      }

      #main-wrapper label {
        font-size: 14px;
      }

      .card{
        margin-bottom:10px;
      }

      div.side-menu-items.active,.nav-item.active a{
        color:#f0a94e;
      }

      thead tr th{
        background-color: #f0a94e;
        color:#1f1f1f;
        font-weight:bold;
      }

      .table-bordered{
        border: 1px solid #eee;
      }

      tbody tr:hover{
        cursor: pointer;
        background-color: #eee;
      }

      tbody tr td{
        font-weight:bold;
      }

      .pagination .page-item.active .page-link {
        background-color: #dd3652;
      }

      .pagination .page-item.active .page-link:focus{
        background-color: #dd3652;
      }

      .pagination .page-item.active .page-link:hover{
        background-color: #dd3652;
      }

      #main-inside-wrapper{
        height:81.299vh;
        padding:20px;
        overflow-y:hidden;
      }


    </style>
</head>

<body>

  <div class="container-fluid">
      <div class="row">
          <!--Main-->
          <div class="col-12" style="" id="topbar-wrapper">
            <div class="col-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#"><img src="img/egpaf.png" height="60" class="d-inline-block align-top" alt="mdb logo"></a>
                <h3 class="col icontext">Asset DashBoard - <span id="view-title">All Assets</span></h3>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="nav justify-content-end">
                  <li class="nav-item active"><a class="nav-link" href="/assettrack/index.php">Home <i class="fa fa-home"></i></a></li>
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
                    <a class="nav-link dropdown-toggle" data-toggle="modal" data-target="#myModal"><?php echo $_SESSION['user-admin'];?>
                    </a>
                  <div class="dropdown-menu justify-content-end">
                    <a class="dropdown-item" href="./login.php">Log Out</a>
                  </div>
                  </li>
                </ul>
              </nav>
            </div>

            <div class="row">
              <div class="col-1 text-center d-flex flex-column z-depth-3" id="sidebar-wrapper" style="overflow: hidden">

                <h4>IT Asset List</h4>

                <div class="side-menu-items active">
                  <i class="material-icons">devices_others</i>
                  <span>All Assets</span>
                </div>

                <div class="side-menu-items">
                  <i class="material-icons">blur_on</i>
                  <span>Catridges</span>
                </div>

                <div class="side-menu-items">
                  <i class="material-icons">laptop</i>
                  <span>Laptops</span>
                </div>

                <div class="side-menu-items">
                  <i class="material-icons">print</i>
                  <span>Printers</span>
                </div>

                <div class="side-menu-items">
                  <i class="material-icons">blur_on</i>
                  <span>Others</span>
                </div>

                <div class="side-menu-items">
                  <i class="material-icons">note_add</i>
                  <span>For Loaning</span>
                </div>

                <h4 style="margin-top:30px">IT Registers</h4>

                <div class="side-menu-items">
                  <i class="material-icons">cancel</i>
                  <span>Loaning</span>
                </div>

                <div class="side-menu-items">
                  <i class="material-icons">blur_on</i>
                  <span>Catridge</span>
                </div>
              </div>

              <div class="col-11" id="main-wrapper">
                <div class="col-12" id="main-inside-wrapper">
                    <table id="dataTable" table-layout="fixed" class="table table-bordered table-striped" cellspacing="0" width="100%">
                      <thead class="black white-text">
                        <tr>
                          <th class="th-sm">Device Name
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>
                          <th class="th-sm">Category
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>
                          <th class="th-md">BarCode
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>

                          <th class="th-sm">Serial Number
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>

                          <th class="th-sm">Assigned To
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>

                    <table id="dataTable3" table-layout="fixed" class="table table-bordered table-striped" cellspacing="0" width="100%" style="display:none">
                      <thead class="black white-text">
                        <tr>
                          <th class="th-sm">Device Name
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>
                          <th class="th-md">BarCode
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>

                          <th class="th-sm">Serial Number
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>

                          <th class="th-sm">Assigned To
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>

                    <table id="dataTable2" table-layout="fixed" class="table table-bordered table-striped" cellspacing="0" width="100%" style="display:none">
                      <thead class="black white-text">
                        <tr class="col-12" id="thead">
                          <th scope="col">Catridge Name
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>

                          <th scope="col">Color
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>

                          <th scope="col">Quantity
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>

                    <table id="dataTable3" table-layout="fixed" class="table table-bordered table-striped" cellspacing="0" width="100%" style="display:none">
                      <thead class="black white-text">
                      <tr>
                        <th class="th-sm">Device Name
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                        <th class="th-md">Asset ID
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                        <th class="th-sm">Serial Number
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                      </tr>
                      </thead>
                      <tbody></tbody>
                  </table>

                  <table id="dataTable4" table-layout="fixed" class="table table-bordered table-striped" cellspacing="0" width="100%" style="display:none">
                      <thead class="black white-text">
                      <tr class="col-12" id="thead">
                        <th scope="col">Name
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                          
                        <th scope="col">Catridge
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>

                        <th scope="col">Date Given
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                      </tr>
                      </thead>
                      <tbody></tbody>
                  </table>

                  <table id="dataTable6" table-layout="fixed" class="table table-bordered table-striped" cellspacing="0" width="100%" style="display:none">
                      <thead class="black white-text">
                      <tr class="col-12" id="thead">
                        <th scope="col">Name
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                          
                        <th scope="col">Serial Number
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>

                        <th scope="col">Asset ID
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>

                        <th scope="col">Quantity
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                      </tr>
                      </thead>
                      <tbody></tbody>
                  </table>

                  <table id="dataTable5" table-layout="fixed" class="table table-bordered table-striped" cellspacing="0" width="100%" style="display:none">
                      <thead class="black white-text">
                      <tr class="col-12" id="thead">
                        <th scope="col">Name
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                          
                        <th scope="col">Item
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>

                        <th scope="col">Status
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>

                        <th scope="col">Date Given
                          <i class="fa fa-sort float-right" aria-hidden="true"></i>
                        </th>
                      </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
                </div>

                <div class="col-12 text-center" style="height:10vh;">
                  <p>Copyrights Reserved @ 2018 By Daveson Mukuna</p>
                </div>
              </div>
            </div> 
          </div>
          <!--Main-->

          <!-- Full Height Modal Right -->
          <div class="modal fade right" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

              <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
              <div class="modal-dialog modal-full-height modal-right" role="document">


                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel"><img class="rounded-circle img" src="img/img.jpg" height="60px" width="60px" style="margin-right:10px"><?php echo $_SESSION['user-admin']?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h3>Recent Activity</h3><hr>
                    <div id="recentActivity">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Item Added <small>. 12/10/2018 1422hrs</small></h4>
                          <p class="card-text">Amana hyey haa pakaipa</p>
                          <p class="card-text"><small>Daveson Mukuna</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center">
                    <a href="./login.php"><button type="button" class="btn btn-secondary">Log Out</button></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Full Height Modal Right -->
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

              else if(new_title == "For Loaning"){
                fetchAvailableLoan();
              }

              else{
                var newString = new_title.replace("s","");
                fetchData(newString);
              }
              
        });

        fetchDataAll();

      });

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
                  "scrollY": "55vh",
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
                  "scrollY": "55vh",
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
                  "scrollY": "55vh",
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
                "scrollY": "65vh",
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
                "scrollY": "65vh",
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
                  "scrollY": "65vh",
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
              fetchData($("#add_category").val());
              $("#addITAsset").trigger('reset');
              $("#addITAssetModal").modal('hide');
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
