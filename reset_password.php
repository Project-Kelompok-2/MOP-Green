<?php
include 'koneksi.php'; 
if(isset($_POST["update"])){

    $username = $_POST['txt_username'];
    $userPass = $_POST['txt_password'];

    $query = mysqli_query($koneksi, "UPDATE user_detail SET password='$userPass' WHERE username='$username'");
    echo '<script>window.location.href = "reset_password.php"</script>';
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
      background-image: url("img/bg2.jpg");
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
              <form onsubmit="return validate();" action="reset_password.php" method="POST">
                <div class="mb-md-4 mt-md-2">

                  <h4 class="fw-bold mb-4 text-uppercase">FORGOT PASSWORD
                  </h4>

                  <div class="form-outline form-white mb-4">
                    <input type="text" id="typeUsername" name="txt_username" class="form-control form-control-lg" required />
                    <label class="form-label" for="typeUsername">Username</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" name="txt_password" class="form-control form-control-lg" required />
                    <label class="form-label" for="typePasswordX">New Password</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typeConfirmPassword" class="form-control form-control-lg" />
                    <label class="form-label" for="typeConfirmPassword">Confirm Password</label>
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5" type="submit" name="update">Update</button>
                </div>
              </form>

              <p class="mb-0">Balik Ke Halaman Login ? <a href="index.php" class="text-white-50 fw-bold">Back</a></p>
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