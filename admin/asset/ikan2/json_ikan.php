<?php
include "../../../config/koneksi.php";

$tampil=("SELECT * FROM ikan2");
 
$result = mysql_query($tampil) or die(mysql_error());

$arr = array();
    while ($r=mysql_fetch_assoc($result)){
      $temp=array(
      	"id_fish"=>$r['id_fish'],
        "fish_img"=>$r['fish_img'],
        "fish_name"=>$r['fish_name'],
         "size_name"=>$r['size_name'],
        "cat_name"=>$r['cat_name'],
        "price"=>$r['price']);

    array_push($arr, $temp);
    }

$data = json_encode($arr);

echo "" . $data . "";
?>

