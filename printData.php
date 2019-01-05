<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Data</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=KoHo|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.7/css/mdb.min.css" />
    <script src="offline_docs/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

    <style rel="typesheet">
        .table-bordered, .table-bordered td, .table-bordered th {
            border: 1px solid #000;
        }

        .table-bordered thead td, .table-bordered thead th {
            border-bottom-width: 2px;
            border: 1px solid #000;
            font-weight: bold;
        }
    </style>

    <link href="css/addons/datatables.min.css" rel="stylesheet">
</head>
<body>
    <h1 style="padding:0px 20px;padding-top:10px"><?php 
    if(isset($_GET['datatype'])){ 

        if($_GET['datatype'] == "All Assets"){ 
            echo $_GET['datatype'];
        }

        else if($_GET['datatype'] == "Specific User"){ 
            echo "Assets";
        } 

        else if($_GET['datatype'] == "Specific Register"){
            
            if(isset($_GET['choice'])){
                echo $_GET['choice']." Register";
            }
            
        } 

        else if($_GET['datatype'] == "Specific Category"){
            
            if(isset($_GET['choice'])){
                echo "Category - ".$_GET['choice'];
            }
            
        } 
            
        else{
            echo "IT Pool";
        }

        if(isset($_GET['user'])){ 
            echo " for ".$_GET['user'];
        }
    }?>
    </h1>
        <div class="col-12" style="padding: 0 20px;overflow-y:hidden;">
            <table id="dataTable" table-layout="fixed" class="table table-bordered table-striped text-center">
            <thead class="text-center">
                <tr>
                <th class="th-sm">Device Name

                </th>
                <th class="th-sm">Category

                </th>
                <th class="th-md">BarCode

                </th>

                <th class="th-sm">Serial Number

                </th>

                <th class="th-sm">Assigned To

                </th>
                </tr>
            </thead>
            <tbody id="tbody1">
                
            </tbody>
            </table>

            <table id="dataTable3" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
            <thead class="black white-text">
                <tr>
                <th class="th-sm">Device Name

                </th>
                <th class="th-md">BarCode

                </th>

                <th class="th-sm">Serial Number

                </th>

                <th class="th-sm">Assigned To

                </th>
                </tr>
            </thead>
            <tbody id="tbody3"></tbody>
            </table>

            <table id="dataTable2" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
            <thead class="black white-text">
                <tr class="col-12" id="thead">
                <th scope="col">Catridge Name

                </th>

                <th scope="col">Color

                </th>

                <th scope="col">Quantity

                </th>
                </tr>
            </thead>
            <tbody id="tbody2"></tbody>
            </table>

            <table id="dataTable3" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
            <thead class="black white-text">
            <tr>
                <th class="th-sm">Device Name
                </th>
                <th class="th-md">Asset ID
                </th>
                <th class="th-sm">Serial Number
                </th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>

        <table id="dataTable4" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
            <thead class="black white-text">
            <tr class="col-12" id="thead">
                <th scope="col">Name
                </th>
                
                <th scope="col">Catridge
                </th>

                <th scope="col">Date Given
                </th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>

        <table id="dataTable6" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
            <thead class="black white-text">
            <tr class="col-12" id="thead">
                <th scope="col">Name
                </th>
                
                <th scope="col">Serial Number
                </th>

                <th scope="col">Asset ID
                </th>

                <th scope="col">Quantity
                </th>
            </tr>
            </thead>
            <tbody id="tbody6"></tbody>
        </table>

        <table id="dataTable5" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
            <thead class="black white-text">
            <tr class="col-12" id="thead">
                <th scope="col">Date Given
                </th>
                
                <th scope="col">Item Name
                </th>

                <th scope="col">Given To
                </th>

                <th scope="col">Status
                </th>
            </tr>
            </thead>
            <tbody id="tbody5"></tbody>
        </table>

        <table id="dataTable7" table-layout="fixed" class="table table-bordered table-striped text-center" cellspacing="0" width="100%" style="display:none">
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
            </tr>
            </thead>
            <tbody id="tbody7">
            
            </tbody>
        </table>

        <div class="text-left" style="display:inline-flex;padding:5px">
            <small id="time" style="font-size:12px" class="text-center"></small>
        </div>

        </div>
</body>

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

    var choice = '<?php if(isset($_GET['choice'])){ echo ($_GET['choice']);}?>';
    var user = '<?php if(isset($_GET['user'])){ echo ($_GET['user']);}?>';

    if(choice == "All"){
        fetchDataAll();
    }

    else if(choice == "User"){

        fetchDataFor(choice,user);
    }

    else if(choice == "Catridge"){
        fetchCatridge(choice);
    }

    else if(choice == "Loan"){
        fetchLoanedOut();
    }

    else if(choice == "Others"){
        fetchAvailableLoan();
    }

    else{
        fetchData(choice);
    }

    var date = new Date();

    $("#time").html(date);
        
    //setTimeout(function () { window.print();},2000);

    //setTimeout(function () { window.history.back();},5000);
    
 });


 function fetchCatridge(d){
    $.get("phpscripts/getPrintData.php",{'for':d},function(data,status){

        $("#dataTable").hide();
        $("#dataTable2").show();
        $("#dataTable3").hide();
        $("#dataTable4").hide();
        $("#dataTable5").hide();
        $("#dataTable6").hide();

        var jsonOBJ = JSON.parse(data);
        
        $("tbody").empty();

            for(i = 0;i < jsonOBJ.length;i++){

                $("#tbody2").append("<tr><td>"+ jsonOBJ[i].catridge + "</td>" + "<td>"+jsonOBJ[i].color + "</td>"  + "<td>"+jsonOBJ[i].quantinty +"</td></tr>");
        }
    });
}

function fetchDataFor(c,u){
    
    $.get("phpscripts/getPrintData.php",{'for':c,'user':u},function(data,status){

        $("#dataTable").hide();
        $("#dataTable7").show();
        $("#dataTable3").hide();
        $("#dataTable4").hide();
        $("#dataTable5").hide();
        $("#dataTable6").hide();
        $("#dataTable2").hide();

        var jsonOBJ = JSON.parse(data);

        $("tbody").empty();

        for(i = 0;i < jsonOBJ.length;i++){

            $("#tbody7").append("<tr><td>"+ jsonOBJ[i].device + "</td>" + "<td>"+jsonOBJ[i].barcode + "</td>"  + "<td>"+jsonOBJ[i].serialnumber + "</td>"  + "<td>"+jsonOBJ[i].category + "</td></tr>");
    }
        
    });
}

function fetchDataAll(){

    $("#dataTable3").hide();
    $("#dataTable2").hide();
    $("#dataTable").show();
    $("#dataTable4").hide();
    $("#dataTable5").hide();
    $("#dataTable6").hide();

    $.get("phpscripts/getPrintData.php",{'for':'All'},function(data,status){

        var jsonOBJ = JSON.parse(data);

        $("tbody").empty();

            for(i = 0;i < jsonOBJ.length;i++){

                $("#tbody1").append("<tr><td>"+ jsonOBJ[i].device + "</td>" + "<td>"+jsonOBJ[i].category + "</td>"  + "<td>"+jsonOBJ[i].barcode + "</td>"  + "<td>"+jsonOBJ[i].serialnumber + "</td>"  + "<td>"+jsonOBJ[i].assigned_to + "</td></tr>");
        }
    });
}

function fetchData(data){
    $.get("phpscripts/getPrintData.php",{'for':data},function(data,status){
        
    $("#dataTable").hide();
    $("#dataTable2").hide();
    $("#dataTable3").show();
    $("#dataTable4").hide();
    $("#dataTable5").hide();
    $("#dataTable6").hide();

        var jsonOBJ = JSON.parse(data);
        
        $("tbody").empty();

            for(i = 0;i < jsonOBJ.length;i++){

                $("#tbody3").append("<tr><td>"+ jsonOBJ[i].device + "</td>" + "<td>"+jsonOBJ[i].barcode + "</td>"  + "<td>"+jsonOBJ[i].serialnumber + "</td>"  + "<td>"+jsonOBJ[i].assigned_to + "</td></tr>");
        }
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

    var jsonOBJ = JSON.parse(data);

    $("tbody").empty();

        for(i = 0;i < jsonOBJ.length;i++){

            var d = new Date(jsonOBJ[i].date_loaned['date']);
            
            var minutes;

            if(d.getMinutes() < 10){
            minutes = "0"+ d.getMinutes();
            }

            else{
                minutes = d.getMinutes();
            }

            var dateloaned = d.toDateString() + " , " + d.getHours() + ":" + minutes;

            $("#tbody5").append("<tr><td>"+ dateloaned + "</td>" + "<td>"+jsonOBJ[i].item + "</td>"  + "<td>"+ jsonOBJ[i].username  + "</td>"  + "<td>"+jsonOBJ[i].status + "</td>"  +"</tr>");
        }
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

    var jsonOBJ = JSON.parse(data);

    $("tbody").empty();

        for(i = 0;i < jsonOBJ.length;i++){

            $("#tbody6").append("<tr><td>"+ jsonOBJ[i].name + "</td>" + "<td>"+jsonOBJ[i].barcode + "</td>"  + "<td>"+jsonOBJ[i].serialnumber + "</td>"  + "<td>"+jsonOBJ[i].quantity + "</td></tr>");
    }
    
     
});
}

</script>

</html>