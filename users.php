<?php

session_start();
 
if(!isset($_SESSION['user-normal'])){
    header("Location:http://localhost:81/assettrack/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EGPAFZIM User Asset Management </title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=KoHo|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.7/css/mdb.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/addons/datatables.min.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- SideBar -->
            <div class="col-2 dropright grey lighten-4" id="side-menu-main" style="height:100vh;padding:0;margin:0;overflow:hidden;">
                <div class="col-12 text-center grey lighten-3" style="margin:0;height:15vh;padding:15px 0">
                  <img src="img/egpaf.png" style="height:40px;">
                  <h3 style="padding:5px 0;font-weight:400">My Asset Tracker</h3>
                  <small>Logged In As <?php echo $_SESSION['user-normal']?></small>
                </div>

                <div class="col-12 " style="height:73vh;padding:0 15px;margin:0;overflow-y:auto;">
                    <div class="col-12">
                        <div style="display:inline-flex;width:100%;margin:10px 0 0 0;padding:10px 20px;cursor:pointer;" id="menu-header-2">
                            <h3 style="font-weight:400;font-size:18px;width:100%;padding:0 20px;width:80%">My Asset List</h3>
                        </div><hr style="padding:0;margin:5px 0">
                        <ul style="list-style:none;padding-left:35px;" id="menu-item-2">
                            <li>
                                <div class="side-menu-items active" style="display:inline-flex;width:100%;padding:10px 0">
                                    <i class="material-icons" style="width:25%;font-size:30px;padding-top:5px">devices_other</i>
                                    <p style="width:80%;padding-top:10px;font-size:14px">My Devices</p>
                                </div>
                            </li>
                            <li>
                                <div class="side-menu-items" style="display:inline-flex;width:100%;padding:10px 0">
                                    <i class="material-icons" style="width:25%;font-size:30px;padding-top:5px">blur_on</i>
                                    <p style="width:80%;padding-top:10px;font-size:14px">Catridge Register</p>
                                </div>
                            </li>
                            <li>
                                <div class="side-menu-items" style="display:inline-flex;width:100%;padding:10px 0">
                                    <i class="material-icons" style="width:25%;font-size:30px;padding-top:5px">note_add</i>
                                    <p style="width:80%;padding-top:10px;font-size:14px">Available For Loan</p>
                                </div>
                            </li>
                            <li>
                                <div class="side-menu-items" style="display:inline-flex;width:100%;padding:10px 0">
                                    <i class="material-icons" style="width:25%;font-size:30px;padding-top:5px">view_list</i>
                                    <p style="width:80%;padding-top:10px;font-size:14px">Loaned By You</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 text-center" style="height:10vh">
                    <div class="col-12">
                      <a href="login.php"><button class="btn btn-success btn-block">Log Out</button></a>
                    </div>

                    <div class="col-12" style="padding:20px 10px">
                      <p style="font-size:14px;">Copyrights Reserved @ EGPAFZIM-2018</p>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            
            <!--Main-->
            <div class="col-10 grey lighten-4" style="height:100vh;padding:0;margin:0;overflow:hidden;">
                <div class=" col-12 row" style="height:8vh;margin:20px 0">
                    <div class="col-9" style="display:inline-flex;width:40%">
                        <i id="view_icon" class="material-icons" style="font-size:50px;width:5%;padding-top:15px;">devices_other</i>
                        <p id="view-title" style="padding-top:18px;padding-left:25px;font-weight:400;width:80%;font-size:30px">My Devices<p>
                    </div>
                    <div class="col-3 d-flex flex-lg-row" style="width:40%">
                        <div class="p-2">
                           <button type="button" class="btn btn-primary mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export <i class="fa fa-caret-down" style="padding-left:10px"></i></button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">CSV</a>
                            <a class="dropdown-item" href="#">Excel</a>
                            <a class="dropdown-item" href="#">PDF</a>
                          </div>
                        </div>
                        <div class="p-2">
                           <button type="button" class="btn btn-dark " id="reload">Reload <i class="fa fa-repeat" style="padding-left:10px"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-12 white" style="height:92vh;padding:20px;overflow-y:hidden;">
                    <table id="dataTable" table-layout="fixed" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
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

                          <th class="th-sm">Category
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>

                    <table id="dataTable2" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
                        <thead class="black white-text">
                        <tr class="col-12" id="thead">
                            <th scope="col">Device Name
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                            </th>

                            <th scope="col">Date Loaned
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                            </th>

                            <th scope="col">Status
                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <table id="dataTable3" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
                        <thead class="black white-text">
                        <tr class="col-12" id="thead">
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

                    <table id="dataTable4" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
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
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script type="text/javascript">

    var user = "";

    if(document.cookie.split(';').length == 1){
        user = document.cookie.split(';')[0].split('=')[1].replace("+"," ");
        fetchAssetData(user);
    }

    else{
        user = document.cookie.split(';')[1].split('=')[1].replace("+"," ");
        fetchAssetData(user);
    }
       

    function fetchAssetData(data){
        $.get("phpscripts/getTableDataUsers.php",{'for':data,'option':'assets'},function(data,status){

            $('#dataTable').show();
            $('#dataTable2').hide();
            $('#dataTable3').hide();
            $('#dataTable4').hide();

            $('#dataTable').DataTable().destroy();
            $('#dataTable3').DataTable().destroy();
            $('#dataTable2').DataTable().destroy();
            $('#dataTable4').DataTable().destroy();

            var jsonResponse = JSON.parse(data);
            
            $('#dataTable').DataTable( {
                
                data: jsonResponse,

                columns: [
                    { data: 'device' ,width:'25%'},
                    { data: 'barcode',width:'25%' },
                    { data: 'serialnumber',width:'25%' },
                    { data: 'category',width:'25%'}
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

    function fetchDataFor(data){
        $.get("phpscripts/getTableDataUsers.php",{'for':data,'option':'loan'},function(data,status){

            $('#dataTable2').show();
            $('#dataTable').hide();
            $('#dataTable3').hide();
            $('#dataTable4').hide()

            $('#dataTable').DataTable().destroy();
            $('#dataTable3').DataTable().destroy();
            $('#dataTable2').DataTable().destroy();
            $('#dataTable4').DataTable().destroy();

            var jsonResponse = JSON.parse(data);
            
            $('#dataTable2').DataTable( {
                
                data: jsonResponse,

                columns: [
                    { data: 'item' ,width:'33.333%'},
                    { data: 'date_loaned',
                        width:'33.333%',
                        render: function ( data, type, row, meta ) { 
                          var d = new Date(data['date']);
                          return d.toDateString() + " , " + d.getHours() + ":" + d.getMinutes();
                        }
                    },
                    {data : 'status',
                        width:'33.33%',
                        render: function (data,type,row,meta) { 
                            if(data==null){
                                return "-";
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
                "scrollY": "67vh",
                "scrollCollapse": true,
            } );
        });
    }

    function fetchCatridgeFor(data){
        $.get("phpscripts/getTableDataUsers.php",{'for':data,'option':'catridge'},function(data,status){

            $('#dataTable3').show();
            $('#dataTable').hide();
            $('#dataTable2').hide();
            $('#dataTable4').hide();

            $('#dataTable').DataTable().destroy();
            $('#dataTable3').DataTable().destroy();
            $('#dataTable2').DataTable().destroy();
            $('#dataTable4').DataTable().destroy();

            var jsonResponse = JSON.parse(data);
            
            $('#dataTable3').DataTable( {
                
                data: jsonResponse,

                columns: [
                    { data: 'catridge_name' ,width:'40%'},
                    { data: 'date_given',
                        width:'40%',
                        render: function ( data, type, row, meta ) { 
                          var d = new Date(data['date']);
                          return d.toDateString() + " , " + d.getHours() + ":" + d.getMinutes();
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

        $.get("phpscripts/getTableDataUsers.php",{'option':'available'},function(data,status){

            $('#dataTable4').show();
            $('#dataTable').hide();
            $('#dataTable2').hide();
            $('#dataTable3').hide();

            $('#dataTable').DataTable().destroy();
            $('#dataTable3').DataTable().destroy();
            $('#dataTable2').DataTable().destroy();
            $('#dataTable4').DataTable().destroy();

            var jsonResponse = JSON.parse(data);
            
            $('#dataTable4').DataTable( {
                
                data: jsonResponse,

                columns: [
                    { data: 'name' ,width:'40%'},
                    { data: 'barcode',
                        width:'40%',
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
                        width:'40%',
                        render: function ( data, type, row, meta ) { 
                            console.log(data);
                            if(data == ''){
                                return "-";
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
                "scrollY": "67vh",
                "scrollCollapse": true,
            } );
        });
    }

    $(".side-menu-items").click(function(){

              $(".side-menu-items.active").attr("class","side-menu-items");
              $(this).attr("class","side-menu-items active");

              var new_icon = $(this).children("i.material-icons").html();
              new_title = $(this).children("p").html();

              $("#view_icon").html(new_icon);
              $("#view-title").html(new_title);

              if(new_title == "Loaned By You"){
                  fetchDataFor(user);
              }

              else if (new_title == "My Devices"){
                fetchAssetData(user);
              }

              else if(new_title == 'Catridge Register'){
                  fetchCatridgeFor(user);
              }

              else{
                fetchAvailableLoan();
              }
              
        });
    </script>
</body>

</html>
