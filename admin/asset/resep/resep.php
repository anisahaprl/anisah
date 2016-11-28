<?php
session_start();
error_reporting(0);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
       <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="asset/resep/aksi_resep.php";
switch($_GET[act]){
  /// MENAMPILKAN DATA PRODUK YANG SUDAH DI INPUT
  default:
    echo "<h4>Resep</h4>
          <input a class='btn btn-primary' type=button value='Tambah Resep' onclick=\"window.location.href='?module=resep&act=tambahresep';\">
         <br>
          <table data-toggle='table' data-url='json_resep.php'  data-show-refresh='true' 
         data-show-toggle='true' data-show-columns='true' data-search='true' data-select-item-name='toolbar1' 
         data-pagination='true' >
         <br>
          <thead>
          <tr>
          <th  data-field='id'>No</th>
          <th  data-field='name'>Nama Resep</th>
          <th  data-field='category'>Kategori</th>
          <th  data-field='images'>Gambar</th>
          <th>Aksi</th>
          </tr>
          </thead>"; 

// MENAMPILKAN/ MEMANGGIL TABLE PRODUK DARI ID_PRODUK YANG BELAKANG KE DEPAN Z-A
    $tampil = mysql_query("SELECT * FROM resep, kategori WHERE resep.id_kategori=kategori.id_kategori");
    // MENAMPILKAN NO DAN SETIAP NO DI TAMBAHKAN 1
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr >
                <td>$no</td>
                <td>$r[resep]</td>
                <td>$r[kategori]</td>
                <td><img src='../foto_masakan/$r[gambar]' width=100 hight=100></td>
                  <td>  <a class='btn btn-primary' href=?module=resep&act=editresep&id=$r[id_resep]><i class='glyphicon glyphicon-pencil'></i></a> 
                    <a class='btn btn-danger' href=$aksi?module=resep&act=hapus&id=$r[id_resep]&namafile=$r[gambar]  onclick='return konfirmasi()''><i class='glyphicon glyphicon-trash'></i></a>
                </td>   
            </tr>";
      $no++;
    }
    echo "

    </table>
     </div>";
    break;
    /// BERHENTI 

  
  case "tambahresep":
    echo "<h4>Tambah Produk</h4>
          <form method=POST action='$aksi?module=resep&act=input' enctype='multipart/form-data'>
          <table class='table table-bordered'>
          <tr><td>Nama Resep Masakan<input type=text name='resep' placeholder='Masukan nama Resep' onkeyup='validproduk(this)'   class='form-control'></td></tr>
          <tr><td>Kategori Masakan
          <select name='kategori' class='form-control'>
            <option value=0 selected> -Pilih Kategori -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[kategori]</option>";
            }
        echo "</select></td></tr>
          <tr><td>Bahan- Bahan
                <textarea class='ckeditor' name='bahan' id='editor1'  placeholder='Place some text here' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
              </td></tr>
          <tr><td>Cara memasak
                <textarea class='ckeditor' name='cara_membuat' id='editor1'  placeholder='Place some text here' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
              </td></tr>";
          echo "<tr><td>Gambar<input  type=file name='fupload' > 
                                          <br>Tipe gambar harus JPG/JPEG/PNG, 
                                          untuk ukuran width: 600 px dan hight : 600 px</td></tr>
          <tr><td colspan=3><input type=submit  a class='btn btn-primary btn-flat'  value=Simpan>
                            <input type=button  a class='btn btn-primary btn-flat'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    

  case "editresep":
     $edit=mysql_query("SELECT * FROM resep WHERE id_resep='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h4>Edit Resep Masakan</h4>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=resep&act=update>
          <input type=hidden name=id value=$r[id_resep]>
          <table class='table table-bordered'>
          <tr><td>Nama Resep Masakan<input type=text name='resep' value='$r[resep]' onkeyup='validproduk(this)'  placeholder='Masukan nama resep'  class='form-control' required=''></td></tr>
          <tr><td>Kategori Resep Masakan<select name='kategori' class='form-control'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY kategori");
          if ($r[id_kategori]==0){
            echo "<option   value=0 selected class='form-control' required=''>- Pilih Kategori Masakan -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option  value=$w[id_kategori] selected>$w[kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[kategori]</option>";
            }
          }   
          echo "</select></td></tr>";
          echo "
          <tr><td>Bahan- Bahan
                <textarea class='ckeditor' name='bahan' id='editor1'  placeholder='Place some text here' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>$r[bahan] </textarea>
             </td></tr>
          <tr><td>Cara memasak
                <textarea class='ckeditor' name='cara_membuat'  id='editor1' placeholder='Place some text here' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'> $r[cara_membuat] </textarea>
              </td></tr>

          <tr><td>Ganti gambar<br>
          <img src='../foto_masakan/$r[gambar]' width=100 hight=100><input type=file name='fupload'>
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