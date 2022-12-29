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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="../img/logo2.png" type="image/x-icon" />
  <title>MOP Green | Manage User Page</title>
  <style type="text/css">
    body{
      background-color: #2e3338;
    }
    .pagination a{
      text-decoration: none;
      color: white;
      font-weight: bold;
      border-style: groove;
      padding: 2px;
    }
    .inpt-pass{
      color: white;
      font-weight: bold;
      width: 100%;
      height: 100%;
      background-color: #212529;
      outline: none;
    }
    .sht h3{
      color: #3751FF;
      font-weight: bold;
    }
    .klt h3{
      color: #FF0000;
      font-weight: bold;
    }
    .iconn{
      float: right;
      margin-right: 10px;
      margin-top: -30px;
      position: relative;
      z-index: 2;
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
          <a href="cctv.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-camera"></i></span>
            <span>CCTV View</span>
          </a>
        </li>
        <?php if ($sesLvl==1): ?>
          <li>
            <a href="manage_user.php" class="nav-link px-3 active">
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
        <h4 class="text-white">Manage User</h4>
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
    <div class="row mb-2">
      <div class="text-end">
        <button class="btn btn-success" type="button" data-bs-toggle='modal' data-bs-target='#tmbh'>
          <i class="fa fa-plus-circle"></i>
        </button>
        <!-- <a href='#tmbh' data-bs-target='#tmbh' id='tmbh' data-bs-toggle='modal' data-id="tmbh" class="btn btn-success"><strong>Tambah</strong></a> -->
      </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal" id="tmbh">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title"><i class="bi bi-people"></i> Tambah User</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form onsubmit="return validate();" action="proses_insert_user.php" method="POST">
              <div class="row">

                <div class="col">
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typeNamaDepan">Nama Depan</label>
                    <input type="text" id="typeNamaDepan" name="txt_nama_depan" class="form-control form-control-lg" pattern="^[a-zA-Z\s'-].{1,15}" title="tidak boleh lebih dari 15 karakter dan hanya huruf" required />
                  </div>
                </div>

                <div class="col">
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typeNamaBelakang">Nama Belakang</label>
                    <input type="text" id="typeNamaBelakang" name="txt_nama_belakang" class="form-control form-control-lg" pattern="^[a-zA-Z\s'-].{1,15}" title="tidak boleh lebih dari 15 karakter dan hanya huruf" />
                  </div>
                </div>
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeUsername">Asal Institusi</label>
                <input type="text" id="typeAsalInstitusi" name="txt_asal_institusi" class="form-control form-control-lg" pattern="^[a-zA-Z\s'-].{1,50}" title="tidak boleh lebih dari 50 karakter dan hanya huruf" required />
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeUsername">Kegiatan</label>
                <input type="text" id="typeKegiatan" name="txt_kegiatan" class="form-control form-control-lg" required />
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeEmailX">Email</label>
                <input type="email" id="typeEmailX" name="txt_email" class="form-control form-control-lg" required />
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typePasswordX">Password</label>
                <input type="password" id="inpt-pass5" name="txt_password" class="form-control form-control-lg" pattern="(?=.*\d)(?=.*[a-z]).{6,}" title="Password Harus Memiliki 6 Karakter dan Minimal Mengandung Huruf Dan Angka" required />
                <span class="far fa-eye iconn" id="togglePassword5" style="cursor: pointer;"></span>
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeConfirmPassword">Confirm Password</label>
                <input type="password" id="inpt-pass2" class="form-control form-control-lg" />
                <span class="far fa-eye iconn" id="togglePassword2" style="cursor: pointer;"></span>
              </div>
              <div class="mt-4 mb-0">
                <div class="d-grid">
                  <button type="submit" name="tmbh" class="btn btn-primary btn-block">
                    Add User
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <!-- End Modal Tambah -->

    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card bg-dark">
          <div class="card-header text-white">
            <span class="me-2"><i class="bi bi-table"></i></span>
            Data User
          </div>
          <div class="card-body">
            <table class="table table-dark text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Depan</th>
                  <th>Nama Belakang</th>
                  <th>Asal Institusi</th>
                  <th>Kegiatan</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php
              $halaman = 5;
              $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
              $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
              $result = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE level=2");
              $total = mysqli_num_rows($result);
              $pages = ceil($total/$halaman);
              $no =$mulai+1;

              // $results_per_page = 5;  
              // $query = "SELECT * FROM user_detail WHERE level=2";
              // $result = mysqli_query($koneksi,$query);
              // $number_of_result = mysqli_num_rows($result);
              // $number_of_page = ceil ($number_of_result / $results_per_page);
              // if (!isset ($_GET['page']) ) {  
              //   $page = 1;  
              // } else {  
              //   $page = $_GET['page'];  
              // }
              // $page_first_result = ($page-1) * $results_per_page;
              // $query2 = "SELECT * FROM user_detail".$page_first_result . ',' . $results_per_page;
              // $result2 = mysqli_query($koneksi, $query);   
              // $no = 1;
              $result2 = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE level=2 LIMIT $mulai, $halaman")or die(mysqli_error);
              while($row = mysqli_fetch_array($result2)){
                $nama_depan = $row['nama_depan'];
                $nama_belakang = $row['nama_belakang'];
                $asalInstitusi = $row['asal_institusi'];
                $kegiatan = $row['kegiatan'];
                $email = $row['email'];
                $password = $row['password'];

                ?>
                <tbody>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $nama_depan; ?></td>
                    <td><?php echo $nama_belakang; ?></td>
                    <td><?php echo $asalInstitusi; ?></td>
                    <td><?php echo $kegiatan; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><input class="inpt-pass text-center" id="inpt-pass-<?= $no; ?>" type="password" value="<?php echo $password; ?>" disabled></input></td>
                    <td>
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                          <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin..?');"><i class="bi bi-trash" style="cursor: pointer; color: black;"></i></a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                          <a href='#editlogin' data-bs-target='#editlogin<?php echo $row['id'];?>' id='<?php echo $row['id'];?>' data-bs-toggle='modal' data-id="<?php echo $row['id'];?>" class="btn btn-info btn-sm"><i class="bi bi-pencil" style="cursor: pointer;"></i></a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                          <button class="btn btn-light btn-sm" onclick="changePass(<?= $no; ?>); return confirm('Anda yakin ingin melihat password <?= $nama_depan; ?> ?')">
                            <i class="far fa-eye" id="togglePassword-<?= $no; ?>" style="cursor: pointer;"></i>
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <div class="modal" id="editlogin<?php echo $row['id'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title"><i class="bi bi-people"></i> Edit User</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                          <form method="post">
                            <input class="form-control" id="inputEmail" type="hidden" name="txt_id" value="<?php echo $row['id']?>" />
                            <div class="row">

                              <div class="col">
                                <div class="form-outline form-white mb-4">
                                  <label class="form-label" for="typeNamaDepan">Nama Depan</label>
                                  <input type="text" id="typeNamaDepan" name="txt_nama_depan" class="form-control form-control-lg" value="<?=$row['nama_depan'];?>" pattern="^[a-zA-Z\s'-].{1,15}" title="tidak boleh lebih dari 15 karakter dan hanya huruf" required />
                                </div>
                              </div>

                              <div class="col">
                                <div class="form-outline form-white mb-4">
                                  <label class="form-label" for="typeNamaBelakang">Nama Belakang</label>
                                  <input type="text" id="typeNamaBelakang" name="txt_nama_belakang" class="form-control form-control-lg" value="<?=$row['nama_belakang'];?>" pattern="^[a-zA-Z\s'-].{1,15}" title="tidak boleh lebih dari 15 karakter dan hanya huruf" />
                                </div>
                              </div>
                            </div>

                            <div class="form-outline form-white mb-4">
                              <label class="form-label" for="typeUsername">Asal Institusi</label>
                              <input type="text" id="typeAsalInstitusi" name="txt_asal_institusi" class="form-control form-control-lg" value="<?=$row['asal_institusi'];?>" pattern="^[a-zA-Z\s'-].{1,50}" title="tidak boleh lebih dari 50 karakter dan hanya huruf" required />
                            </div>

                            <div class="form-outline form-white mb-4">
                              <label class="form-label" for="typeUsername">Kegiatan</label>
                              <input type="text" id="typeKegiatan" name="txt_kegiatan" class="form-control form-control-lg" value="<?=$row['kegiatan'];?>" required />
                            </div>

                            <div class="form-outline form-white mb-4">
                              <label class="form-label" for="typeEmailX">Email</label>
                              <input type="email" id="typeEmailX" name="txt_email" class="form-control form-control-lg" value="<?=$row['email'];?>" required />
                            </div>

                            <div class="form-outline form-white mb-4">
                              <label class="form-label" for="typePasswordX">Password</label>
                              <input type="password" id="inpt-pass3" name="txt_password" class="form-control form-control-lg" pattern="(?=.*\d)(?=.*[a-z]).{6,}" title="Password Harus Memiliki 6 Karakter dan Minimal Mengandung Huruf Dan Angka" value="<?=$row['password'];?>" required />
                              <span class="far fa-eye iconn" id="togglePassword3" style="cursor: pointer;"></span>
                            </div>

                            <div class="form-outline form-white mb-4">
                              <label class="form-label" for="typeConfirmPassword">Confirm Password</label>
                              <input type="password" id="inpt-pass4" class="form-control form-control-lg" />
                              <span class="far fa-eye iconn" id="togglePassword4" style="cursor: pointer;"></span>
                            </div>
                            <div class="mt-4 mb-0">
                              <div class="d-grid">
                                <button type="submit" name="update" class="btn btn-primary btn-block">
                                  Confirm
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <?php
                  $no++;
                } 
                ?>

              </tbody>
            </table>
            <!-- <?php 
            // for($page = 1; $page<= $number_of_page; $page++) {
            //   echo '<nav aria-label="Page navigation">';
            //   echo '<ul class="pagination">';  
            //   echo '<li class="page-item bg-light"><a class="pagination" href = "manage_user.php?page=' . $page . '">' . $page . ' </a></li>';
            //   echo '</ul>';
            //   echo '</nav>';  
            // }
          ?> -->
          <div class="pagination">

            <?php for ($i=1; $i<=$pages ; $i++){ ?>
              <?php if ($i == $page) : ?>
                <a class="bg-success" style="font-weight: bold; color: white;" href="?halaman=<?php echo $i; ?>">&nbsp;<?php echo $i; ?>&nbsp;</a>&nbsp;&nbsp; 
              <?php else : ?>
                <a href="?halaman=<?php echo $i; ?>">&nbsp;<?php echo $i; ?>&nbsp;</a>&nbsp;&nbsp;
              <?php endif; ?>
              <?php } ?>&emsp;
              
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
  const togglePassword5 = document.querySelector('#togglePassword5');
  const password5 = document.querySelector('#inpt-pass5');

  togglePassword5.addEventListener('click', function (e) {
    // toggle the type attribute
    const type5 = password4.getAttribute('type') === 'password' ? 'text' : 'password';
    password5.setAttribute('type', type5);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
<script>
  const togglePassword4 = document.querySelector('#togglePassword4');
  const password4 = document.querySelector('#inpt-pass4');

  togglePassword4.addEventListener('click', function (e) {
    // toggle the type attribute
    const type4 = password4.getAttribute('type') === 'password' ? 'text' : 'password';
    password4.setAttribute('type', type4);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
<script>
  const togglePassword3 = document.querySelector('#togglePassword3');
  const password3 = document.querySelector('#inpt-pass3');

  togglePassword3.addEventListener('click', function (e) {
    // toggle the type attribute
    const type3 = password3.getAttribute('type') === 'password' ? 'text' : 'password';
    password3.setAttribute('type', type3);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
<script>
  const togglePassword2 = document.querySelector('#togglePassword2');
  const password2 = document.querySelector('#inpt-pass2');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type2 = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type2);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
<script>
  function changePass(id){
    console.log(id);
    const togglePassword = document.querySelector('#togglePassword-'+id);
    const password = document.querySelector('#inpt-pass-'+id);
    if (password.getAttribute('type')=='password') {
      password.setAttribute('type', 'text');
    }else{
      password.setAttribute('type', 'password');
    }
    togglePassword.classList.toggle('fa-eye-slash');
  }
</script>
<script>
  function validate(){

    var a = document.getElementById("typePasswordX").value;
    var b = document.getElementById("typeConfirmPassword").value;
    if (a!=b) {
     alert("Passwords Harus Sama");
     return false;
   }
 }
</script>
<script>
  function validate(){

    var a = document.getElementById("typePasswordX").value;
    var b = document.getElementById("typeConfirmPassword").value;
    if (a!=b) {
     alert("Passwords Harus Sama");
     return false;
   }
 }
</script>
</body>
<?php 
if(isset($_POST["update"])){
  $userId = $_POST['txt_id'];
  $userFN = $_POST['txt_nama_depan'];
  $userLN = $_POST['txt_nama_belakang'];
  $userAsalInstitusi = $_POST['txt_asal_institusi'];
  $userKegiatan = $_POST['txt_kegiatan'];
  $userEmail = $_POST['txt_email'];
  $userPass = $_POST['txt_password'];
  $query = mysqli_query($koneksi, "UPDATE user_detail SET nama_depan='$userFN', nama_belakang='$userLN', asal_institusi='$userAsalInstitusi', kegiatan='$userKegiatan', email='$userEmail', password='$userPass' WHERE id='$userId'");
  echo '<script>window.location.href = "manage_user.php"</script>';
}
?>
</html>