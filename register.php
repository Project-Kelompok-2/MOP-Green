<?php 
require ('koneksi.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // var_dump($_SESSION);
  // die;
  // $data = json_decode(file_get_contents('php://input'), true);
  // var_dump($data);
  // die();
  if(!isset($_SESSION['samepage'])){
    $data = json_decode(file_get_contents('php://input'), true);
    $userFN = $data['nama_depan'];
    $userLN = $data['nama_belakang'];
    $userAsalInstitusi = $data['asal_institusi'];
    $userKegiatan = $data['kegiatan'];
    $userEmail = $data['email'];
    $userPass = $data['password'];
  }else{
  $userFN = $_POST['txt_nama_depan'];
  $userLN = $_POST['txt_nama_belakang'];
  $userAsalInstitusi = $_POST['txt_asal_institusi'];
  $userKegiatan = $_POST['txt_kegiatan'];
  $userEmail = $_POST['txt_email'];
  $userPass = $_POST['txt_password'];
  }

  if (!empty(trim($userFN)) && !empty(trim($userLN)) && !empty(trim($userAsalInstitusi)) && !empty(trim($userKegiatan)) && !empty(trim($userEmail)) && !empty(trim($userPass))) {
    $query2 = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE email = '$userEmail'");
    // var_dump($query2, $userEmail);
    // die;
    if (mysqli_num_rows($query2)!=0) {
      if(!isset($_SESSION['samepage'])){
          header('Content-type: application/json');
          http_response_code(409);
          // echo json_encode(['nama_depan' => $userFN, 'nama_belakang' => $userLN, 'asal_institusi' => $userAsalInstitusi, 'kegiatan' => $userKegiatan, 'email' => $userEmail, 'password' => $userPass, 'level' => $lvl]);
          die;
        }

      setcookie("message","Maaf, Email Sudah Pernah Didaftarkan",time()+1);
      header('location:register.php');
      die;

    }else{
      $query = "INSERT INTO user_detail VALUES (NULL, '$userFN', '$userLN', '$userAsalInstitusi', '$userKegiatan', '$userEmail', '$userPass', 2)";
      $result = mysqli_query($koneksi, $query);

      if(!isset($_SESSION['samepage'])){  
          header('Content-type: application/json');
          http_response_code(200);
          echo json_encode(['nama_depan' => $userFN, 'nama_belakang' => $userLN, 'asal_institusi' => $userAsalInstitusi, 'kegiatan' => $userKegiatan, 'email' => $userEmail, 'password' => $userPass]);
          die;
        }

      
      header('location:login.php');
      die;
    }
  }else{
    if(!isset($_SESSION['samepage'])){
          header('Content-type: application/json');
          http_response_code(400);
          // echo json_encode(['nama_depan' => $userFN, 'nama_belakang' => $userLN, 'asal_institusi' => $userAsalInstitusi, 'kegiatan' => $userKegiatan, 'email' => $userEmail, 'password' => $userPass, 'level' => $lvl]);
          die;
        }

    setcookie("message","Maaf, data yang anda masukkan tidak lengkap",time()+1);
      header('location:register.php');
      die;
  }


  
}else{
$_SESSION['samepage'] = True;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>MOP Green | Register Page</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/logo2.png" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
  <style type="text/css">
    .bg-img{
      background-image: url("img/bg3.jpg");
      /*filter: blur(8px);*/
      /*-webkit-filter: blur(8px);*/
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
    body{
      margin: 0;
    }
    .text-login-mop{
      color: #007443;
    }
    .btn-outline-light:hover{
      color: black;
      background: white;
      font-weight: bold;
    }
    .text-error{
      color: red;
      font-weight: bold;
    }
    .iconn{
      float: right;
      margin-right: 10px;
      margin-top: 20px;
      margin-bottom: -30px;
      position: relative;
      z-index: 2;
    }
  </style>
</head>

<body>
  <!-- Start your project here-->
  <section class="bg-img">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <img style="margin-left: 3px; height: 130px; width: 140px; margin-top: -20px;" src="img/logo2.png">
              <form onsubmit="return validate();" action="register.php" method="POST">
                <div class="mb-md-4 mt-md-2 mb2">
                  <h3 class="fw-bold mb-2 text-uppercase">Register to</h3>
                  <h2 class="text-login-mop text-uppercase">MOP Green</h2>
                </h4>
                <div class="text-error mb-2">
                  <?php 
                  if (isset($_COOKIE["message"])) {
                    echo $_COOKIE["message"];
                  }
                  ?>
                </div>
                <div class="row">

                  <div class="col">
                    <div class="form-outline form-white mb-4">
                      <input type="text" id="typeNamaDepan" name="txt_nama_depan" class="form-control form-control-lg" pattern="^[a-zA-Z\s'-].{1,15}" title="tidak boleh lebih dari 15 karakter dan hanya huruf" required />
                      <label class="form-label" for="typeNamaDepan">Nama Depan</label>
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-outline form-white mb-4">
                      <input type="text" id="typeNamaBelakang" name="txt_nama_belakang" class="form-control form-control-lg" pattern="^[a-zA-Z\s'-].{1,15}" title="tidak boleh lebih dari 15 karakter dan hanya huruf" />
                      <label class="form-label" for="typeNamaBelakang">Nama Belakang</label>
                    </div>
                  </div>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="text" id="typeAsalInstitusi" name="txt_asal_institusi" class="form-control form-control-lg" pattern="^[a-zA-Z\s'-].{1,50}" title="tidak boleh lebih dari 50 karakter" required />
                  <label class="form-label" for="typeUsername">Asal Institusi</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="text" id="typeKegiatan" name="txt_kegiatan" class="form-control form-control-lg" required />
                  <label class="form-label" for="typeUsername">Kegiatan</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="email" id="typeEmailX" name="txt_email" class="form-control form-control-lg" required />
                  <label class="form-label" for="typeEmailX">Email</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <span class="far fa-eye iconn" id="togglePassword" style="cursor: pointer;"></span>
                  <input type="password" id="typePasswordX" name="txt_password" class="form-control form-control-lg" pattern="(?=.*\d)(?=.*[a-z]).{6,}" title="Password Harus Memiliki 6 Karakter dan Minimal Mengandung Huruf Dan Angka" required />
                  <label class="form-label" for="typePasswordX">Password</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <span class="far fa-eye iconn" id="typeTogglePassword" style="cursor: pointer;"></span>
                  <input type="password" id="typeConfirmPassword" class="form-control form-control-lg" />
                  <label class="form-label" for="typeConfirmPassword">Confirm Password</label>
                </div>

                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="register">Register</button>
              </div>
            </form>

            <p class="mb-0">Sudah Punya Akun ? <a href="login.php" class="text-white-50 fw-bold">Sign In</a></p>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

</section>
<!-- End your project here-->

<!-- MDB -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Custom scripts -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#typePasswordX');

    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
    // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>
  <script>
    const togglePassword2 = document.querySelector('#typeTogglePassword');
    const password2 = document.querySelector('#typeConfirmPassword');

    togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
      const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
      password2.setAttribute('type', type);
    // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
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

</html>