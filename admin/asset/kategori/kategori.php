<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='../css/styles.css' rel='stylesheet' type='text/css'>
        <link href='../css/bootstrap.css' rel='stylesheet' type='text/css'>
        <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="asset/kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h4>Data kategori masakan</h4>
          <input a class='btn btn-primary' type=button value='Tambah Kategori' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">
          <br>
          <table data-toggle='table' data-url='json_kota.php'  data-show-refresh='true' 
         data-show-toggle='true' data-show-columns='true' data-search='true' data-select-item-name='toolbar1' 
         data-pagination='true' data-sort-name='name' data-sort-order='desc'>
          <thead>
          <br>
          <tr>
          <th  data-field='id'>No</th>
          <th  data-field='name'>Nama kategori</th>
          <th>Aksi</th>
          </tr>
          </thead>"; 
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY kategori desc");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
             <td>$no</td>
             <td>$r[kategori]</td>
             <td>
             <a class='btn btn-primary' href=?module=kategori&act=editkategori&id=$r[id_kategori]><i class='glyphicon glyphicon-pencil'></i></a> 
             <a class='btn btn-danger' href=$aksi?module=kategori&act=hapus&id=$r[id_kategori] onclick='return konfirmasi()'><i class='glyphicon glyphicon-trash'></i></a>
             </td>
             </tr>";
      $no++;
    }
    echo "      </div>
                </tbody>
    </table>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo "<h4>Tambah kategori masakan</h4>
          <form method=POST action='$aksi?module=kategori&act=input'>
             <table class='table fixed-table-container'>
          <tr><td>Nama Kategori masakan<input type=text name='kategori' class='form-control' onkeyup='validHuruf(this)' placeholder='Masukan nama kategori' required='' ></td></tr>
          <tr><td colspan=2><input type=submit name=submit a class='btn btn-primary' value=Simpan>
                            <input type=button value=Batal a class='btn btn-primary' onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h4>Edit Kategori masakan</h4>
          <form method=POST action=$aksi?module=kategori&act=update>
          <input type=hidden a class='btn btn-primary' name=id value='$r[id_kategori]'>
            <table class='table fixed-table-container'>
          <tr><td>Nama Kategori masakan<input type=text name='kategori' class='form-control' onkeyup='validHuruf(this)'  value='$r[kategori]' required=''></td></tr>
          <tr><td colspan=2><input type=submit  value=Update  a class='btn btn-primary' >
                            <input type=button  value=Batal a class='btn btn-primary' onclick=self.history.back()></td></tr>
          </table></form>
          </div>
          </div>
          </div>";
    break;  
}
}
?>

<script language='javascript'>
function validHuruf(b)
{
  if(!/^[a-zA-Z ]+$/.test(b.value))
  {
 alert("Nama Kategori tidak boleh mengandung Angka!");
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

 <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script> 