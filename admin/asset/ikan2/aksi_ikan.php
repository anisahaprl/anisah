<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/hari.php";
include "../../../config/tgl_indo.php";
include "../../../config/upload_gambarikan.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus produk
if ($module=='ikan' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM ikan WHERE id_ikan='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM ikan2 WHERE id_fish='$_GET[id]'");
     unlink("../../../foto_ikan/$_GET[namafile]");      
  }
  else{
     mysql_query("DELETE FROM ikan2 WHERE id_fish='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);


  mysql_query("DELETE FROM ikan2 WHERE id_fish='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input produk

elseif ($module=='ikan' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=ikan)</script>";
    }
    else{
    UploadImage($nama_file_unik);

    mysql_query("INSERT INTO ikan2   (
                                    fish_name,
                                    cat_name,
                                    size_name,
                                    price,
                                    fish_img)
                            VALUES('$_POST[fish_name]',
                                   '$_POST[cat_name]',
                                   '$_POST[size_name]',
                                   '$_POST[price]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{

   
    mysql_query("INSERT INTO ikan2   (
                                    fish_name,
                                    cat_name,
                                    size_name,
                                    price,
                                    fish_img)
                            VALUES('$_POST[fish_name]',
                                   '$_POST[cat_name]',
                                   '$_POST[size_name]',
                                   '$_POST[price]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
}

// Update produk
elseif ($module=='ikan' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE ikan SET  nama_ikan         = '$_POST[nama_ikan]',
                                   asal_ikan       = '$_POST[asal_ikan]',
                                   deskripsi          = '$_POST[deskripsi]',
                             WHERE id_ikan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=ikan)</script>";
    }
    else{
    UploadImage($nama_file_unik);
 mysql_query("UPDATE ikan SET  nama_ikan         = '$_POST[nama_ikan]',
                                   asal_ikan       = '$_POST[asal_ikan]',
                                   deskripsi          = '$_POST[deskripsi]',
                             WHERE id_ikan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
    }
  }
}
}
?>