<?php 
require("../koneksi.php");

session_start();

if(!isset($_SESSION['id'])){
  $_SESSION['msg'] = 'anda harus log in  untuk mengakses halaman ini';
  header('Location:../login.php');
}
$sesID = $_SESSION['id'];
$sesFN = $_SESSION['nama_depan'];
$sesLN = $_SESSION['nama_belakang'];
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
                <h8><?=$sesFN;?> <?=$sesLN;?></h8>
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
      <div class="col-md-6 mb-2">
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
                  <canvas id="chartTEMP" height="200" style="height: 250px;"></canvas>            
                </div>                    
              </div>
              <div class="col-sm-6">
                <p class="text-center text-white">
                  <strong>Kelembapan</strong>
                </p>
                <div class="chart">                      
                  <canvas id="chartHUM" height="200" style="height: 250px;"></canvas>           
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
                  <option value="1">Yesterday</option>
                  <option value="1">Last 3 Days</option>
                  <option value="1">Last 1 Week</option>
                  <option value="1">Last 1 Month</option>
                  <option value="0">Custom Tanggal</option>
                </select>
              </div>
            </div>
            <br>
            <form method="post">


              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <h5 class="text-start text-white">From</h5>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                  <input type="date" class="form-control" id="date1" name="date1" style="cursor: pointer;" onchange="startDate(this)">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <h5 class="text-start text-white">To</h5>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                  <input type="date" class="form-control" id="date2" name="date2" style="cursor: pointer;">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                  <button type="submit" class="btn btn-primary text-light" name="button" style="cursor: pointer;">Button</button>
                </div>
              </div>
            </form>
            <?php
            try{
              $sql = mysqli_query($koneksi, "SELECT * FROM data_sensor");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $t1[] = $row['temp1'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
            print_r($t1);
            // if (isset($_POST['button'])) {
            //   if (isset($_GET['date1']) && isset($_GET['date2'])) {
            //     $from = $_GET['date1'];
            //     $to = $_GET['date2'];
            //     $data = mysqli_query($koneksi, "SELECT * FROM data_sensor WHERE waktu BETWEEN '$from' AND '$to'");
            //     if (mysqli_num_rows($data)>0) {
            //       foreach ($data as $key) {
            //         echo $key['temp1'];
            //       }
            //     }else{
            //       echo 'No Record Data';
            //     }
            //   }
            // } 
            // $post_at = "";
            // $post_at_to_date = "";

            // $queryCondition = "";
            // if(!empty($_POST["search"]["waktu"])) {     
            //   $post_at = $_POST["search"]["waktu"];
            //   list($fid,$fim,$fiy) = explode("-",$post_at);

            //   $post_at_todate = date('Y-m-d');
            //   if(!empty($_POST["search"]["waktu"])) {
            //     $post_at_to_date = $_POST["search"]["waktu"];
            //     list($tid,$tim,$tiy) = explode("-",$_POST["search"]["waktu"]);
            //     $post_at_todate = "$tiy-$tim-$tid";
            //   }

            //   $queryCondition .= "WHERE waktu BETWEEN '$fiy-$fim-$fid' AND '" . $post_at_todate . "'";
            // }

            // $sql = "SELECT * from data_sensor " . $queryCondition . " ORDER BY waktu desc";
            // $result = mysqli_query($koneksi,$sql);
            ?>

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
  var host = "20.20.0.245";
  var port = 9001;

    // Konstruktor koneksi antara client dan message broker
  var client = new Paho.MQTT.Client(host, port, "/ws",
    "myclientid_" + parseInt(Math.random() * 100, 10));

    // Menjalin koneksi antara client dan message broker
  client.onConnectionLost = function (responseObject) {
    document.getElementById("messages").innerHTML = "Koneksi Ke Broker MQTT Putus - " + responseObject.errorMessage + "<br/>";
  };

    // variabel global data sensor IoT Development Board
    // website berposisi sebagai subscriber
  var humadity1 = 0;
  var temp1 = 0;

    // Mendapatkan payload dari transimisi data IoT Development Board
    // kemudian memilah dan melimpahkanya ke varibael berdasarkan TOPIC.
  client.onMessageArrived = function (message) {
    console.log(message)
    if (message.destinationName == "sensor") {
     console.log(message.payloadString)
     const data = JSON.parse(message.payloadString)
     humadity1 = data["humadity1"]
     temp1 = data["temp1"]
   }
      // if (message.destinationName == "ldr") {
      //  ldr = message.payloadString;
      // } else if (message.destinationName == "sr04") {
      //  sr04 = message.payloadString; 
      // // else if (message.destinationName == "dht") {
      // //   var dht = JSON.parse(message.payloadString);
      // //   humi = dht.kelembaban;
      // //   temp = dht.suhu;
      // } else if (message.destinationName == "temp") {
      //  temp = message.payloadString;


      // } else if (message.destinationName == "humadity") {
      //  humadity = message.payloadString;
      // }

      // else if (message.destinationName == "/remoteir") {
      //  keypad = message.payloadString;


   document.getElementById("hitTEMP").innerHTML = temp1 + " °C";
   document.getElementById("hitHUM").innerHTML = humadity1 + " HR";
      //document.write(temp);
      //console.log(temp);
      //$.post('http:/localhost/iot/insert.php', { "temp" : temp});
      //now = {"temp&humadity": [
      //{"temp": "25", "humadity": "45"},
      //{"temp": "26", "humadity": "44"}
        //]};
      //var x=2; var y='am';
      //k={"temp":"'+temp+'","humadity":"'+humadity+'"};
      //now.events.push(k);
      //console.log(now);
      //JSONObject.temp = temp;
   var obj = {"temp1":temp1, "humadity1":humadity1};
   console.log(obj);
      //const data = { username: 'example' };

   fetch('http://localhost/1.%20Kuliah/MOP-Green/admin/home.php', {
              method: 'POST', // or 'PUT'
            //   headers: {
            //     'Content-Type': 'application/json',
            //   },
              body: JSON.stringify(obj),
            })
   .then((response) => response.json())
   .then((data) => {
    console.log('Success:', data);
  })
            //   .catch((error) => {
            //     console.error('Error:', error);
            //   });
      //require('fs').writeFile('file.json', JSON.stringify(obj), (error) => {
              //    if (error) {
                //      throw error;
                  // }
              // });
        //var datas = obj;
        //var txtFile = "/tmp/test.txt";
              //var file = new File(txtFile,"write");
              //var datas = JSON.stringify(JsonExport);

              //log("opening file...");
              //file.open(); 
              //log("writing file..");
              //file.writeline(datas);
              //file.close();
 };
    // Option mqtt dengan mode subscribe dan qos diset 1
 var options = {
  timeout: 60,
  keepAliveInterval: 30,
  onSuccess: function () {
    document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT Sukses" + "<br/>";
    client.subscribe("sensor", {
      qos: 1
    });
  },

  onFailure: function (message) {
    document.getElementById("messages").innerHTML += "Koneksi ke Broker MQTT Gagal - " + message.errorMessage + "<br/>";
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
  const temp1Output = <?php echo json_encode($t1); ?>;
  console.log(temp1Output);
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
      y: temp1
    });
  }

  var configTEMP = {
    type: 'line',
    data: {
      datasets: [{
        label: 'Temperatur (°C)',
        data: [],
        backgroundColor: color(chartColors.red).alpha(0.6).rgbString(),
        borderColor: chartColors.red,
        borderWidth: 1
      }]
    },

    options: {
      title: {
        display: true,
        text: dinoiki
      },

      scales: {
        xAxes: [{
          type: 'static',
          // min: '2022-12-01',
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
      y: humadity1
    });
  }

  var configHUM = {
    type: 'line',
    data: {
      datasets: [{
        label: 'Kelembaban (H)',
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
          type: 'static',
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

    //Onload semua Chart
  window.onload = function () {
      // onload chart temperatur sensor DHT11
    var ctxTEMP = document.getElementById('chartTEMP').getContext('2d');
    window.chartTEMP = new Chart(ctxTEMP, configTEMP);

      // onload chart kelembaban sensor DHT11
    var ctxHUM = document.getElementById('chartHUM').getContext('2d');
    window.chartHUM = new Chart(ctxHUM, configHUM);
  };
  function startDate(date){
    const startDatee = new Date(date.value);
    console.log(startDatee)
    configTEMP.scales.xAxes.min = startDatee;
    config.update();
  }
</script>
<script type="text/javascript">
  function getSelectedValue(){
    var selectedValue = document.getElementById("listRoom").value;
    console.log(selectedValue);
    if (selectedValue == 1) {
      document.getElementById('date1').disabled = true;
      document.getElementById('date2').disabled = true;
    }else{
      document.getElementById('date1').disabled = false;
      document.getElementById('date2').disabled = false;
    }
  }
</script>
</body>
</html>



    section{
      justify-content: center;
      min-height: 100vh;
      width: 100%;
    }
<div id="chartContainer" style="height: 100%; width: 100%;"></div>
<script type="text/javascript">
  var loadingEle = $("water1");
  var loading_width = loadingEle.width(),
  loading_height = loadingEle.height();

  var loadingEle2 = $("water2");
  var loading_width2 = loadingEle2.width(),
  loading_height2 = loadingEle2.height();

  $(".water1").createWaterBall({
    csv_config: {
      width: loading_width,
      height: loading_height
    },
    wave_config: {
      waveWidth: 0.02,
      waveHeight: 5
    },
    data_range: [30, 70, 100],
    isLoading: true,
    nowRange: 70,
    targetRange: 45
  });
  $(".water2").createWaterBall({
    csv_config: {
      width: loading_width2,
      height: loading_height2
    },
    wave_config: {
      waveWidth: 0.02,
      waveHeight: 5
    },
    data_range: [30, 70, 100],
    isLoading: true,
    nowRange: 70,
    targetRange: 70
  });
  setTimeout(function() {
    $(".water1").createWaterBall("updateRange", 50);
  }, 1000);
  setTimeout(function() {
    $(".water2").createWaterBall("updateRange", 90);
  }, 1000);
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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Getting Started with Chart JS with www.chartjs3.com</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(255, 26, 104, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(255, 26, 104, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(255, 26, 104, 1);
        background: white;
      }
    </style>
  </head>
  <body>
    <div class="chartMenu">
      <p>WWW.CHARTJS3.COM (Chart JS 3.9.1)</p>
    </div>
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // setup 
    const data = {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Weekly Sales',
        data: [18, 12, 6, 9, 12, 3, 9],
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    </script>

  </body>
</html>


<script>
  const waktuOutput = <?php echo json_encode($waktu);?>;
  console.log(waktuOutput);

  const dateChartJS = waktuOutput.map((day, index) => {
    let dayjs = new Date(day);
    console.log(dayjs);
    return dayjs.setHours(0, 0, 0, 0);
  });
    // setup 
  const data = {
    labels: dateChartJS,
    datasets: [{
      label: 'Suhu',
      data: <?php echo json_encode($t1);?>,
      backgroundColor: [
        'rgba(255, 0, 0, 1)',
        ],
      borderColor: [
        'rgba(255, 0, 0, 1)',
        ],
      borderWidth: 1
    }]
  };

  const datas = {
    labels: dateChartJS,
    datasets: [{
      label: 'Kelembaban',
      data: <?php echo json_encode($t1); ?>,
      backgroundColor: [
        'rgba(0, 8, 250, 1)',
        ],
      borderColor: [
        'rgba(0, 8, 250, 1)',
        ],
      borderWidth: 1
    }]
  };

  const configs = {
    type: 'line',
    datas,
    options: {
      scales: {
        x: {
          min: <?php echo json_encode($waktuLama);?>,
          max: <?php echo json_encode($waktuTerbaru);?>,
          type: 'time',
          time: {
            unit: 'day',
          }
        },
        y: {
          beginAtZero: true
        }
      }
    }
  };

    // config 
  const config = {
    type: 'line',
    data,
    options: {
      scales: {
        x: {
          min: <?php echo json_encode($waktuLama);?>,
          max: <?php echo json_encode($waktuTerbaru);?>,
          type: 'time',
          time: {
            unit: 'day',
          }
        },
        y: {
          beginAtZero: true
        }
      }
    }
  };

    // render init block
  const chartSuhu = new Chart(
    document.getElementById('chartSuhu'),
    config
    );

  const chartKelembaban = new Chart(
    document.getElementById('chartKelembaban'),
    configs
    );

  function startDate(date){
    const startDatee = new Date(date.value);
    console.log(startDatee.setHours(0, 0, 0, 0));
    chartSuhu.config.options.scales.x.min = startDatee.setHours(0, 0, 0, 0);
    chartSuhu.update();
  }
  function endDate(date){
    const endDatee = new Date(date.value);
    console.log(endDatee.setHours(0, 0, 0, 0));
    chartSuhu.config.options.scales.x.max = endDatee.setHours(0, 0, 0, 0);
    chartSuhu.update();
  }
</script>

<script>




  function startDate(date){
    const startDatee = new Date(date.value);
    console.log(startDatee.setHours(0, 0, 0, 0));
    chartKelembaban.config.options.scales.x.min = startDatee.setHours(0, 0, 0, 0);
    chartKelembaban.update();
  }
  function endDate(date){
    const endDatee = new Date(date.value);
    console.log(endDatee.setHours(0, 0, 0, 0));
    chartKelembaban.config.options.scales.x.max = endDatee.setHours(0, 0, 0, 0);
    chartKelembaban.update();
  }
</script>