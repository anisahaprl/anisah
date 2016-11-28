<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
       <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="asset/landscape/aksi_landscape.php";
switch($_GET[act]){
  /// MENAMPILKAN DATA PRODUK YANG SUDAH DI INPUT
  default:
    echo "<h4>Data Landscape</h4>
          <input a class='btn btn-primary' type=button value='Tambah' 
          onclick=\"window.location.href='?module=landscape&act=tambah';\">
          <table data-toggle='table'' data-url='json_kota.php'  data-show-refresh='true' 
         data-show-toggle='true' data-show-columns='true' data-search='true' data-select-item-name='toolbar1' 
         data-pagination='true' data-sort-name='name' data-sort-order='desc'>
          <thead>
          <tr>
          <th >No</th>
          <th >Nama Landscape</th>
          <th  >Nama kategori</th>
          <th >Gambar</th>
          <th>Aksi</th>
          </tr>
          </thead>"; 
    $tampil=mysql_query("SELECT * FROM landscape, kategori where landscape.id_kategori=kategori.id_kategori");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
             <td>$no</td>
             <td>$r[nama_landscape]</td>
             <td>$r[nama_kategori]</td>
             <td><img src='../foto_landscape/$r[gambar]' width=100 hight=100></td>
             <td>
             <a class='btn btn-primary' href=?module=landscape&act=edit&id=$r[id_landscape]><i class='glyphicon glyphicon-pencil'></i></a> 
             <a class='btn btn-danger' href=$aksi?module=landscape&act=hapus&id=$r[id_landscape] onclick='return konfirmasi()'><i class='glyphicon glyphicon-trash'></i></a>
             </td>
             </tr>";
      $no++;
    }
    echo "      </div>
                </tbody>
    </table>";
    break;

  
  case "tambah":
    echo "<h4>Form Tambah Data Landscape</h4>
          <form method=POST onsubmit='return validasi_input(this)' action='$aksi?module=landscape&act=input' enctype='multipart/form-data'>
          <table class='table table-bordered'>
          <tr><td>Nama Produk<input type=text name='nama_landscape' placeholder='Masukan nama landscape' onkeyup='validproduk(this)'   class='form-control'></td></tr>
          <tr><td>Kategori
          <select name='kategori' class='form-control'>
            <option value=0 selected> -Pilih Kategori -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Deskripsi<textarea name='deskripsi'  class='form-control' style='width:500x; height: 350px;' id='tinymce_basic'></textarea></td></tr>
          <tr><td>Gambar<input type=file name='fupload' > 
                                          <br>Tipe gambar harus JPG/JPEG/PNG, 
                                          untuk ukuran width: 600 px dan hight : 600 px</td></tr>
          <tr><td colspan=3><input type=submit  a class='btn btn-primary'  value=Simpan>
                            <input type=button  a class='btn btn-primary'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    

  case "edit":
    $edit = mysql_query("SELECT * FROM landscape WHERE id_landscape='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h4>Form Edit Data Landscape</h4>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=landscape&act=update>
          <input type=hidden name=id value=$r[id_landscape]>
          <table class='table table-bordered'>
          <tr><td>Nama<input type=text name='nama_landscape' value='$r[nama_landscape]' onkeyup='validproduk(this)'  placeholder='Masukan nama landscape'  class='form-control' required=''></td></tr>
          <tr><td>Kategori<select name='kategori' class='form-control'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option   value=0 selected class='form-control' >- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option  value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></td></tr>
          <tr><td>Deskripsi<textarea name='deskripsi'  class='form-control' style='width:500x; height: 350px;' id='tinymce_basic' required=''>$r[deskripsi]</textarea></td></tr>
          <tr><td>Gambar <img src='../foto_landscape/$r[gambar]' width=100 hight=100></td></tr>
          <tr><td>Ganti gambar<input type=file name='fupload'></tr></td>
          <tr><td colspan=2>* Apabila gambar tidak diubah, dikosongkan saja.
              <br>Tipe gambar harus JPG/JPEG/PNG, 
                                          untuk ukuran width: 600 px dan hight : 600 px         
                                           <tr><td colspan=2><input type=submit value=Update a class='btn btn-primary'>
                            <input type=button value=Batal  a class='btn btn-primary' onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>

<script type="text/javascript">
  function validasi_input(form){
  if (form.berat.value != ""){
  var b = (form.berat.value);
  var h =(form.harga.value);
  var status = true;
  var list = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
  for (i=0; i<=x.length-1; i++)
  {
  if (x[i] in list) cek = true;
  else cek = false;
 status = status && cek;
  }
  if (status == false)
  {
  alert("Harga Harga Angka");
  form.harga.focus();
  return false;
  }
  }
  return (true);
  }
  </script>

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