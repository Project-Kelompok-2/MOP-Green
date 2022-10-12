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
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>MOP Green</title>
  <!-- MDB icon -->
  <link rel="icon" href="../img/MOP Green 1.png" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="../css/bootstrap-login-form.min.css" />
</head>
<body>

    <div class="text-center">
        <p>
           WELCOME ! <?=$sesName?>
        </p>
        <a href="../logout.php">logout</a>
    </div>
    <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>