<?php
session_start();
error_reporting(0);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="asset/admin/aksi_admin.php";
switch($_GET[act]){
  // Tampil akun
  default:
    echo "<h4>Form Data Admin</h4>
          <input type=button  a class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=admin&act=tambahadmin';\">
          <br>
          <br>
          <table class='table table-bordered'>
          <tr><th>No</th><th>Nama Lengkap</th><th>Username</th><th>Aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM admin");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
                <td>$r[nama_lengkap]</td>
                <td>$r[username]</td>
		            <td><a class='btn btn-primary'  href=?module=admin&act=editadmin&id=$r[id_admin]> <i class='glyphicon glyphicon-pencil'></i></a>
					          <a class='btn btn-danger'  href=$aksi?module=admin&act=hapus&id=$r[id_admin] onclick='return konfirmasi()'><i class='glyphicon glyphicon-trash'></i></a></td>
		        </tr>";
				 $no++;
    }
    echo "</table>";
 
    break;
  
  case "tambahadmin":
    echo "<h4>Form Tambah Admin</h4>
          <form method=POST enctype='multipart/form-data' action='$aksi?module=admin&act=input'>
          <table class='table table-bordered'>
          <tr><td >Nama Lengkap<input type=text class='form-control' placeholder='Masukan nama lengkap' name='nama_lengkap' ></td></tr>
          <input type=hidden  class='form-control' name='level'  value='admin' required='' >";
           
    echo "
          <tr><td>Username<input type=text class='form-control' name='username'  placeholder='Masukan username' required=''></td></tr>
          <tr><td>Password<input type=password class='form-control' name='password' placeholder='Masukan password' required=''></td></tr>
          <tr><td colspan=2><input type=submit a class='btn btn-primary signup' value=Simpan>
                            <input type=submit a class='btn btn-primary signup' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editadmin":
    $edit = mysql_query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h4>Form Edit Admin</h4>
          <form method=POST action=$aksi?module=admin&act=update>
          <input type=hidden name=id value=$r[id_admin]>
           <table class='table table-bordered'>
          <tr><td>Nama lengkap <input  type=text  class='form-control' name='nama_lengkap'  value='$r[nama_lengkap]' required=''></td></tr>
          <tr><td>Username<input type=text class='form-control'  name='username' value='$r[username]' required=''></td></tr>
          <tr><td>Password<input type=password class='form-control' name='password' value='$r[password]' required=''></td></tr>
           <input type=hidden class='form-control' name='level' value='$r[level]'>";
    echo "
          <tr><td colspan=4><input type=submit a class='btn btn-primary signup' value=Update>
                            <input type=button a class='btn btn-primary signup' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>
<script type="text/javascript" language="JavaScript">
 function konfirmasi()
 {
 tanya = confirm("Anda Yakin Akan Menghapus Data ?");
 if (tanya == true) return true;
 else return false;
 }</script>