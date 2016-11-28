<?php

include "../../../config/koneksi.php";

$tampil=("SELECT * FROM landscape where id_kategori=1");
 
$result = mysql_query($tampil) or die(mysql_error());

$arr = array();
    while ($r=mysql_fetch_assoc($result)){

      //jSON array()
      $temp=array(
        "gambar"=>$r["gambar"],
        "id_landscape"=>$r['id_landscape'],
         "nama_landscape"=>$r['nama_landscape'],
        "deskripsi"=>$r["deskripsi"]);

    array_push($arr, $temp);
    }

$data = json_encode($arr);
// json Format
echo "" . $data . "";
?>

