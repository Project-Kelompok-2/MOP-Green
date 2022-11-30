<?php
include '../koneksi.php';
if (isset($_POST['tmbh'])) {
  $userFN = $_POST['txt_nama_depan'];
  $userLN = $_POST['txt_nama_belakang'];
  $userAsalInstitusi = $_POST['txt_asal_institusi'];
  $userKegiatan = $_POST['txt_kegiatan'];
  $username = $_POST['txt_username'];
  $userEmail = $_POST['txt_email'];
  $userPass = $_POST['txt_password'];


  $query = "INSERT INTO user_detail VALUES ('', '$userFN', '$userLN', '$userAsalInstitusi', '$userKegiatan', '$userEmail', '$username', '$userPass', 2)";
  $result = mysqli_query($koneksi, $query);
  header('location:manage_user.php');
}
?>