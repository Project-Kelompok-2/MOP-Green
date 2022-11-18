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
  <title>MOP Green | Map Page</title>
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
        <h4>Controlling</h4>
      </div>
      <div class="col-md-6">
        <h5 class="text-end text-white" id="time"></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card bg-dark h-100">
          <div class="card-header text-center">
            <h3>Manual Control</h3>
          </div>
          <div class="card-body">
            <div class="form-check form-switch">
              <div class="row">
                <h6 class="text-start">All Exhaust</h6>
                <input class="form-check-input align" type="checkbox" id="mySwitch1" value="yes">
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
      <div class="col-lg-3 col-md-6 col-sm-12 col-12">
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
              <div class="water2"></div>
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
      <div class="col-lg-3 col-md-6 col-sm-12 col-12">
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
      <div class="col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card bg-dark h-100">
          <div class="card-header text-center">
            <h4>Control Otomatis</h4>
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/water.js"></script>
<script src="js/script.js"></script>
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
    $(".water2").createWaterBall("updateRange", 100);
  }, 1000);
  const switch10 = document.getElementById("mySwitch10");
  const switch11 = document.getElementById("mySwitch11");
  const kotak8 = document.getElementById("kotak8");
  const kotak9 = document.getElementById("kotak9");

  switch10.addEventListener("change",()=>{
    kotak8.style.backgroundColor=switch10.checked===true?"green":"red";
  })
  switch11.addEventListener("change",()=>{
    kotak9.style.backgroundColor=switch11.checked===true?"green":"red";
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
  const switch1 = document.getElementById("mySwitch1");
  const switch2 = document.getElementById("mySwitch2");
  const switch3 = document.getElementById("mySwitch3");
  const switch4 = document.getElementById("mySwitch4");
  const switch5 = document.getElementById("mySwitch5");
  const switch6 = document.getElementById("mySwitch6");
  const switch7 = document.getElementById("mySwitch7");
  const switch8 = document.getElementById("mySwitch8");
  const switch9 = document.getElementById("mySwitch9");
  

  const kotak = document.getElementById("kotak");
  const kotak2 = document.getElementById("kotak2");
  const kotak3 = document.getElementById("kotak3");
  const kotak4 = document.getElementById("kotak4");
  const kotak5 = document.getElementById("kotak5");
  const kotak6 = document.getElementById("kotak6");
  const kotak7 = document.getElementById("kotak7");
  const kotak10 = document.getElementById("kotak10");

  switch2.addEventListener("change",()=>{
    kotak10.style.backgroundColor=switch2.checked===true?"green":"red";
  })
  switch3.addEventListener("change",()=>{
    kotak7.style.backgroundColor=switch3.checked===true?"green":"red";
  })
  switch4.addEventListener("change",()=>{
    kotak.style.backgroundColor=switch4.checked===true?"green":"red";
  })
  switch5.addEventListener("change",()=>{
    kotak2.style.backgroundColor=switch5.checked===true?"green":"red";
  })
  switch6.addEventListener("change",()=>{
    kotak3.style.backgroundColor=switch6.checked===true?"green":"red";
  })
  switch7.addEventListener("change",()=>{
    kotak4.style.backgroundColor=switch7.checked===true?"green":"red";
  })
  switch8.addEventListener("change",()=>{
    kotak5.style.backgroundColor=switch8.checked===true?"green":"red";
  })
  switch9.addEventListener("change",()=>{
    kotak6.style.backgroundColor=switch9.checked===true?"green":"red";
  })
</script>
</body>
</html>