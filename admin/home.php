<?php 
require("../koneksi.php");

session_start();

if(!isset($_SESSION['id'])){
    $_SESSION['msg'] = 'anda harus log in  untuk mengakses halaman ini';
    header('Location:../index.php');
}
$sesID = $_SESSION['id'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['level'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="../img/MOP Green 1.png" type="image/x-icon" />
    <title>MOP Green | Home Page</title>

<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
document.getElementById('ct').innerHTML = x;
display_c();
 }
</script>
  </head>
  <body onload="display_ct();">
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          >MOP Green
          </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <!-- <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form> -->
          <!-- <div onload="display_ct();">
              <span id='ct' ></span>
          </div> -->
          <div class="d-flex ms-auto my-3 my-lg-0">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle ms-2"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <h8><?=$sesName?></h8>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li><hr class="dropdown-divider bg-light" /></li>
            <li>
              <a href="home.php" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-1"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-2 mb-1">
                Menu
              </div>
            </li>
            <li>
              <a href="map.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-map"></i></span>
                <span>Map Dan Lokasi Sensor</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-cpu"></i></span>
                <span>Monitoring</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-view-list"></i></span>
                <span>Log View</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Production</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-camera"></i></span>
                <span>CCTV Controling</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
            <span id='ct'></span>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-end" id="time"></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="class-body">
                        jksajdkajs
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="class-body">
                        jksajdkajs
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="class-body">
                        jksajdkajs
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="class-body">
                        jksajdkajs
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-9 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-speedometer"></i></span>
                Area Chart Example
              </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
      </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!-- <script src="../canvasjs.min.js"></script> -->
    <script type="text/javascript">
    var timeDisplay = document.getElementById("time");
        function refreshTime() {
        var dateString = new Date().toLocaleString("en-US", {timeZone: "Asia/Jakarta"});
        var formattedString = dateString.replace(", ", " - ");
        timeDisplay.innerHTML = formattedString;
    }

    setInterval(refreshTime, 1000);
    </script>
    <script>
window.onload = function () {

    var dataPoints1 = [];
    var dataPoints2 = []; // dataPoints
var chart = new CanvasJS.Chart("chartContainer", {
    zoomEnabled: true,
    title: {
        text: "Data Real Time Green House"
    },
    axisX: {
        title: "updates every 3 secs"
    },
    axisY:{
        prefix: ""
    }, 
    toolTip: {
        shared: true
    },
    legend: {
        cursor:"pointer",
        verticalAlign: "top",
        fontSize: 22,
        fontColor: "dimGrey",
        itemclick : toggleDataSeries
    },
    data: [{ 
        type: "line",
        xValueType: "dateTime",
        yValueFormatString: "####.00",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        name: "SH1",
        dataPoints: dataPoints1
        },
        {               
            type: "line",
            xValueType: "dateTime",
            yValueFormatString: "####.00",
            showInLegend: true,
            name: "HD1" ,
            dataPoints: dataPoints2
    }]
});

function toggleDataSeries(e) {
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else {
        e.dataSeries.visible = true;
    }
    chart.render();
}

var yValue1 = 600; 
var yValue2 = 605;
 
var time = new Date;
// starting at 9.30 am
time.setHours(9);
time.setMinutes(30);
time.setSeconds(00);
time.setMilliseconds(00);
var updateInterval = 1000;
var dataLength = 300; // number of dataPoints visible at any point

function updateChart(count) {
    count = count || 1;
    var deltaY1, deltaY2;
    for (var i = 0; i < count; i++) {
        time.setTime(time.getTime()+ updateInterval);
        deltaY1 = .5 + Math.random() *(-.5-.5);
        deltaY2 = .5 + Math.random() *(-.5-.5);
 
    // adding random value and rounding it to two digits. 
    yValue1 = Math.round((yValue1 + deltaY1)*100)/100;
    yValue2 = Math.round((yValue2 + deltaY2)*100)/100;
 
    // pushing the new values
    dataPoints1.push({
        x: time.getTime(),
        y: yValue1
    });
    dataPoints2.push({
        x: time.getTime(),
        y: yValue2
    });
    }
 
    // updating legend text with  updated with y Value 
    chart.options.data[0].legendText = " SH1 " + yValue1;
    chart.options.data[1].legendText = " HD1 " + yValue2; 
    chart.render();
}

// var updateChart = function (count) {

//     count = count || 1;

//     for (var j = 0; j < count; j++) {
//         yVal = yVal +  Math.round(5 + Math.random() *(-5-5));
//         dps.push({
//             x: xVal,
//             y: yVal
//         });
//         xVal++;
//     }

//     if (dps.length > dataLength) {
//         dps.shift();
//     }

//     chart.render();
// };

updateChart(dataLength);
setInterval(function(){updateChart()}, updateInterval);

}
</script>
  </body>
</html>