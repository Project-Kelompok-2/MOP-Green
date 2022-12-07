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
              <div class="col-sm-12 mb-4">
                <p class="text-center text-white">
                  <strong></strong>
                </p>
                <div class="chart">                      
                  <canvas id="chartSS" height="200" style="height: 250px;"></canvas>    
                </div>                    
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card bg-dark">
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
                <select class="btn btn-dark text-start" id="listRange" onchange="getSelectedValue();">
                  <option value="yesterday">Yesterday</option>
                  <option value="last3">Last 3 Days</option>
                  <option value="last1w">Last 1 Week</option>
                  <option value="last1m">Last 1 Month</option>
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
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                  <button type="submit" class="btn btn-primary text-light" id="buttons" name="buttons" style="cursor: pointer;">Button</button>
                </div>
              </div>
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
      label: 'Suhu ',
      data: <?php echo json_encode($t1);?>,
      backgroundColor: [
        'rgba(0, 8, 250, 1)',
        ],
      borderColor: [
        'rgba(0, 8, 250, 1)',
        ],
      borderWidth: 2
    }, {
      label: ' Kelembaban',
      data: <?php echo json_encode($h1);?>,
      backgroundColor: [
        'rgba(255, 0, 0, 1)',
        ],
      borderColor: [
        'rgba(255, 0, 0, 1)',
        ],
      borderWidth: 2
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
  function getSelectedValue(){
    var selectedValue = document.getElementById("listRange").value;
    console.log(selectedValue);
    if (selectedValue == 'yesterday' || selectedValue == 'last3' || selectedValue == 'last1w' || selectedValue == 'last1m') {
      document.getElementById('date1').disabled = true;
      document.getElementById('date2').disabled = true;
      document.querySelector('#buttons').disabled = false;
    }else{
      document.getElementById('date1').disabled = false;
      document.getElementById('date2').disabled = false;
      document.querySelector('#buttons').disabled = true;
    }
  }
</script>
</body>
</html>