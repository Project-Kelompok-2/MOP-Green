<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>MOP Green</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/MOP Green 1.png" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
  <style>
    body{
      margin: 0;
    }
    .gradient-custom {
      background: #527724;
    }
    .text-login-mop{
      color: #527724;
    }
  </style>
</head>

<body>
  <!-- Start your project here-->
  
  <section class="gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <img style="margin-left: 3px;" src="img/MOP Green 1.png">
              <div class="mb-md-4 mt-md-2">

                <h2 class="fw-bold mb-2 text-uppercase">Login to <span class="text-login-mop">MOP Green</span></h2>
                <p class="text-white-50 mb-4">Masukkan Email dan Password Dibawah !</p>

                <div class="form-outline form-white mb-4">
                  <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                  <label class="form-label" for="typeEmailX">Email</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                  <label class="form-label" for="typePasswordX">Password</label>
                </div>

                <p class="text-end small mb-3 pb-lg-2"><a class="text-white-50" href="#!">Forgot password ?</a></p>

                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
              </div>

              <div>
                <p class="mb-3">Hanya Pengunjung ? <a href="#!" class="text-white-50 fw-bold">Guest Mode</a></p>
                <p class="mb-0">Tidak Punya Akun ? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a></p>
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
  <script type="text/javascript"></script>
</body>

</html>