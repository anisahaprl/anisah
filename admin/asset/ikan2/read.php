<?php
 //Memanggil conn.php yang telah kita buat sebelumnya
include "../../../config/koneksi.php";
 
 //Syntax MySql untuk melihat semua record yang
 //ada di tabel animal
 $sql = "SELECT * FROM resep";
  
 //Execetute Query diatas
 $query = mysql_query($sql);
 while($r=mysql_fetch_array($query)){
  $item[] = array(
  
    "gambar"=>$r['gambar'],
      "nama_resep"=>$r['nama_resep'],
       "priview"=>$r['priview'],
        "id_resep"=>$r['id_resep'],
        "id_kategori"=>$r['id_kategori'],
        "id_kota"=>$r['id_kota'],
        "bahan"=>$r['bahan'],
        "cara_membuat"=>$r['cara_membuat'],
       
        "tgl"=>$r['tgl']
  );
 }
 
 //Menampung data yang dihasilkan
 $json = array(
    'result' => 'Success',
    'item' => $item
   );
 
 //Merubah data kedalam bentuk JSON
 echo json_encode($json);
?>
