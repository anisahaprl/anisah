<?php

include "../../../config/koneksi.php";

$tampil=("SELECT * FROM kategori");
 
$result = mysql_query($tampil) or die(mysql_error());

$arr = array();
    while ($r=mysql_fetch_assoc($result)){

    	//jSON array()
      $temp=array(
      	"id_kategori"=>$r['id_kategori'],
        "nama_kategori"=>$r['kategori']);

    array_push($arr, $temp);
    }

$data = json_encode($arr);
// json Format
echo "" . $data . "";
?>

