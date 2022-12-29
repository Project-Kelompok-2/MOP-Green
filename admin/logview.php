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
  // $temp2 = $data["temp2"];
  // $hum2 = $data["humadity2"];

  $sql = "INSERT INTO data_sensor (temp1, hum1) VALUES ('$temp', '$hum')";
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
    .sht h3{
      color: #3751FF;
      font-weight: bold;
    }
    .klt h3{
      color: #FF0000;
      font-weight: bold;
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
            <span>CCTV View</span>
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
    <div class="card col-lg-4 col-md-4 col-sm-4 bg-dark mb-3">
      <div class="card-body">
        <div class="row text-white">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12 sht">
            <strong>Suhu 1</strong>
            <h3 id="hitTEMP">&deg;</h3>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12 klt">
            <strong>Kelembapan 1</strong>
            <h3 id="hitHUM"> <span>HR</span></h3>
          </div>
<!--           <div class="col-lg-3 col-md-3 col-sm-3 col-12 sht">
            <strong>Suhu 2</strong>
            <h3 id="hitTEMP2">&deg;</h3>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-12 klt">
            <strong>Kelembapan 2</strong>
            <h3 id="hitHUM2"> <span>HR</span></h3>
          </div> -->
        </div>
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
              <div class="col-sm-12 mb-4">
                <!-- <p class="text-center text-white">
                  <strong>Data</strong>
                </p> -->
                <div class="chart">                      
                  <canvas id="chartSS" height="200" style="height: 250px;"></canvas>    
                </div>                    
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
        <div class="card bg-dark">
          <div class="card-header text-white">
            <span class="me-2"><i class="bi bi-calendar"></i></span>
            Date Picker
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-5 col-md-4 col-sm-4 col-4">
                <form method="post">
                  <h5 class="text-start text-white">Time Data</h5>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8 col-8">
                  <select class="btn btn-dark text-start" id="listRange" onchange="getSelectedValue(this);">
                    <option value="please">Please Select</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="last3">Last 3 Days</option>
                    <option value="last1w">Last 1 Week</option>
                    <option value="last1m">Last 1 Month</option>
                    <option value="0">Custom Tanggal</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <h5 class="text-start text-white">From</h5>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                  <input type="date" class="form-control" id="date1" name="date1" style="cursor: pointer;" onchange="startDate(this)" disabled>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <h5 class="text-start text-white">To</h5>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                  <input type="date" class="form-control" id="date2" name="date2" style="cursor: pointer;" onchange="endDate(this)" disabled>
                </div>
              </div>
              <br>
              <!-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                  <button type="submit" class="btn btn-lg btn-primary text-light" id="buttons" name="buttons" style="cursor: pointer;">Apply</button>
                </div>
              </div> -->
            </form>
            <?php
            try{
              $sql = mysqli_query($koneksi, "SELECT * FROM data_sensor");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $t1[] = $row['temp1'];
                  $h1[] = $row['hum1'];
                  $waktu[] = $row['waktu'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
            ?>
            <?php 
            try{
              $sql = mysqli_query($koneksi, "SELECT waktu FROM data_sensor ORDER BY waktu desc");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $waktuTerbaru[] = $row['waktu'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
            ?>
            <?php 
            try{
              $sql = mysqli_query($koneksi, "SELECT waktu FROM data_sensor ORDER BY waktu asc");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $waktuLama[] = $row['waktu'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
            ?>
            <?php
            try{
              $sql = mysqli_query($koneksi, "SELECT * FROM data_sensor WHERE waktu >= CURDATE() - INTERVAL 1 DAY");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $Ytemp1[] = $row['temp1'];
                  $Yhum1[] = $row['hum1'];
                  $Ywaktu[] = $row['waktu'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
            ?>
            <?php
            try{
              $sql = mysqli_query($koneksi, "SELECT * FROM data_sensor WHERE waktu >= CURDATE() - INTERVAL 3 DAY");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $l3temp1[] = $row['temp1'];
                  $l3hum1[] = $row['hum1'];
                  $l3waktu[] = $row['waktu'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
            ?>
            <?php
            try{
              $sql = mysqli_query($koneksi, "SELECT * FROM data_sensor WHERE waktu >= CURDATE() - INTERVAL 1 WEEK");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $l1wtemp1[] = $row['temp1'];
                  $l1whum1[] = $row['hum1'];
                  $l1wwaktu[] = $row['waktu'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
            ?>
            <?php
            try{
              $sql = mysqli_query($koneksi, "SELECT * FROM data_sensor WHERE waktu >= CURDATE() - INTERVAL 1 MONTH");
              if ($sql->num_rows>0) {
                while ($row = $sql->fetch_assoc()) {
                  $l1mtemp1[] = $row['temp1'];
                  $l1mhum1[] = $row['hum1'];
                  $l1mwaktu[] = $row['waktu'];
                }
                unset($sql);
              }else{
                echo 'Ga ada';
              }
            }catch(Exception $e){
              die("error");
            }
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

<!-- Paho MQTT Client -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="path/to/test.js"></script>
<script>
    /*-----------------------------------------------------
  BAGIAN MQTT YANG TERKONEKSI DENGAN MESSAGE BROKER
  -----------------------------------------------------*/
    // Menentuan alamat IP dan PORT message broker
  var host = "159.223.72.149";
  var port = 9001;

    // Konstruktor koneksi antara client dan message broker
  var client = new Paho.MQTT.Client(host, port, "/ws",
    "myclientid2_" + parseInt(Math.random() * 100, 10));

    // Menjalin koneksi antara client dan message broker
  client.onConnectionLost = function (responseObject) {
      //document.getElementById("messages").innerHTML = "Koneksi Ke Broker MQTT Putus - " + responseObject.errorMessage + "<br/>";
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
   document.getElementById("hitHUM").innerHTML = (humadity1) + " HR";
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

   fetch('http://localhost/1.%20Kuliah/MOP-Green-newest/admin/controlling.php', {
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
      //document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT Sukses" + "<br/>";
    client.subscribe("sensor", {
      qos: 1
    });
  },

  onFailure: function (message) {
      //document.getElementById("messages").innerHTML += "Koneksi ke Broker MQTT Gagal - " + message.errorMessage + "<br/>";
  },

  userName: "",
  password: ""
};

if (location.protocol == "https:") {
  options.useSSL = true;
}


 // document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT - Alamat: " + host + ":" + port + "<br/>";
client.connect(options);
</script>

<script>
  const outputTemp1 = <?php echo json_encode($t1);?>;
  const outputHum1 = <?php echo json_encode($h1);?>;
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
      label: 'Suhu ',
      data: outputTemp1,
      backgroundColor: [
        'rgb(255, 99, 132)',
        ],
      borderColor: [
        'rgb(255, 99, 132)',
        ],
      borderWidth: 2,
      parsing: {
        xAxisKey: 'waktu',
        // yAxisKey: 'dataaa.Yt1';
      }
    }, {
      label: 'Kelembaban',
      data: outputHum1,
      backgroundColor: [
        'rgb(54, 162, 235)',
        ],
      borderColor: [
        'rgb(54, 162, 235)',
        ],
      borderWidth: 2,
      parsing: {
        xAxisKey: 'waktu',
        // yAxisKey: 'dataaa.Yh1';
      }
    }]
  };

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
  const chartSS = new Chart(
    document.getElementById('chartSS'),
    config
    );

  function startDate(date){
    const startDatee = new Date(date.value);
    console.log(startDatee.setHours(0, 0, 0, 0));
    chartSS.config.options.scales.x.min = startDatee.setHours(0, 0, 0, 0);
    chartSS.update();
  }
  function endDate(date){
    const endDatee = new Date(date.value);
    console.log(endDatee.setHours(0, 0, 0, 0));
    chartSS.config.options.scales.x.max = endDatee.setHours(0, 0, 0, 0);
    chartSS.update();
  }

  
  // var dataSelect = document.getElementById("listRange");
  // dataSelect.addEventListener("change", function() {
  // // get the selected option from the dropdown menu
  //   var selectedOption = this.options[this.selectedIndex].value;

  // // fetch the data for the selected option using AJAX
  //   fetch("/path/to/logview.php?option=" + selectedOption)
  //   .then(function(response) {
  //     return response.json();
  //   })
  //   .then(function(data) {
  //     // update the chart with the new data
  //     chartSS.data.labels = data.dateChartJS;
  //     chartSS.data.datasets[0].data = data.values;
  //     chartSS.update();
  //   });
  // });
  // SELECT * FROM data_sensor WHERE waktu BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE();
  
  function getSelectedValue(option){
    // var mysql = require('mysql2');

    // var con = mysql.createConnection({
    //   host: "localhost",
    //   user: "root",
    //   password: "",
    //   database : "mop_green"
    // });
    var selectedValue = document.getElementById("listRange").value;
    console.log(selectedValue);
    let sqlQuery = '';
    if (selectedValue == 'yesterday') {
      const ywaktu2 = <?php echo json_encode($Ywaktu);?>;
      const dateChartJSS = ywaktu2.map((day, index) => {
        let dayjss = new Date(day);
        console.log(dayjss);
        return dayjss.setHours(0, 0, 0, 0);
      });
      document.getElementById('date1').disabled = true;
      document.getElementById('date2').disabled = true;
      chartSS.data.datasets[0].data = <?php echo json_encode($Ytemp1);?>;
      chartSS.data.datasets[1].data = <?php echo json_encode($Yhum1);?>;
      chartSS.data.labels = dateChartJSS;
      chartSS.update();
    }else if(selectedValue == 'last3'){
      const ywaktu2 = <?php echo json_encode($l3waktu);?>;
      const dateChartJSS = ywaktu2.map((day, index) => {
        let dayjss = new Date(day);
        console.log(dayjss);
        return dayjss.setHours(0, 0, 0, 0);
      });
      document.getElementById('date1').disabled = true;
      document.getElementById('date2').disabled = true;
      chartSS.data.datasets[0].data = <?php echo json_encode($l3temp1);?>;
      chartSS.data.datasets[1].data = <?php echo json_encode($l3hum1);?>;
      chartSS.data.labels = dateChartJSS;
      chartSS.update();
    }else if(selectedValue == 'last1w'){
      const ywaktu2 = <?php echo json_encode($l1wwaktu);?>;
      const dateChartJSS = ywaktu2.map((day, index) => {
        let dayjss = new Date(day);
        console.log(dayjss);
        return dayjss.setHours(0, 0, 0, 0);
      });
      document.getElementById('date1').disabled = true;
      document.getElementById('date2').disabled = true;
      chartSS.data.datasets[0].data = <?php echo json_encode($l1wtemp1);?>;
      chartSS.data.datasets[1].data = <?php echo json_encode($l1whum1);?>;
      chartSS.data.labels = dateChartJSS;
      chartSS.update();
    }else if(selectedValue == 'last1m'){
      const ywaktu2 = <?php echo json_encode($l1mwaktu);?>;
      const dateChartJSS = ywaktu2.map((day, index) => {
        let dayjss = new Date(day);
        console.log(dayjss);
        return dayjss.setHours(0, 0, 0, 0);
      });
      document.getElementById('date1').disabled = true;
      document.getElementById('date2').disabled = true;
      chartSS.data.datasets[0].data = <?php echo json_encode($l1mtemp1);?>;
      chartSS.data.datasets[1].data = <?php echo json_encode($l1mhum1);?>;
      chartSS.data.labels = dateChartJSS;
      chartSS.update();
    }else if(selectedValue == 'please'){
      document.getElementById('date1').disabled = true;
      document.getElementById('date2').disabled = true;
      chartSS.update();
    }else{
      const ywaktu2 = <?php echo json_encode($waktu);?>;
      const dateChartJSS = ywaktu2.map((day, index) => {
        let dayjss = new Date(day);
        console.log(dayjss);
        return dayjss.setHours(0, 0, 0, 0);
      });
      document.getElementById('date1').disabled = false;
      document.getElementById('date2').disabled = false;
      chartSS.data.datasets[0].data = <?php echo json_encode($t1);?>;
      chartSS.data.datasets[1].data = <?php echo json_encode($h1);?>;
      chartSS.data.labels = dateChartJSS;
      chartSS.update();
    }
    // function selectedValue2(){
    //   if () {}
    // }
  }
  // function getSelectedValue(){
  //   var selectedValue = document.getElementById("listRange").value;
  //   console.log(selectedValue);
  //   selectedValue.onchange = function(){
  //     if (selectedValue == 'today' || selectedValue == 'yesterday' || selectedValue == 'last3' || selectedValue == 'last1w' || selectedValue == 'last1m') {
  //       document.getElementById('date1').disabled = true;
  //       document.getElementById('date2').disabled = true;
  //       document.querySelector('#buttons').disabled = false;
  //     }else{
  //       document.getElementById('date1').disabled = false;
  //       document.getElementById('date2').disabled = false;
  //       document.querySelector('#buttons').disabled = true;
  //     }
  //   }
    // document.getElementById('listRange').addEventListener('change', function() {
    //   var timePeriod = this.value;
    //   var querys = 'SELECT * FROM data_sensor WHERE waktu BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE()';
    //   if (timePeriod == 'yesterday') {
    //     connection.query("SELECT * FROM data_sensor WHERE waktu BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE()", function(err, rows) {
    //       if (err) throw err;

    //   // Format the data and add it to the response object
    //       rows.forEach(function(row) {
    //         data.labels.push(row.labels);
    //         data.datasets.data.push(row.data);
    //       });

    //   // Send the response back to the client
    //       res.json(data);
    //     });
    //     chartSS.update();
    //   }
    // });
  // }
</script>

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
<script type="text/javascript">
  // function getSelectedValue(){
  //   var selectedValue = document.getElementById("listRange").value;
  //   console.log(selectedValue);
  //   if (selectedValue == 'today' || selectedValue == 'yesterday' || selectedValue == 'last3' || selectedValue == 'last1w' || selectedValue == 'last1m') {
  //     document.getElementById('date1').disabled = true;
  //     document.getElementById('date2').disabled = true;
  //     document.querySelector('#buttons').disabled = false;
  //   }else{
  //     document.getElementById('date1').disabled = false;
  //     document.getElementById('date2').disabled = false;
  //     document.querySelector('#buttons').disabled = true;
  //   }
  // }
</script>
</body>
</html>