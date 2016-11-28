<?php

include "../../../config/koneksi.php";

$tampil=("SELECT * FROM resep");
 
$result = mysql_query($tampil) or die(mysql_error());

$arr = array();
    while ($r=mysql_fetch_assoc($result)){

      //jSON array()
      $temp=array(
        "gambar"=>$r["gambar"],
        "resep"=>$r['resep'],
        "cara_membuat"=>$r["cara_membuat"]);

    array_push($arr, $temp);
    }

$data = json_encode($arr);
// json Format
echo "" . $data . "";
?>

