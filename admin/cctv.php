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
  <title>MOP Green | CCTV Page</title>
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
          <a href="logview.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-view-list"></i></span>
            <span>Log View</span>
          </a>
        </li>
        <li>
          <a href="cctv.php" class="nav-link px-3 active">
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
      <div class="col-md-12">
        <h4 class="text-white">CCTV Monitoring</h4>
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
      <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card bg-dark">
          <div class="card-body text-white">
            <h3><strong>CCTV 1</strong></h3>
            <img src="http://20.20.0.237:81/stream" class="img-fluid" width="1600" height="1200">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card bg-dark">
          <div class="card-body text-white">
            <h3><strong>CCTV 2</strong></h3>
            <img src="http://20.20.0.238:81/stream" class="img-fluid" width="1920" height="768">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card bg-dark">
          <div class="card-body text-white">
            <h3><strong>CCTV 3</strong></h3>
            <img src="http://10.10.7.167:81/stream" class="img-fluid" width="1920" height="768">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
        <div class="card bg-dark">
          <div class="card-body text-white">
            <h3><strong>CCTV 4</strong></h3>
            <img src="http://10.10.7.168:81/stream" class="img-fluid" width="1920" height="768">
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
<!-- Paho MQTT Client -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
</script>
</body>
</html>