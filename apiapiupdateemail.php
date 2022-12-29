<?php

require('koneksi.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // var_dump($_SERVER['HTTP_REFERER'], $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"], $_SERVER['HTTP_X_REQUESTED_WITH']);
  // die;
  // var_dump($_SESSION);
  if(!isset($_SESSION['samepage'])){
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $id = $data['id'];
    print($id);
    print($email);
    $query = "UPDATE `user_detail` SET `email` = '$email' WHERE `user_detail`.`id` = '$id'";

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
  $email = 'data email kosong';
  print($email);
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