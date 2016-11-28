<?php
session_start();
error_reporting(0);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
       <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="asset/ikan2/aksi_ikan.php";
switch($_GET[act]){
  /// MENAMPILKAN DATA PRODUK YANG SUDAH DI INPUT
  default:
    echo "<h4>Data Ikan</h4>
          <input a class='btn btn-primary' type=button value='Tambah' onclick=\"window.location.href='?module=ikan&act=tambahikan';\">
          <br>
          <table data-toggle='table' data-url='json_resep.php'  data-show-refresh='true' 
         data-show-toggle='true' data-show-columns='true' data-search='true' data-select-item-name='toolbar1' 
         data-pagination='true' >
          <thead>
          <tr>
          <th  data-field='id'>No</th>
          <th  data-field='name'>Nama ikan</th>
          <th data-field='cat_name'>cat_name </th>
          <th data-field='size_name'>Size Nama </th>
          <th data-field='price'>Price</th>
          <th  data-field='images'>Gambar</th>
          <th>Aksi</th>
          </tr>
          </thead>"; 

// MENAMPILKAN/ MEMANGGIL TABLE PRODUK DARI ID_PRODUK YANG BELAKANG KE DEPAN Z-A
    $tampil = mysql_query("SELECT * FROM ikan2");
    // MENAMPILKAN NO DAN SETIAP NO DI TAMBAHKAN 1
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      //FORMAT TANGGAL 
      //FORMAT HARGA MATA UANG INDONESIA RP
      echo "<tr >
                <td>$no</td>
                <td>$r[fish_name]</td>
                <td>$r[cat_name]</td>
                <td>$r[size_name]</td>
                <td>$r[price]</td>
                <td><img src='../foto_ikan/$r[fish_img]' width=100 hight=100></td>
                  <td>  <a class='btn btn-primary' href=?module=ikan&act=editikan&id=$r[id_fish]><i class='glyphicon glyphicon-pencil'></i></a> 
                    <a class='btn btn-danger' href='$aksi?module=ikan&act=hapus&id=$r[id_fish]&namafile=$r[fish_img]'  onclick='return konfirmasi()''><i class='glyphicon glyphicon-trash'></i></a>
                </td>   
            </tr>";
      $no++;
    }
    echo "

    </table>
     </div>";
    break;
    /// BERHENTI 

 case "tambahikan":
    echo "<h4>Tambah Data Ikan</h4>
          <form method=POST action='$aksi?module=ikan&act=input' enctype='multipart/form-data'>
          <table class='table table-bordered'>
          <tr><td>Nama Ikan<input type=text name='fish_name' placeholder='Masukan Nama Ikan' onkeyup='validproduk(this)'   class='form-control'></td></tr>
           <tr><td>Asal Ikan<input type='text' placeholder='Masukan Asal Ikan' name='cat_name' class='form-control'></td></tr>
    <tr><td>Asal Ikan<input type='text' placeholder='Masukan Asal Ikan' name='size_name' class='form-control'></td></tr>
      <tr><td>Asal Ikan<input type='text' placeholder='Masukan Asal Ikan' name='price' class='form-control'></td></tr>
         ";
  
          echo"
          
          <tr><td>Gambar<input  type=file name='fupload' > 
                                          <br>Tipe gambar harus JPG/JPEG/PNG, 
                                          untuk ukuran width: 600 px dan hight : 600 px</td></tr>
          <tr><td colspan=3><input type=submit  a class='btn btn-primary btn-flat'  value=Simpan>
                            <input type=button  a class='btn btn-primary btn-flat'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;

  case "editikan":
    $edit = mysql_query("SELECT * FROM ikan WHERE id_ikan='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h4>Edit Data Ikan</h4>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=ikan&act=update>
          <input type=hidden name=id value=$r[id_ikan]>
          <table class='table table-bordered'>
          <tr><td>Nama Ikan<input type=text name='nama_ikan' value='$r[nama_ikan]' onkeyup='validproduk(this)'  placeholder='Masukan nama produk'  class='form-control' required=''></td></tr>
          <tr><td>Nama Ikan<input type=text name='asal_ikan' value='$r[asal_ikan]' onkeyup='validproduk(this)'  placeholder='Masukan nama produk'  class='form-control' required=''></td></tr>
          <tr><td>Deskripsi
                <textarea class='ckeditor'  name='deskripsi'  id='editor1'  placeholder='Place some text here' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>$r[deskripsi] </textarea>
             </td></tr>
    
          <tr><td>Ganti gambar<br>
          <img src='../foto_ikan/$r[gambar]' width=100 hight=100><input type=file name='fupload'>
          <tr><td colspan=2>* Apabila gambar tidak diubah, dikosongkan saja.
              <br>Tipe gambar harus JPG/JPEG/PNG, 
                                          untuk ukuran width: 600 px dan hight : 600 px</td></tr></td></tr>
          <tr><td colspan=2><input type=submit value=Update a class='btn btn-primary'>
                            <input type=button value=Batal  a class='btn btn-primary' onclick=self.history.back()></td></tr>
         </table>";
    break;  
}
}
?>

<script language='javascript'>
function validproduk(b)
{
  if(!/^[a-zA-Z ]+$/.test(b.value))
  {
 alert("Nama Produk tidak boleh mengandung Angka!");
          return false;
  };
}
</script>

<script language='javascript'>
function validberat(a)
{
  if(!/^[0-9.]+$/.test(a.value))
  {
 alert("Berat produk tidak boleh mengandung Huruf!");
          return false;
  };
  
}
</script>

<script language='javascript'>
function validstok(a)
{
  if(!/^[0-9.]+$/.test(a.value))
  {
 alert("Stok produk tidak boleh mengandung Huruf!");
          return false;
  };
}
</script>

<script language='javascript'>
function validharga(a)
{
  if(!/^[0-9.]+$/.test(a.value))
  {
 alert("Harga produk tidak boleh mengandung Huruf!");
          return false;
  };
}
</script>

<script language='javascript'>
function validdiskon(a)
{
  if(!/^[0-9.]+$/.test(a.value))
  {
 alert("Diskon produk tidak boleh mengandung Huruf!");
          return false;
  };
}
</script>



<script type="text/javascript" language="JavaScript">
 function konfirmasi()
 {
 tanya = confirm("Anda Yakin Akan Menghapus Data ?");
 if (tanya == true) return true;
 else return false;
 }</script>