<?php
require ('../koneksi.php'); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  // var_dump($data);
  // die();
  $koneksi = mysqli_connect('localhost', 'root', '', 'mopgreen');
  if (mysqli_connect_errno()) {
    echo "Koneksi Gagal :".mysqli_connect_error();
  }
  $temp = $data["temp"];
  $hum = $data["humadity"];
  $sql = "INSERT INTO data_sensor (temp1, temp2, hum1, hum2) VALUES ('$temp', '$temp', '$hum', '$hum')";
    mysqli_query($koneksi, $sql);
  // result
     header('Content-type: application/json');
     echo json_encode([]);
     die();
   }
 ?>