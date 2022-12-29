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
  <title>MOP Green | Controlling Page</title>
  <style type="text/css">
    main .card {
      color: white;
    }
    .card-header:hover{
      color: #356AF1;
      font-weight: bold;
    }
    .form-check{
      padding: 5px;
    }
    .form-check input:hover{
      cursor: pointer;
    }
    .kotak1{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak2{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak3{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak4{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak5{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak6{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak7{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak8{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .kotak9{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
      /*box-shadow: 0px 0px 10px 0.5px #FF0000;*/
    }
    .kotak10{
      margin-left: -5px;
      width: 20px;
      height: 20px;
      background-color: red;
    }
    .water1{
      width: 130px;
      height: 130px;

    }
    .water2{
      width: 130px;
      height: 130px;
    }
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
            <a href="controlling.php" class="nav-link px-3 active">
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
      <div class="col-md-6 text-white">
        <h4>Controlling</h4>
      </div>
      <div class="col-md-6">
        <h5 class="text-end text-white" id="time"></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
        <div class="card bg-dark h-100">
          <div class="card-header text-center">
            <h3>Manual Control</h3>
          </div>
          <div class="card-body">
            <div class="form-check form-switch">
              <div class="row">
                <h6 class="text-start">Semua Fan</h6>
                <input class="form-check-input align" type="checkbox" id="mySwitch1" value="yes" onchange="handleFirstSliderChange(event)" onclick="return confirm('Anda yakin..?')">
              </div>
              <!-- <label class="form-check-label" for="mySwitch"></label> -->
            </div>
            <div class="form-check form-switch">
              <div class="row">
                <h6 class="text-start">Fresh Water</h6>
                <input class="form-check-input align" type="checkbox" id="mySwitch2" value="yes">
              </div>
              <!-- <label class="form-check-label" for="mySwitch"></label> -->
            </div>
            <div class="form-check form-switch">
              <div class="row">
                <h6 class="text-start">Pompa Misting</h6>
                <input class="form-check-input align" type="checkbox" id="mySwitch3" value="yes">
              </div>
              <!-- <label class="form-check-label" for="mySwitch"></label> -->
            </div>
            <div class="form-check form-switch">
              <div class="row">
               <!-- Switch fan 1 -->
               <h6 class="text-start">Exhaust Fan 1</h6>
               <input class="form-check-input align" type="checkbox" id="mySwitch4" value="yes" onclick="return confirm('Anda yakin..?')">
             </div>
             <!-- <label class="form-check-label" for="mySwitch"></label> -->
           </div>
           <div class="form-check form-switch">
            <div class="row">
              <h6 class="text-start">Exhaust Fan 2</h6>
              <input class="form-check-input align" type="checkbox" id="mySwitch5" value="yes" onclick="return confirm('Anda yakin..?')">
            </div>
            <!-- <label class="form-check-label" for="mySwitch"></label> -->
          </div>
          <div class="form-check form-switch">
            <div class="row">
              <h6 class="text-start">Exhaust Fan 3</h6>
              <input class="form-check-input align" type="checkbox" id="mySwitch6" value="yes" onclick="return confirm('Anda yakin..?')">
            </div>
            <!-- <label class="form-check-label" for="mySwitch"></label> -->
          </div>
          <div class="form-check form-switch">
            <div class="row">
              <h6 class="text-start">Exhaust Fan 4</h6>
              <input class="form-check-input align" type="checkbox" id="mySwitch7" value="yes" onclick="return confirm('Anda yakin..?')">
            </div>
            <!-- <label class="form-check-label" for="mySwitch"></label> -->
          </div>
          <div class="form-check form-switch">
            <div class="row">
              <h6 class="text-start">Cooling Pad 1</h6>
              <input class="form-check-input align" type="checkbox" id="mySwitch8" value="yes">
            </div>
            <!-- <label class="form-check-label" for="mySwitch"></label> -->
          </div>
          <div class="form-check form-switch">
            <div class="row">
              <h6 class="text-start">Cooling Pad 2</h6>
              <input class="form-check-input align" type="checkbox" id="mySwitch9" value="yes">
            </div>
            <!-- <label class="form-check-label" for="mySwitch"></label> -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
      <div class="card bg-dark h-100">
        <div class="card-header text-center">
          <h3>Pompa Nutrisi</h3>
        </div>
        <div class="card-body">
          <div class="row align-items-center text-center">
            <h5 class="">Nutrisi 1</h5>
            <div class="water1"></div>
          </div>
          <div class="form-check form-switch">
            <div class="row">
              <h5 class="text-start">Pompa Irigasi 1</h5>
              <input class="form-check-input align" type="checkbox" id="mySwitch10" value="yes">
            </div>
            <!-- <label class="form-check-label" for="mySwitch"></label> -->
          </div>
          <div class="row align-items-center text-center">
            <h5 class="text-center">Nutrisi 2</h5>
            <div class="water2 text-center"></div>
          </div>
          <div class="form-check form-switch">
            <div class="row">
              <h5 class="text-start">Pompa Irigasi 2</h5>
              <input class="form-check-input align" type="checkbox" id="mySwitch11" value="yes">
            </div>
            <!-- <label class="form-check-label" for="mySwitch"></label> -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
      <div class="card bg-dark h-100">
        <div class="card-header text-center">
          <h3>Status Akuator</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak1" id="kotak" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">B Fan 1</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak2" id="kotak2" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">B Fan 2</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak3" id="kotak3" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">B Fan 3</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak4" id="kotak4" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">B Fan 4</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak5" id="kotak5" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">Cooling Pad 1</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak6" id="kotak6" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">Cooling Pad 2</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak7" id="kotak7" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">Pengkabutan</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak8" id="kotak8" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">Pompa N1</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak9" id="kotak9" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">Pompa N2</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-sm-1 col-1">
              <input class="kotak10" id="kotak10" disabled></input>
            </div>
            <div class="col-md-10 col-sm-10 col-10">
              <h4 class="">Fresh Water</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-12 mb-2">
      <div class="card bg-dark h-100">
        <div class="card-header text-center">
          <h4>Control Otomatis</h4>
        </div>
        <div class="card-body">
          <div class="row text-white text-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 sht">
              <strong>Suhu 1</strong>
              <h3 id="hitTEMP">&deg;</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 klt">
              <strong>Kelembapan 1</strong>
              <h3 id="hitHUM"> <span>HR</span></h3>
            </div>
          </div>
          <div class="form-check form-switch ">
            <div class="row">
              <h5 class="text-start" style="margin-left: -5px;">Otomatis</h5>

              <input class="form-check-input align-items-end" type="checkbox" id="mySwitch12" value="yes" >
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-lg-6">
              <h5 class="text-start">Exhaust ON : Suhu Atas</h5>
            </div>
            <div class="col-lg-6 text-end">
              <input class="input-group-field text-center" type="number" value="0" min="0" oninput="this.value = Math.abs(this.value);" style="width: 20%;" id="suhuatas">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-lg-6">
              <h5 class="text-start">Exhaust OFF : Suhu Bawah</h5>
            </div>
            <div class="col-lg-6 text-end">
              <input class="input-group-field text-center" type="number" value="0" min="0" oninput="this.value = Math.abs(this.value);" style="width: 20%;" id="suhubawah">
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-lg-6">
              <h5 class="text-start">Kelembaban Atas - ON</h5>
            </div>
            <div class="col-lg-6 text-end">
              <input class="input-group-field text-center" type="number" value="0" min="0" oninput="this.value = Math.abs(this.value);" style="width: 20%;" id="kelembabanatas">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <h5 class="text-start">Kelembaban Bawah - OFF</h5>
            </div>
            <div class="col-lg-6 text-end">
              <input class="input-group-field text-center" type="number" value="0" min="0" oninput="this.value = Math.abs(this.value);" style="width: 20%;" id="kelembabanbawah">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<!-- Paho MQTT Client -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script type="text/javascript">
  var timeDisplay = document.getElementById("time");
  function refreshTime() {
    var dateString = new Date().toLocaleString("en-US", {timeZone: "Asia/Jakarta"});
    var formattedString = dateString.replace(", ", " - ");
    timeDisplay.innerHTML = formattedString;
  }

  setInterval(refreshTime, 1000);
  var host = "
  ";
  var port = 9001;
  var client = new Paho.MQTT.Client(host, port, "/ws",
    "myclientid_" + parseInt(Math.random() * 100, 10));
  </script> -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/water.js"></script>
  <script src="js/script.js"></script>
  <!-- <script type="text/javascript">
    var timeDisplay = document.getElementById("time");
    function refreshTime() {
      var dateString = new Date().toLocaleString("en-US", {timeZone: "Asia/Jakarta"});
      var formattedString = dateString.replace(", ", " - ");
      timeDisplay.innerHTML = formattedString;
    }

    setInterval(refreshTime, 1000);
  </script> -->
  <script>
//     const switch12 = document.getElementById("mySwitch12");
//     setInterval(function() {
//   switch12.click();
// }, 5000);
  </script>
  <script>

  var host = "159.223.72.149";
  var port = 9001;

    // Konstruktor koneksi antara client dan message broker
  var client = new Paho.MQTT.Client(host, port, "/ws",
    "myclientid_" + parseInt(Math.random() * 100, 10));

    // Menjalin koneksi antara client dan message broker
  client.onConnectionLost = function (responseObject) {
    //document.getElementById("messages").innerHTML = "Koneksi Ke Broker MQTT Putus - " + responseObject.errorMessage + "<br/>";
  };

    // variabel global data sensor IoT Development Board
    // website berposisi sebagai subscriber
  var twater1 = 0;
  var twater2 = 0;
  
    // Mendapatkan payload dari transimisi data IoT Development Board
    // kemudian memilah dan melimpahkanya ke varibael berdasarkan TOPIC.
  client.onMessageArrived = function (message) {
    console.log(message)
    if (message.destinationName == "twater") {
     console.log(message.payloadString)
     const data = JSON.parse(message.payloadString)
     twater1 = data["twater1"]
     twater2 = data["twater2"]
      var objwater = {"twater1": twater1, "twater2": twater2};
      console.log(objwater);
     // console.log(twater1);
   }}

   //subscribe topic twater
  var options = {
    timeout: 60,
    keepAliveInterval: 30,
    onSuccess: function () {
      //document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT Sukses" + "<br/>";
      client.subscribe("twater", {
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
  // var objwater = {"twater1": twater1, "twater2": twater2};
  //    console.log(objwater);
  client.connect(options);
 // document.getElementById("messages").innerHTML += "Koneksi Ke Broker MQTT - Alamat: " + host + ":" + port + "<br/>";
  

   //
    var loadingEle = $(".water1");
    var loading_width = loadingEle.width(),
    loading_height = loadingEle.height();
    $(".water1").createWaterBall({
      cvs_config: {
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
      targetRange: 70
    });
    setTimeout(function() {
      $(".water1").createWaterBall("updateRange", 70);
    }, 1000);

  </script>

  <script>
    var loadingEle = $(".water2");
    var loading_width = loadingEle.width(),
    loading_height = loadingEle.height();
    $(".water2").createWaterBall({
      cvs_config: {
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
      targetRange: 70
    });
    setTimeout(function() {
      $(".water2").createWaterBall("updateRange", 20);
    }, 1000);
    const switch10 = document.getElementById("mySwitch10");
    const switch11 = document.getElementById("mySwitch11");
    const kotak8 = document.getElementById("kotak8");
    const kotak9 = document.getElementById("kotak9");

    switch10.addEventListener("change",()=>{
      var statusPompaN1 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
      if (switch10.checked == true){    
        statusPompaN1 = "1";
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var optionsPub = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            PompaN1Pub = new Paho.MQTT.Message(statusPompaN1);
            PompaN1Pub.destinationName = "PompaN1";
            clientPub.send(PompaN1Pub);
            clientPub.disconnect();
          },
        };
        clientPub.connect(optionsPub);
        kotak8.style.backgroundColor="green";
      }if (switch10.checked == false){    
        statusPompaN1 = "0";
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var optionsPub = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            PompaN1Pub = new Paho.MQTT.Message(statusPompaN1);
            PompaN1Pub.destinationName = "PompaN1";
            clientPub.send(PompaN1Pub);
            clientPub.disconnect();
          },
        };
        clientPub.connect(optionsPub);
        kotak8.style.backgroundColor="red";
      }


    })
    switch11.addEventListener("change",()=>{
      var statusPompaN2 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
      if (switch11.checked == true){    
        statusPompaN2 = "1";
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var optionsPub = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            PompaN2Pub = new Paho.MQTT.Message(statusPompaN2);
            PompaN2Pub.destinationName = "PompaN2";
            clientPub.send(PompaN2Pub);
            clientPub.disconnect();
          },
        };
        clientPub.connect(optionsPub);
        kotak9.style.backgroundColor="green";
      }if (switch11.checked == false){    
        statusPompaN2 = "0";
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var optionsPub = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            PompaN2Pub = new Paho.MQTT.Message(statusPompaN2);
            PompaN2Pub.destinationName = "PompaN2";
            clientPub.send(PompaN2Pub);
            clientPub.disconnect();
          },
        };
        clientPub.connect(optionsPub);
        kotak9.style.backgroundColor="red";
      }


    })
  // if(switch11==true)
  //   setTimeout(function() {
  //   $(".water2").createWaterBall("updateRange", 100);
  // }, 1000);
  // else
  //   setTimeout(function() {
  //   $(".water2").createWaterBall("updateRange", 40);
  // }, 1000);
  </script>
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
  const switch1 = document.getElementById("mySwitch1");
  const switch2 = document.getElementById("mySwitch2");
  const switch3 = document.getElementById("mySwitch3");
  const switch4 = document.getElementById("mySwitch4");
  const switch5 = document.getElementById("mySwitch5");
  const switch6 = document.getElementById("mySwitch6");
  const switch7 = document.getElementById("mySwitch7");
  const switch8 = document.getElementById("mySwitch8");
  const switch9 = document.getElementById("mySwitch9");
  // const switch10 = document.getElementById("mySwitch10");
  // const switch11 = document.getElementById("mySwitch11");
  const switch12 = document.getElementById("mySwitch12");

  const kotak = document.getElementById("kotak");
  const kotak2 = document.getElementById("kotak2");
  const kotak3 = document.getElementById("kotak3");
  const kotak4 = document.getElementById("kotak4");
  const kotak5 = document.getElementById("kotak5");
  const kotak6 = document.getElementById("kotak6");
  const kotak7 = document.getElementById("kotak7");
  // const kotak7 = document.getElementById("kotak8");
  // const kotak7 = document.getElementById("kotak9");
  const kotak10 = document.getElementById("kotak10");
  const suhuatas = document.getElementById("suhuatas");
  const suhubawah = document.getElementById("suhubawah");
  const kelembabanatas = document.getElementById("kelembabanatas");
  const kelembabanbawah = document.getElementById("kelembabanbawah");

  function handleFirstSliderChange(event) {
    if (event.target.checked && !switch4.checked && !switch5.checked && !switch6.checked && !switch7.checked) {
      switch4.checked = true;
      var statusFan1 = "0";
      switch5.checked = true;
      var statusFan2 = "0"; 
      switch6.checked = true;
      var statusFan3 = "0"; 
      switch7.checked = true;
      var statusFan4 = "0";  
      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
      if (switch4.checked == true && switch5.checked == true && switch6.checked == true && switch7.checked == true){    
        statusFan1 = "1";
        statusFan2 = "1";
        statusFan3 = "1";
        statusFan4 = "1";
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var clientPub2 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var clientPub3 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var clientPub4 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var optionsPub = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan1Pub = new Paho.MQTT.Message(statusFan1);
            Fan1Pub.destinationName = "Fan1";
            clientPub.send(Fan1Pub);
            clientPub.disconnect();
          },
        };
        var optionsPub2 = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan2Pub = new Paho.MQTT.Message(statusFan2);
            Fan2Pub.destinationName = "Fan2";
            clientPub2.send(Fan2Pub);
            clientPub2.disconnect();
          },
        };
        var optionsPub3 = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan3Pub = new Paho.MQTT.Message(statusFan3);
            Fan3Pub.destinationName = "Fan3";
            clientPub3.send(Fan3Pub);
            clientPub3.disconnect();
          },
        };
        var optionsPub4 = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan4Pub = new Paho.MQTT.Message(statusFan4);
            Fan4Pub.destinationName = "Fan4";
            clientPub4.send(Fan4Pub);
            clientPub4.disconnect();
          },
        };
        clientPub.connect(optionsPub);
        kotak.style.backgroundColor="green";
        clientPub2.connect(optionsPub2);
        kotak2.style.backgroundColor="green";
        clientPub3.connect(optionsPub3);
        kotak3.style.backgroundColor="green";
        clientPub4.connect(optionsPub4);
        kotak4.style.backgroundColor="green";
      }

    }else{
      switch4.checked = false;
      var statusFan1 = "0";
      switch5.checked = false;
      var statusFan2 = "0"; 
      switch6.checked = false;
      var statusFan3 = "0"; 
      switch7.checked = false;
      var statusFan4 = "0";

      if (switch4.checked == false && switch5.checked == false && switch6.checked == false && switch7.checked == false){    
        statusFan1 = "0";
        statusFan2 = "0";
        statusFan3 = "0";
        statusFan4 = "0";
        var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var clientPub2 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var clientPub3 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var clientPub4 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
        var optionsPub = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan1Pub = new Paho.MQTT.Message(statusFan1);
            Fan1Pub.destinationName = "Fan1";
            clientPub.send(Fan1Pub);
            clientPub.disconnect();
          },
        };
        var optionsPub2 = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan2Pub = new Paho.MQTT.Message(statusFan2);
            Fan2Pub.destinationName = "Fan2";
            clientPub2.send(Fan2Pub);
            clientPub2.disconnect();
          },
        };
        var optionsPub3 = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan3Pub = new Paho.MQTT.Message(statusFan3);
            Fan3Pub.destinationName = "Fan3";
            clientPub3.send(Fan3Pub);
            clientPub3.disconnect();
          },
        };
        var optionsPub4 = {
          userName: "",
          password: "",
          timeout: 3,
          keepAliveInterval: 30,
          onSuccess: function () {
            Fan4Pub = new Paho.MQTT.Message(statusFan4);
            Fan4Pub.destinationName = "Fan4";
            clientPub4.send(Fan4Pub);
            clientPub4.disconnect();
          },
        };
        clientPub.connect(optionsPub);
        kotak.style.backgroundColor="red";
        clientPub2.connect(optionsPub2);
        kotak2.style.backgroundColor="red";
        clientPub3.connect(optionsPub3);
        kotak3.style.backgroundColor="red";
        clientPub4.connect(optionsPub4);
        kotak4.style.backgroundColor="red";
      }      
    }
  }
  // switch1.addEventListener('click', function(){
  //   if (switch1.checked == true) {
  //     switch2.checked == true;
  //     switch5.checked == true;
  //     switch6.checked == true;
  //     switch7.checked == true;
  //   }else{
  //     switch4.checked == false;
  //     switch5.checked == false;
  //     switch6.checked == false;
  //     switch7.checked == false;
  //   }
  // });
// setInterval(function() {
//   switch12.click();
// }, 5000);
  switch12.addEventListener("change",()=>{
    if (switch12.checked == true) {
      var suhu_atas = document.getElementById("suhuatas").value;
      var suhu_bawah = document.getElementById("suhubawah").value;
      var kelembapan_atas = document.getElementById("kelembabanatas").value;
      var kelembapan_bawah = document.getElementById("kelembabanbawah").value;

      // Store JSON data in a JS variable
      var json = {"suhu_atas": suhu_atas, "suhu_bawah": suhu_bawah, "kelembapan_atas": kelembapan_atas, "kelembapan_bawah": kelembapan_bawah};
 
      // Converting JSON-encoded string to JS object
       var objautocontrol = JSON.stringify(json);
      console.log(json)
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          autocontrolPub = new Paho.MQTT.Message(objautocontrol);
          autocontrolPub.destinationName = "auto_control";
          clientPub.send(autocontrolPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      switch1.disabled = true;
      switch2.disabled = true;
      switch3.disabled = true;
      switch4.disabled = true;
      switch5.disabled = true;
      switch6.disabled = true;
      switch7.disabled = true;
      switch8.disabled = true;
      switch9.disabled = true;
      switch10.disabled = true;
      switch11.disabled = true;
      suhuatas.disabled = true;
      suhubawah.disabled = true;
      kelembabanatas.disabled = true;
      kelembabanbawah.disabled = true;
    }else{
      var suhu_atas = "0";
    var suhu_bawah = "0";
    var kelembapan_atas = "0";
    var kelembapan_bawah = "0"; 
    var json = {"suhu_atas": suhu_atas, "suhu_bawah": suhu_bawah, "kelembapan_atas": kelembapan_atas, "kelembapan_bawah": kelembapan_bawah};
 
      // Converting JSON-encoded string to JS object
    var objautocontrol = JSON.stringify(json);
    console.log(json)

      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          autocontrolPub = new Paho.MQTT.Message(objautocontrol);
          autocontrolPub.destinationName = "auto_control";
          clientPub.send(autocontrolPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      switch1.disabled = false;
      switch2.disabled = false;
      switch3.disabled = false;
      switch4.disabled = false;
      switch5.disabled = false;
      switch6.disabled = false;
      switch7.disabled = false;
      switch8.disabled = false;
      switch9.disabled = false;
      switch10.disabled = false;
      switch11.disabled = false;
      suhuatas.disabled = false;
      suhubawah.disabled = false;
      kelembabanatas.disabled = false;
      kelembabanbawah.disabled = false;
    }
  });

  switch2.addEventListener("change",()=>{
    var statusFreshWater = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch2.checked == true){    
      statusFreshWater = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          FreshWaterPub = new Paho.MQTT.Message(statusFreshWater);
          FreshWaterPub.destinationName = "FreshWater";
          clientPub.send(FreshWaterPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak10.style.backgroundColor="green";
    }if (switch2.checked == false){    
      statusFreshWater = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          FreshWaterPub = new Paho.MQTT.Message(statusFreshWater);
          FreshWaterPub.destinationName = "FreshWater";
          clientPub.send(FreshWaterPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak10.style.backgroundColor="red";
    }


  })
  switch3.addEventListener("change",()=>{
    var statusPompaMisting = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch3.checked == true){    
      statusPompaMisting = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          PompaMistingPub = new Paho.MQTT.Message(statusPompaMisting);
          PompaMistingPub.destinationName = "PompaMisting";
          clientPub.send(PompaMistingPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak7.style.backgroundColor="green";
    }if (switch3.checked == false){    
      statusPompaMisting = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          PompaMistingPub = new Paho.MQTT.Message(statusPompaMisting);
          PompaMistingPub.destinationName = "PompaMisting";
          clientPub.send(PompaMistingPub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak7.style.backgroundColor="red";
    }


  })
  switch4.addEventListener("change",()=>{
    var statusFan1 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch4.checked == true){    
      statusFan1 = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan1Pub = new Paho.MQTT.Message(statusFan1);
          Fan1Pub.destinationName = "Fan1";
          clientPub.send(Fan1Pub);
          clientPub.disconnect();
        },
      };
      switch1.disabled = true;
      clientPub.connect(optionsPub);
      kotak.style.backgroundColor="green";
    }if (switch4.checked == false){    
      statusFan1 = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan1Pub = new Paho.MQTT.Message(statusFan1);
          Fan1Pub.destinationName = "Fan1";
          clientPub.send(Fan1Pub);
          clientPub.disconnect();
        },
      };
      if (switch5.checked == true || switch6.checked == true || switch7.checked == true) {
        switch1.disabled = true;  
      }else{
        switch1.disabled = false;
      }
      clientPub.connect(optionsPub);
      kotak.style.backgroundColor="red";
    }

  })
  switch5.addEventListener("change",()=>{
    var statusFan2 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch5.checked == true){    
      statusFan2 = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan2Pub = new Paho.MQTT.Message(statusFan2);
          Fan2Pub.destinationName = "Fan2";
          clientPub.send(Fan2Pub);
          clientPub.disconnect();
        },
      };
      switch1.disabled = true;
      clientPub.connect(optionsPub);
      kotak2.style.backgroundColor="green";
    }if (switch5.checked == false){    
      statusFan2 = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan2Pub = new Paho.MQTT.Message(statusFan2);
          Fan2Pub.destinationName = "Fan2";
          clientPub.send(Fan2Pub);
          clientPub.disconnect();
        },
      };
      if (switch4.checked == true || switch6.checked == true || switch7.checked == true) {
        switch1.disabled = true;  
      }else{
        switch1.disabled = false;
      }
      clientPub.connect(optionsPub);
      kotak2.style.backgroundColor="red";
    }
  })
  switch6.addEventListener("change",()=>{
    var statusFan3 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch6.checked == true){    
      statusFan3 = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan3Pub = new Paho.MQTT.Message(statusFan3);
          Fan3Pub.destinationName = "Fan3";
          clientPub.send(Fan3Pub);
          clientPub.disconnect();
        },
      };
      switch1.disabled = true;
      clientPub.connect(optionsPub);
      kotak3.style.backgroundColor="green";
    }if (switch6.checked == false){    
      statusFan3 = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan3Pub = new Paho.MQTT.Message(statusFan3);
          Fan3Pub.destinationName = "Fan3";
          clientPub.send(Fan3Pub);
          clientPub.disconnect();
        },
      };
      if (switch4.checked == true || switch5.checked == true || switch7.checked == true) {
        switch1.disabled = true;  
      }else{
        switch1.disabled = false;
      }
      clientPub.connect(optionsPub);
      kotak3.style.backgroundColor="red";
    }


  })
  switch7.addEventListener("change",()=>{
    var statusFan4 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch7.checked == true){    
      statusFan4 = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan4Pub = new Paho.MQTT.Message(statusFan4);
          Fan4Pub.destinationName = "Fan4";
          clientPub.send(Fan4Pub);
          clientPub.disconnect();
        },
      };
      switch1.disabled = true;
      clientPub.connect(optionsPub);
      kotak4.style.backgroundColor="green";
    }if (switch7.checked == false){    
      statusFan4 = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          Fan4Pub = new Paho.MQTT.Message(statusFan4);
          Fan4Pub.destinationName = "Fan4";
          clientPub.send(Fan4Pub);
          clientPub.disconnect();
        },
      };
      if (switch4.checked == true || switch5.checked == true || switch6.checked == true) {
        switch1.disabled = true;  
      }else{
        switch1.disabled = false;
      }
      clientPub.connect(optionsPub);
      kotak4.style.backgroundColor="red";
    }


  })
  switch8.addEventListener("change",()=>{
    var statusCoolPad1 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch8.checked == true){    
      statusCoolPad1 = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          CoolPad1Pub = new Paho.MQTT.Message(statusCoolPad1);
          CoolPad1Pub.destinationName = "CoolPad1";
          clientPub.send(CoolPad1Pub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak5.style.backgroundColor="green";
    }if (switch8.checked == false){    
      statusCoolPad1 = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          CoolPad1Pub = new Paho.MQTT.Message(statusCoolPad1);
          CoolPad1Pub.destinationName = "CoolPad1";
          clientPub.send(CoolPad1Pub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak5.style.backgroundColor="red";
    }


  })
  switch9.addEventListener("change",()=>{
    var statusCoolPad2 = "0"; 

      // <!-- if (checkbox.checked) {
      // <!-- statusFan1 = "0";
      // <!--} else {
      // <!-- statusFan1 = "1";
      // <!--} -->
    if (switch9.checked == true){    
      statusCoolPad2 = "1";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          CoolPad2Pub = new Paho.MQTT.Message(statusCoolPad2);
          CoolPad2Pub.destinationName = "CoolPad2";
          clientPub.send(CoolPad2Pub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak6.style.backgroundColor="green";
    }if (switch9.checked == false){    
      statusCoolPad2 = "0";
      var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
      var optionsPub = {
        userName: "",
        password: "",
        timeout: 3,
        keepAliveInterval: 30,
        onSuccess: function () {
          CoolPad2Pub = new Paho.MQTT.Message(statusCoolPad2);
          CoolPad2Pub.destinationName = "CoolPad2";
          clientPub.send(CoolPad2Pub);
          clientPub.disconnect();
        },
      };
      clientPub.connect(optionsPub);
      kotak6.style.backgroundColor="red";
    }


  })
  // switch12.addEventListener("change",()=>{
  //   // var suhu_atas = "0";
  //   // var suhu_bawah = "0";
  //   // var kelembapan_atas = "0";
  //   // var kelembapan_bawah = "0"; 

  //     // <!-- if (checkbox.checked) {
  //     // <!-- statusFan1 = "0";
  //     // <!--} else {
  //     // <!-- statusFan1 = "1";
  //     // <!--} -->
  //   if (switch12.checked == true){    
  //     var suhu_atas = document.getElementById("suhuatas");
  //     var suhu_bawah = document.getElementById("suhubawah");
  //     var kelembapan_atas = document.getElementById("kelembabanatas");
  //     var kelembapan_bawah = document.getElementById("kelembabanbawah");

  //     // Store JSON data in a JS variable
  //     var json = '{"suhu_atas": suhu_atas, "suhu_bawah": suhu_bawah, "kelembapan_atas": kelembapan_atas, "kelembapan_bawah": kelembapan_bawah}';
 
  //     // Converting JSON-encoded string to JS object
  //     var objautocontrol = JSON.parse(json);
  //     console.log(json)
  //     var clientPub100 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
  //     var optionsPub100 = {
  //       userName: "",
  //       password: "",
  //       timeout: 3,
  //       keepAliveInterval: 30,
  //       onSuccess: function () {
  //         autocontrolPub = new Paho.MQTT.Message(objautocontrol);
  //         autocontrolPub.destinationName = "auto_control";
  //         clientPub.send(autocontrolPub);
  //         clientPub.disconnect();
  //       },
  //     };
  //     clientPub100.connect(optionsPub100);
  //     // kotak10.style.backgroundColor="green";
  //   }if (switch12.checked == false){    
  //     var suhu_atas = "0";
  //   var suhu_bawah = "0";
  //   var kelembapan_atas = "0";
  //   var kelembapan_bawah = "0"; 
  //   var json = '{"suhu_atas": suhu_atas, "suhu_bawah": suhu_bawah, "kelembapan_atas": kelembapan_atas, "kelembapan_bawah": kelembapan_bawah}';
 
  //     // Converting JSON-encoded string to JS object
  //     var objautocontrol = JSON.parse(json);

  //     var clientPub100 = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
  //     var optionsPub100 = {
  //       userName: "",
  //       password: "",
  //       timeout: 3,
  //       keepAliveInterval: 30,
  //       onSuccess: function () {
  //         autocontrolPub = new Paho.MQTT.Message(objautocontrol);
  //         autocontrolPub.destinationName = "auto_control";
  //         clientPub.send(autocontrolPub);
  //         clientPub.disconnect();
  //       },
  //     };
  //     clientPub100.connect(optionsPub100);
  //     // kotak10.style.backgroundColor="red";
  //   }


  // })
  // switch10.addEventListener("change",()=>{
  //   var statusPompaN1 = "0"; 

  //    // <!-- if (checkbox.checked) {
  //    // <!-- statusFan1 = "0";
  //    // <!--} else {
  //    // <!-- statusFan1 = "1";
  //    // <!--} -->
  //   if (switch10.checked == true){    
  //     statusPompaN1 = "1";
  //    var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
  //    var optionsPub = {
  //      userName: "",
  //      password: "",
  //      timeout: 3,
  //      keepAliveInterval: 30,
  //      onSuccess: function () {
  //        PompaN1Pub = new Paho.MQTT.Message(statusPompaN1);
  //        PompaN1Pub.destinationName = "PompaN1";
  //        clientPub.send(PompaN1Pub);
  //        clientPub.disconnect();
  //      },
  //    };
  //    clientPub.connect(optionsPub);
  //    kotak8.style.backgroundColor="green";
  //  }if (switch10.checked == false){    
  //     statusPompaN1 = "0";
  //    var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
  //    var optionsPub = {
  //      userName: "",
  //      password: "",
  //      timeout: 3,
  //      keepAliveInterval: 30,
  //      onSuccess: function () {
  //        PompaN1Pub = new Paho.MQTT.Message(statusPompaN1);
  //        PompaN1Pub.destinationName = "PompaN1";
  //        clientPub.send(PompaN1Pub);
  //        clientPub.disconnect();
  //      },
  //    };
  //    clientPub.connect(optionsPub);
  //    kotak8.style.backgroundColor="red";
  //  }


  // })
  // switch11.addEventListener("change",()=>{
  //   var statusPompaN2 = "0"; 

  //    // <!-- if (checkbox.checked) {
  //    // <!-- statusFan1 = "0";
  //    // <!--} else {
  //    // <!-- statusFan1 = "1";
  //    // <!--} -->
  //   if (switch11.checked == true){    
  //     statusPompaN2 = "1";
  //    var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
  //    var optionsPub = {
  //      userName: "",
  //      password: "",
  //      timeout: 3,
  //      keepAliveInterval: 30,
  //      onSuccess: function () {
  //        PompaN2Pub = new Paho.MQTT.Message(statusPompaN2);
  //        PompaN2Pub.destinationName = "PompaN2";
  //        clientPub.send(PompaN2Pub);
  //        clientPub.disconnect();
  //      },
  //    };
  //    clientPub.connect(optionsPub);
  //    kotak9.style.backgroundColor="green";
  //  }if (switch11.checked == false){    
  //     statusPompaN2 = "0";
  //    var clientPub = new Paho.MQTT.Client(host, port, "/ws", "myclientidPub_" + parseInt(Math.random() * 100, 10));
  //    var optionsPub = {
  //      userName: "",
  //      password: "",
  //      timeout: 3,
  //      keepAliveInterval: 30,
  //      onSuccess: function () {
  //        PompaN2Pub = new Paho.MQTT.Message(statusPompaN2);
  //        PompaN2Pub.destinationName = "PompaN2";
  //        clientPub.send(PompaN2Pub);
  //        clientPub.disconnect();
  //      },
  //    };
  //    clientPub.connect(optionsPub);
  //    kotak9.style.backgroundColor="red";
  //  }


  // })

</script>
</body>
</html>