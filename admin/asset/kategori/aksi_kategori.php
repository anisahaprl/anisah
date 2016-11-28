<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "
        <link href='../css/bootstrap.css' rel='stylesheet' type='text/css'>
        <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='kategori' AND $act=='input'){
	 $cek=mysql_num_rows(mysql_query("SELECT * FROM kategori where kategori='$_POST[kategori]'"));
  	if ($cek > 0){
  		echo "<script>window.alert('Nama Kategori $_POST[kategori] sudah ada!.')
  		window.location='../../media.php?module=kategori&act=tambahkategori'</script>";
  	}else{
  			  mysql_query("INSERT INTO kategori(kategori) VALUES('$_POST[kategori]')");
  		echo "<script> window.alert('Nama kategori  $_POST[kategori]  berhasil disimpan')
  		window.location='../../media.php?module=kategori'</script>";
 
  	}
}
// Update kategori
elseif ($module=='kategori' AND $act=='update'){
  mysql_query("UPDATE kategori SET 
                                  kategori = '$_POST[kategori]' 
                                  WHERE id_kategori = '$_POST[id]'");
  		echo "<script> window.alert('Nama kategori  $_POST[kategori]  berhasil diubah')
  		window.location='../../media.php?module=kategori'</script>";
 
}
}
?>
