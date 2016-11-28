<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Admin
 
if ($module=='admin' AND $act=='hapus'){
  mysql_query("DELETE FROM admin WHERE id_admin='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input admin
elseif ($module=='admin' AND $act=='input'){
  $pass= md5($_POST['password']);
mysql_query("INSERT INTO admin(username,password,nama_lengkap,level)
 VALUES('$_POST[username]',
    '$pass',
    '$_POST[nama_lengkap]',
    '$_POST[level]')"); 
  header('location:../../media.php?module='.$module);
  }
  // Update admin

  elseif ($module=='admin' AND $act=='update'){  
 $pass     = md5($_POST['password']);
    mysql_query("UPDATE admin SET nama_lengkap= '$_POST[nama_lengkap]',
                                  username     ='$_POST[username]',
                                  password     ='$pass',
                                  level        ='$_POST[level]'
                                  WHERE id_admin   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}

?>
