<?php 
require('koneksi.php');
session_start();
// session_destroy();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // var_dump($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"], $_SERVER['HTTP_X_REQUESTED_WITH']);
  // die;
  // var_dump($_SESSION);
  if(!isset($_SESSION['samepage'])){
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $pass = $data['password'];
  }else{
  $email = $_POST['txt_email'];
  $pass = $_POST['txt_pass'];
}
  if(!empty(trim($email)) && !empty(trim($pass))){
    $query = "SELECT * FROM user_detail WHERE email='$email'";
    $result = mysqli_query($koneksi,$query);
    $num = mysqli_num_rows($result);

    while ($row = mysqli_fetch_array($result)){
      $id = $row['id'];
      $namaDepan = $row['nama_depan'];
      $namaBelakang =$row['nama_belakang'];
      $asalInstitusi = $row['asal_institusi'];
      $kegiatan = $row['kegiatan'];
      $logEmail = $row['email'];
      $password = $row['password'];
      $lvl = $row['level'];
    }

    if($num != 0){
      if($logEmail==$email && $password==$pass){
        if(!isset($_SESSION['samepage'])){
          header('Content-type: application/json');
		      http_response_code(200);
          echo json_encode(['nama_depan' => $namaDepan, 'nama_belakang' => $namaBelakang, 'asal_institusi' => $asalInstitusi, 'kegiatan' => $kegiatan, 'email' => $logEmail, 'passsword' => $password, 'level' => $lvl]);
          die;
        }
                // header('Location: dashboard.php?user_fullname='.urlencode($username));
        // unset($_SESSION['samepage']);
        $_SESSION['id'] = $id;
        $_SESSION['nama_depan'] = $namaDepan;
        $_SESSION['nama_belakang'] = $namaBelakang;
        $_SESSION['email'] = $email;
        $_SESSION['level'] = $lvl;
        header('Location:admin/home.php');
        die;
      }else{
		  if(!isset($_SESSION['samepage'])){
          header('Content-type: application/json');
		  http_response_code(403);
          die;
        }
        $error = 'user atau password salah!!';
        header('Location:login.php');
        die;
      }
    }else{
		if(!isset($_SESSION['samepage'])){
          header('Content-type: application/json');
		  http_response_code(403);
          die;
        }
      $error = 'user tidak ditemukan!!';
      header('Location:login.php');
      die;
    }
  }else{
    $error = 'Data tidak boleh kosong!!';
    echo $error;
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
  <title>MOP Green | Login Page</title>
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
              <div class="mb-md-4 mt-md-2">
                <form action="login.php" method="POST">
                  <h3 class="fw-bold mb-2 text-uppercase">Log in to</h3>
                  <h2 class="text-login-mop text-uppercase">MOP Green</h2>
                  <p class="text-white-50 mb-4">Silahkan Masukkan Email dan Password !</p>

                  <div class="form-outline form-white mb-4">
                    <input type="email" id="typeEmailX" class="form-control form-control-lg" name="txt_email" required />
                    <label class="form-label" for="typeEmailX">Email</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    
                    <span class="far fa-eye iconn" id="togglePassword" style="cursor: pointer;"></span>
                    <input type="password" id="typePasswordX" class="form-control form-control-lg" name="txt_pass" required />
                    <label class="form-label" for="typePasswordX">Password</label>
                  </div>

                  <!-- <p class="text-end small mb-3 pb-lg-2"><a class="text-white-50" href="reset_password.php">Forgot password ?</a></p> -->

                  <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submit">Login</button>
                </div>

                <div>
                  <p class="mb-0">Tidak Punya Akun ? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a></p><br>
                  <p class="mb-3">Ingin Kembali Ke Home ? <a href="index.php" class="text-white-50 fw-bold">Back</a></p>
                </div>
              </form>
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
</body>

</html>