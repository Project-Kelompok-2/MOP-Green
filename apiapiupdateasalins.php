<?php

require('koneksi.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // var_dump($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"], $_SERVER['HTTP_X_REQUESTED_WITH']);
  // die;
  // var_dump($_SESSION);
  if(!isset($_SESSION['samepage'])){
    $data = json_decode(file_get_contents('php://input'), true);
    $asal_institusi = $data['asal_institusi'];
    $id = $data['id'];
    print($id);
    print($asal_institusi);
    $query = "UPDATE `user_detail` SET `asal_institusi` = '$asal_institusi' WHERE `user_detail`.`id` = '$id'";

    $exe= mysqli_query($koneksi, $query);
// $arr[];

    if($exe)
    {
	 $arr["success"]="true";
    }else
    {
	$arr["success"]="false";
    }
    print(json_encode($arr));

  }else{
  $id = 'data id kosong';
  print($id);
  $asal_institusi = 'data asal asal institusi kosong';
  print($asal_institusi);
}}else{
	$_SESSION['samepage'] = True;
}


// if(isset($_POST["id"]))
// {
// 	$id=$_POST["id"];
// }
// else return;
// print($id);
// $query = "DELETE FROM user_detail WHERE `user_detail`.`id` = '$id'";

// $exe= mysqli_query($koneksi, $query);
// // $arr[];

// if($exe)
// {
// 	$arr["success"]="true";
// }
// else{
// 	$arr["success"]="false";
// }
// print(json_encode($arr));
?>