<?php 
require("../koneksi.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  // var_dump($data);
  // die();
  if (mysqli_connect_errno()) {
    echo "Koneksi Gagal :".mysqli_connect_error();
  }
  $temp = $data["temp1"];
  $hum = $data["humadity1"];
  $temp2 = $data["temp2"];
  $hum2 = $data["humadity2"];

  $sql = "INSERT INTO data_sensor (temp1, hum1, temp2, hum2) VALUES ('$temp', '$hum', '$temp2', '$hum2')";
  mysqli_query($koneksi, $sql);
  // result
  header('Content-type: application/json');
  echo json_encode([]);
  die();
}

if(!isset($_SESSION['id'])){
  $_SESSION['msg'] = 'anda harus log in  untuk mengakses halaman ini';
  header('Location:../login.php');
}
$sesID = $_SESSION['id'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['level'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
  />
  <!-- <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" /> -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="../img/logo2.png" type="image/x-icon" />
  <title>MOP Green | Home Page</title>
  <style type="text/css">
    .sht h3{
      color: #3751FF;
      font-weight: bold;
    }
    .klt h3{
      color: #FF0000;
      font-weight: bold;
    }
    body{
      background-color: #2e3338;
    }
  </style>
</head>
<body >
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
      <?php if ($sesLvl==1): ?>
        <li>
          <a href="controlling.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-cpu"></i></span>
            <span>Controlling</span>
          </a>
        </li>
      <?php endif ?>
      <li>
        <a href="logview.php" class="nav-link px-3">
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
      <div class="col-md-6 text-white">
        <h4>Dashboard</h4>
      </div>
      <div class="col-md-6">
        <h5 class="text-end text-white" id="time"></h5>
      </div>
    </div>
    <div class="card col-lg-7 col-md-7 col-sm-7 bg-dark">
      <div class="card-body">
        <div class="row text-white">
          <div class="col-lg-3 col-md-3 col-sm-3 col-12 sht">
            <strong>Suhu 1</strong>
            <h3 id="hitTEMP">&deg;</h3>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-12 klt">
            <strong>Kelembapan 1</strong>
            <h3 id="hitHUM"> <span>HR</span></h3>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-12 sht">
            <strong>Suhu 2</strong>
            <h3 id="hitTEMP2">&deg;</h3>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-12 klt">
            <strong>Kelembapan 2</strong>
            <h3 id="hitHUM2"> <span>HR</span></h3>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-3">
        <select class="btn btn-dark text-start" id="listRoom" onchange="getSelectedValue();">
          <option value="Room 1">Room 1</option>
          <option value="Room 2">Room 2</option>
          <option value="Room 3">Room 3</option>
        </select>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
       <div class="alert alert-primary alert-dismissible">
        <h5><strong>Status Koneksi Broker MQTT</strong></h5>
        <div id="messages"></div>
      </div>      
    </div>          
  </div>
  <div class="row mb-3">
    <div class="col-lg-9 col-md-6 col-sm-6 col-6 mb-8">
      <div class="card h-100 bg-dark text-white">
        <div class="card-header">
          <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
          Chart Data Room 1
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <p class="text-center">
                <strong>Suhu</strong>
              </p>
              <div class="chart">                      
                <canvas id="chartTEMP" height="180" style="height: 180px;"></canvas>            
              </div>                    
            </div>
            <div class="col-sm-6">
              <p class="text-center">
                <strong>Kelembapan</strong>
              </p>
              <div class="chart">                      
                <canvas id="chartHUM" height="180" style="height: 180px;"></canvas>           
              </div>                    
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4">
      <div class="card h-100 bg-dark text-white">
        <div class="card-header">
          <!-- <span class="me-2"><i class="bi bi-speedometer"></i></span> -->
          <h4 class="text-center" style="margin-bottom: -4px; font-weight: bold;">TODAY</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 text-center sht">
              <h7>Suhu Tertinggi</h7>
              <h3>&deg;</h3>
            </div>
            <div class="col-md-6 text-center klt">
              <h7>Kelembapan Tertinggi</h7>
              <h3>51 <span>HR</span></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 text-center sht">
              <h7>Suhu Terendah</h7>
              <h3>51&deg;</h3>
            </div>
            <div class="col-md-6 text-center klt">
              <h7>Kelembapan Terendah</h7>
              <h3>51 <span>HR</span></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 text-center sht">
              <h7>Rata - Rata Suhu</h7>
              <h3>51&deg;</h3>
            </div>
            <div class="col-md-6 text-center klt">
              <h7>Rata - Rata Kelembapan</h7>
              <h3>51 <span>HR</span></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>
<script src="js/bootstrap.bundle.min.js"></script>
<!-- <script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap5.min.js"></script> -->
<!-- <script src="js/script.js"></script> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
     humadity2 = data["humadity2"]
     temp2 = data["temp2"]
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
   document.getElementById("hitTEMP2").innerHTML = temp2 + " °C";
   document.getElementById("hitHUM2").innerHTML = humadity2 + " HR";
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
   var obj = {"temp1":temp1, "humadity1":humadity1,"temp2":temp2, "humadity2":humadity2};
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

    //Onload semua Chart
  window.onload = function () {
      // onload chart temperatur sensor DHT11
    var ctxTEMP = document.getElementById('chartTEMP').getContext('2d');
    window.chartTEMP = new Chart(ctxTEMP, configTEMP);

      // onload chart kelembaban sensor DHT11
    var ctxHUM = document.getElementById('chartHUM').getContext('2d');
    window.chartHUM = new Chart(ctxHUM, configHUM);
  };

</script>
<script type="text/javascript">
  function getSelectedValue(){
    var selectedValue = document.getElementById("listRoom").value;
    console.log(selectedValue);
  }
</script>
</body>
</html>