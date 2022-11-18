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
  <link rel="icon" href="../img/logo2.png" type="image/x-icon" />
  <!-- Date -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>MOP Green | Log View Page</title>
  <style type="text/css">
    body{
      background-color: #2e3338;
    }
  </style>
</head>
<body>
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
                <li><a class="dropdown-item" href="../logout.php" onclick="return confirm('Anda yakin ingin logout?');">Logout</a></li>
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
          <a href="home.php" class="nav-link px-3">
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
        <?php if ($sesLvl==1): ?>
          <li>
            <a href="controlling.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-cpu"></i></span>
              <span>Controlling</span>
            </a>
          </li>
        <?php endif ?>
        <li>
          <a href="logview.php" class="nav-link px-3 active">
            <span class="me-2"><i class="bi bi-view-list"></i></span>
            <span>Log View</span>
          </a>
        </li>
        <li>
          <a href="cctv.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-camera"></i></span>
            <span>CCTV Controling</span>
          </a>
        </li>
        <?php if ($sesLvl==1): ?>
          <li>
            <a href="manage_user.php" class="nav-link px-3">
              <span class="me-2"><i class="bi bi-gear"></i></span>
              <span>Manage User</span>
            </a>
          </li>
        <?php endif ?>
      </ul>
    </nav>
  </div>
</div>
<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h4 class="text-white">Log View</h4>
      </div>
      <div class="col-md-6">
        <h5 class="text-end text-white" id="time"></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-12 mb-3">
        <div class="card bg-dark h-100">
          <div class="card-header text-white">
            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
            Area Chart
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <p class="text-center text-white">
                  <strong>Suhu</strong>
                </p>
                <div class="chart">                      
                  <canvas id="chartTEMP" height="200" style="height: 200px;"></canvas>            
                </div>                    
              </div>
              <div class="col-sm-6">
                <p class="text-center text-white">
                  <strong>Kelembapan</strong>
                </p>
                <div class="chart">                      
                  <canvas id="chartHUM" height="200" style="height: 200px;"></canvas>           
                </div>                    
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card bg-dark h-100">
          <div class="card-header text-white">
            <span class="me-2"><i class="bi bi-calendar"></i></span>
            Date Query
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-5 col-md-4 col-sm-4 col-4">
                <h5 class="text-start text-white">Time Data</h5>
              </div>
              <div class="col-lg-4 col-md-8 col-sm-8 col-8">
                <select class="btn btn-dark text-start" id="listRoom" onchange="getSelectedValue();">
                  <option value="yesterday">Yesterday</option>
                  <option value="last3days">Last 3 Days</option>
                  <option value="last1week">Last 1 Week</option>
                  <option value="last1month">Last 1 Month</option>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <h5 class="text-start text-white">From</h5>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                <input type="date" class="form-control" style="cursor: pointer;">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <h5 class="text-start text-white">To</h5>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                <input type="date" class="form-control" style="cursor: pointer;">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <input type="submit" class="btn btn-primary text-light" name="" style="cursor: pointer; " value="BUTTON">
              </div>
            </div>
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
<!-- Date -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Chart timeseries -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.9.0"></script>
<!-- Chart Speed DHT11 -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>  
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/dataviz.js"></script>  
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<!-- Paho MQTT Client -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function() {
    $('#datepicker').datepicker();
  });
</script>
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
    /*-----------------------------------------------------
  BAGIAN MQTT YANG TERKONEKSI DENGAN MESSAGE BROKER
  -----------------------------------------------------*/
    // Menentuan alamat IP dan PORT message broker
    var host = "20.20.0.252";
    var port = 9001;

    // Konstruktor koneksi antara client dan message broker
    var client = new Paho.MQTT.Client(host, port, "/ws",
      "myclientid_" + parseInt(Math.random() * 100, 10));

    // Menjalin koneksi antara client dan message broker
    client.onConnectionLost = function (responseObject) {
      document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT Putus - " + responseObject
        .errorMessage + "<br/>";
    };

    // variabel global data sensor IoT Development Board
    // website berposisi sebagai subscriber
    var humadity = 0;
    var temp = 0;
    var sr04 = 0;
    var ldr = 0;
    var keypad = "";

    // Mendapatkan payload dari transimisi data IoT Development Board
    // kemudian memilah dan melimpahkanya ke varibael berdasarkan TOPIC.
    client.onMessageArrived = function (message) {
      if (message.destinationName == "ldr") {
        ldr = message.payloadString;
      } else if (message.destinationName == "sr04") {
        sr04 = message.payloadString; 
      // else if (message.destinationName == "dht") {
      //  var dht = JSON.parse(message.payloadString);
      //  humi = dht.kelembaban;
      //  temp = dht.suhu;
      } else if (message.destinationName == "temp") {
        temp = message.payloadString;
      } else if (message.destinationName == "humadity") {
        humadity = message.payloadString;
      }
      
      else if (message.destinationName == "/remoteir") {
        keypad = message.payloadString;
      }

      document.getElementById("hitTEMP").innerHTML = temp + " °C";
      document.getElementById("hitHUM").innerHTML = humadity + " H";
      document.getElementById("hitLDR").innerHTML = ldr + " Lux";
      document.getElementById("hitSR04").innerHTML = sr04 + " cm";
      document.getElementById("kodekeypad").innerHTML = keypad;
    };

    // Option mqtt dengan mode subscribe dan qos diset 1
    var options = {
      timeout: 60,
      keepAliveInterval: 30,
      onSuccess: function () {
        document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT Sukses" + "<br/>";
        client.subscribe("temp", {
          qos: 1
        });client.subscribe("humadity", {
          qos: 1
        });
        client.subscribe("ldr", {
          qos: 1
        });
        client.subscribe("sr04", {
          qos: 1
        });
        client.subscribe("/remoteir", {
          qos: 1
        });
      },

      onFailure: function (message) {
        document.getElementById("messages").innerHTML += "Koneksi ke Broker MQTT Gagal - " + message
          .errorMessage + "<br/>";
      },

      userName: "",
      password: ""
    };

    if (location.protocol == "https:") {
      options.useSSL = true;
    }

    document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT - Alamat: " + host + ":" + port + "<br/>";
    client.connect(options);
  </script>

  <script>
    /*------------------------------------------------------------
  BAGIAN CHART CANVAS
  https://nagix.github.io/chartjs-plugin-streaming/latest/
  ------------------------------------------------------------*/
    // Enumerasi tipe warna  
    var chartColors = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(201, 203, 207)'
    };

    var color = Chart.helpers.color;
    var saiki = new Date();
    var dinoiki = saiki.toString();

    /*--------------------------
      CHART TEMPERATUR DHT11
      --------------------------*/
    // Update data sensor dht11
    function onRefreshTEMP(chart) {
      chart.data.datasets[0].data.push({
        x: Date.now(),
        y: temp
      });
    }

    var configTEMP = {
      type: 'line',
      data: {
        datasets: [{
          label: 'Temperatur (°C)',
          backgroundColor: color(chartColors.red).alpha(0.6).rgbString(),
          borderColor: chartColors.red,
          borderWidth: 1,
          data: []
        }]
      },

      options: {
        title: {
          display: true,
          text: dinoiki
        },

        scales: {
          xAxes: [{
            type: 'realtime',
            realtime: {
              duration: 10000,
              refresh: 1500,
              delay: 2000,
              onRefresh: onRefreshTEMP
            }
          }],

          yAxes: [{
            type: 'linear',
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'value'
            }
          }]
        },

        tooltips: {
          mode: 'nearest',
          intersect: false
        },

        hover: {
          mode: 'nearest',
          intersect: false
        }
      }
    };

    /*--------------------------
      CHART KELEMBABAN DHT11
      --------------------------*/
    // Update data sensor dht11
    function onRefreshHUM(chart) {
      chart.data.datasets[0].data.push({
        x: Date.now(),
        y: humadity
      });
    }

    var configHUM = {
      type: 'line',
      data: {
        datasets: [{
          label: 'Kelembaban (%)',
          backgroundColor: color(chartColors.blue).alpha(0.6).rgbString(),
          borderColor: chartColors.blue,
          borderWidth: 1,
          data: []
        }]
      },

      options: {
        title: {
          display: true,
          text: dinoiki
        },

        scales: {
          xAxes: [{
            type: 'realtime',
            realtime: {
              duration: 10000,
              refresh: 1500,
              delay: 2000,
              onRefresh: onRefreshHUM
            }
          }],

          yAxes: [{
            type: 'linear',
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'value'
            }
          }]
        },

        tooltips: {
          mode: 'nearest',
          intersect: false
        },

        hover: {
          mode: 'nearest',
          intersect: false
        }
      }
    };


    /*--------------------------------------
      CHART INTENSITAS CAHAYA SENSOR LDR
      --------------------------------------*/
    // Update data sensor LDR
    function onRefreshLDR(chart) {
      chart.data.datasets[0].data.push({
        x: Date.now(),
        y: ldr
      });
    }

    // Chart canvas & konfigurasi
    // Mode line sensor LDR
    var configLDR = {
      type: 'line',
      data: {
        datasets: [{
          label: 'Level Cahaya (Lux)',
          backgroundColor: color(chartColors.yellow).alpha(0.5).rgbString(),
          borderColor: chartColors.yellow,
          fill: false,
          lineTension: 0,
          borderDash: [8, 4],
          data: []
        }]
      },
      options: {
        title: {
          display: true,
          text: dinoiki
        },
        scales: {
          xAxes: [{
            type: 'realtime',
            realtime: {
              duration: 10000,
              refresh: 300,
              delay: 500,
              onRefresh: onRefreshLDR
            }
          }],
          yAxes: [{
            scaleLabel: {
              display: true,
              labelString: 'value'
            }
          }]
        },
        tooltips: {
          mode: 'nearest',
          intersect: false
        },
        hover: {
          mode: 'nearest',
          intersect: false
        }
      }
    };

    /*-----------------------------------------
      CHART JARAK SENSOR ULTRASONIC HC-SR04
      -----------------------------------------*/
    // Update data sensor ultrasnic HC-SR04  
    function onRefreshsr04(chart) {
      chart.data.datasets[0].data.push({
        x: Date.now(),
        y: sr04
      });
    }

    // Chart canvas & konfigurasi
    // Mode line sensor HC-SR04  
    var configSR04 = {
      type: 'line',
      data: {
        datasets: [{
          label: 'Jarak (cm)',
          backgroundColor: color(chartColors.purple).alpha(0.5).rgbString(),
          borderColor: chartColors.purple,
          fill: false,
          cubicInterpolationMode: 'monotone',
          data: []
        }]
      },
      options: {
        title: {
          display: true,
          text: dinoiki
        },
        scales: {
          xAxes: [{
            type: 'realtime',
            realtime: {
              duration: 10000,
              refresh: 500,
              delay: 2000,
              onRefresh: onRefreshsr04
            }
          }],
          yAxes: [{
            scaleLabel: {
              display: true,
              labelString: 'value'
            }
          }]
        },
        tooltips: {
          mode: 'nearest',
          intersect: false
        },
        hover: {
          mode: 'nearest',
          intersect: false
        }
      }
    };

    //Onload semua Chart
    window.onload = function () {
      // onload chart temperatur sensor DHT11
      var ctxTEMP = document.getElementById('chartTEMP').getContext('2d');
      window.chartTEMP = new Chart(ctxTEMP, configTEMP);

      // onload chart kelembaban sensor DHT11
      var ctxHUM = document.getElementById('chartHUM').getContext('2d');
      window.chartHUM = new Chart(ctxHUM, configHUM);

      // onload chart intensitas cahaya sensor LDR
      var ctxLDR = document.getElementById('chartLDR').getContext('2d');
      window.chartLDR = new Chart(ctxLDR, configLDR);

      // onload chart jarak penghalang sensor Ultrasonic
      var ctxSR04 = document.getElementById('chartUltrasonic').getContext('2d');
      window.chartUltrasonic = new Chart(ctxSR04, configSR04);
    };
  </script>

  <script>
    /*----------------------------
  BAGIAN SPEED CHART DHT11
  ----------------------------*/
    am4core.ready(function () {

      // Themes begin
      am4core.useTheme(am4themes_dataviz);
      am4core.useTheme(am4themes_animated);
      // Themes end

      //------------------------------------------
      //                Temperature
      //------------------------------------------

      // create chart
      var charttemp = am4core.create("chartdivtemp", am4charts.GaugeChart);
      charttemp.innerRadius = am4core.percent(82);

      /**
       * Normal axis
       */

      var axistemp = charttemp.xAxes.push(new am4charts.ValueAxis());
      axistemp.min = 0;
      axistemp.max = 100;
      axistemp.strictMinMax = true;
      axistemp.renderer.radius = am4core.percent(80);
      axistemp.renderer.inside = true;
      axistemp.renderer.line.strokeOpacity = 1;
      axistemp.renderer.ticks.template.disabled = false
      axistemp.renderer.ticks.template.strokeOpacity = 1;
      axistemp.renderer.ticks.template.length = 10;
      axistemp.renderer.grid.template.disabled = true;
      axistemp.renderer.labels.template.radius = 40;
      axistemp.renderer.labels.template.adapter.add("text", function (text) {
        return text + "°C";
      })

      /**
       * Axis for ranges
       */

      var colorSet = new am4core.ColorSet();

      var axis2temp = charttemp.xAxes.push(new am4charts.ValueAxis());
      axis2temp.min = 0;
      axis2temp.max = 100;
      axis2temp.strictMinMax = true;
      axis2temp.renderer.labels.template.disabled = true;
      axis2temp.renderer.ticks.template.disabled = true;
      axis2temp.renderer.grid.template.disabled = true;

      var range0temp = axis2temp.axisRanges.create();
      range0temp.value = 0;
      range0temp.endValue = 50;
      range0temp.axisFill.fillOpacity = 1;
      range0temp.axisFill.fill = colorSet.getIndex(0);

      var range1temp = axis2temp.axisRanges.create();
      range1temp.value = 50;
      range1temp.endValue = 100;
      range1temp.axisFill.fillOpacity = 1;
      range1temp.axisFill.fill = colorSet.getIndex(2);

      /**
       * Label
       */

      var labeltemp = charttemp.radarContainer.createChild(am4core.Label);
      labeltemp.isMeasured = false;
      labeltemp.fontSize = 45;
      labeltemp.x = am4core.percent(50);
      labeltemp.y = am4core.percent(100);
      labeltemp.horizontalCenter = "middle";
      labeltemp.verticalCenter = "bottom";
      labeltemp.text = "50%";


      /**
       * Hand
       */

      var handtemp = charttemp.hands.push(new am4charts.ClockHand());
      handtemp.axis = axis2temp;
      handtemp.innerRadius = am4core.percent(20);
      handtemp.startWidth = 10;
      handtemp.pin.disabled = true;
      handtemp.value = 50;

      handtemp.events.on("propertychanged", function (ev) {
        range0temp.endValue = ev.target.value;
        range1temp.value = ev.target.value;
        labeltemp.text = axis2temp.positionToValue(handtemp.currentPosition).toFixed(1);
        axis2temp.invalidate();
      });

      //------------------------------------------
      //                Humidity
      //------------------------------------------  

      // create chart
      var charthumi = am4core.create("chartdivhumi", am4charts.GaugeChart);
      charthumi.innerRadius = am4core.percent(82);

      /**
       * Normal axis
       */

      var axishumi = charthumi.xAxes.push(new am4charts.ValueAxis());
      axishumi.min = 0;
      axishumi.max = 100;
      axishumi.strictMinMax = true;
      axishumi.renderer.radius = am4core.percent(80);
      axishumi.renderer.inside = true;
      axishumi.renderer.line.strokeOpacity = 1;
      axishumi.renderer.ticks.template.disabled = false
      axishumi.renderer.ticks.template.strokeOpacity = 1;
      axishumi.renderer.ticks.template.length = 10;
      axishumi.renderer.grid.template.disabled = true;
      axishumi.renderer.labels.template.radius = 40;
      axishumi.renderer.labels.template.adapter.add("text", function (text) {
        return text + "H";
      })

      /**
       * Axis for ranges
       */

      var axis2humi = charthumi.xAxes.push(new am4charts.ValueAxis());
      axis2humi.min = 0;
      axis2humi.max = 100;
      axis2humi.strictMinMax = true;
      axis2humi.renderer.labels.template.disabled = true;
      axis2humi.renderer.ticks.template.disabled = true;
      axis2humi.renderer.grid.template.disabled = true;

      var range0humi = axis2humi.axisRanges.create();
      range0humi.value = 0;
      range0humi.endValue = 50;
      range0humi.axisFill.fillOpacity = 1;
      range0humi.axisFill.fill = colorSet.getIndex(0);

      var range1humi = axis2humi.axisRanges.create();
      range1humi.value = 50;
      range1humi.endValue = 100;
      range1humi.axisFill.fillOpacity = 1;
      range1humi.axisFill.fill = colorSet.getIndex(2);

      /**
       * Label
       */

      var labelhumi = charthumi.radarContainer.createChild(am4core.Label);
      labelhumi.isMeasured = false;
      labelhumi.fontSize = 45;
      labelhumi.x = am4core.percent(50);
      labelhumi.y = am4core.percent(100);
      labelhumi.horizontalCenter = "middle";
      labelhumi.verticalCenter = "bottom";
      labelhumi.text = "50%";


      /**
       * Hand
       */

      var handhumi = charthumi.hands.push(new am4charts.ClockHand());
      handhumi.axis = axis2humi;
      handhumi.innerRadius = am4core.percent(20);
      handhumi.startWidth = 10;
      handhumi.pin.disabled = true;
      handhumi.value = 50;

      handhumi.events.on("propertychanged", function (ev) {
        range0humi.endValue = ev.target.value;
        range1humi.value = ev.target.value;
        labelhumi.text = axis2humi.positionToValue(handhumi.currentPosition).toFixed(1);
        axis2humi.invalidate();
      });

      //------------------------------------------
      //             Animasi & Data
      //------------------------------------------
      setInterval(function () {
        var valuetemp = Math.round(temp);
        var valuehumi = Math.round(humi);

        var animationtemp = new am4core.Animation(handtemp, {
          property: "value",
          to: valuetemp
        }, 1000, am4core.ease.cubicOut).start();

        var animationhumi = new am4core.Animation(handhumi, {
          property: "value",
          to: valuehumi
        }, 1000, am4core.ease.cubicOut).start();

      }, 1500);

    });
  </script>

  <script>
    /*---------------------------
  BAGIAN KONTROL AKTUATOR
  ---------------------------*/

    /*----------------------------------------
      MENGAKTIFKAN DAN MENONAKTIFKAN LED X9
      ----------------------------------------*/
    $(".sliderLED").ionRangeSlider({
      onFinish: function (data) {
        var valled = data.from;
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math
          .random() * 100, 10));

        var optionsPub = {
          userName: "AdminMQTT",
          password: "pwd123",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            ledanimPub = new Paho.MQTT.Message(valled.toString());
            ledanimPub.destinationName = "/ledanim";
            clientPub.send(ledanimPub);
            clientPub.disconnect();
          },
        };
        clientPub.connect(optionsPub);
      },
    });

    /*------------------------------------
      MENGATUR KECEPATAN PUTAR FAN-PWM
      ------------------------------------*/
    $(".sliderFAN").ionRangeSlider({
      onFinish: function (data) {
        var valfan = data.from;
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math
          .random() * 100, 10));

        var optionsPub = {
          userName: "AdminMQTT",
          password: "pwd123",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            fanpwmPub = new Paho.MQTT.Message(valfan.toString());
            fanpwmPub.destinationName = "/fanpwm";
            clientPub.send(fanpwmPub);
            clientPub.disconnect();
          },
        };
        clientPub.connect(optionsPub);
      },
    });

    /*-------------------
      RELAY ON / OFF
      -------------------*/
    function RelayONOFF(checkbox) {
      var statusRelay;
      if (checkbox.checked) {
        statusRelay = "ON";
      } else {
        statusRelay = "OFF";
      }

      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "AdminMQTT",
        password: "pwd123",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          relayPub = new Paho.MQTT.Message(statusRelay);
          relayPub.destinationName = "relay";
          clientPub.send(relayPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
    }

    /*-------------------
    Fan1 ON / OFF
    -------------------*/
    function Fan1ONOFF(checkbox) {
      var statusFan1;
      if (checkbox.checked) {
        statusFan1 = "0";
      } else {
        statusFan1 = "1";
      }

      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "AdminMQTT",
        password: "pwd123",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan1Pub = new Paho.MQTT.Message(statusFan1);
          Fan1Pub.destinationName = "Fan1";
          clientPub.send(Fan1Pub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
    }
    /*-------------------
    Fan1 ON / OFF
    -------------------*/
    function Fan2ONOFF(checkbox) {
      var statusFan2;
      if (checkbox.checked) {
        statusFan2 = "0";
      } else {
        statusFan2 = "1";
      }

      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "AdminMQTT",
        password: "pwd123",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan2Pub = new Paho.MQTT.Message(statusFan2);
          Fan2Pub.destinationName = "Fan2";
          clientPub.send(Fan2Pub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
    }

    /*------------------
      PIEZO ON / OFF
      ------------------*/
    function PiezoONOFF(checkbox) {
      var statusBuzz;
      if (checkbox.checked) {
        statusBuzz = "ON";
      } else {
        statusBuzz = "OFF";
      }

      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "AdminMQTT",
        password: "pwd123",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          var buzzPub = new Paho.MQTT.Message(statusBuzz);
          buzzPub.destinationName = "/piezo";
          clientPub.send(buzzPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
    }
  </script>
<script type="text/javascript">
  function getSelectedValue(){
    var selectedValue = document.getElementById("listRoom").value;
    console.log(selectedValue);
  }
</script>
</body>
</html>