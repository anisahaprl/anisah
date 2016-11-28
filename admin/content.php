<?php
include "../config/koneksi.php";
include "../config/tgl_indo.php";
include "../config/hari.php";
include "../config/upload_gambar.php";

// Bagian Home
if ($_GET[module]=='home'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<h4>Selamat Datang</h4>
        Hai <b color='#F4511E'>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola content website.</div>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  }
}

// Bagian Modul
elseif ($_GET[module]=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/admin/admin.php";
  }
}

// Bagian Kategori
elseif ($_GET[module]=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/kategori/kategori.php";
  }
}


// Bagian Resep
elseif ($_GET[module]=='resep'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/resep/resep.php";
  }
}

// Memanggil Resep Json
elseif ($_GET[module]=='data-json-resep'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/resep/json_resep.php";
  }
}
// memanggil kategori Json
elseif ($_GET[module]=='data-json-ikan'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/data_json/ikan.php";
  }
}


// Memanggil Resep Json
elseif ($_GET[module]=='data-json-kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/kategori/json_kategori.php";
  }
}

// Bagian Kota
elseif ($_GET[module]=='user'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/user/user.php";
  }
}

// Memanggil Resep Json
elseif ($_GET[module]=='data-json-kota'){
  if ($_SESSION['leveluser']=='admin'){
    include "asset/kota/json_kota.php";
  }
}

// Bagian Order
elseif ($_GET[module]=='hubungi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hubungi/hubungi.php";
  }
}

// Bagian Cara Pembelian
elseif ($_GET[module]=='carabeli'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_carabeli/carabeli.php";
  }
}

// Bagian Banner
elseif ($_GET[module]=='rekening'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_rekening/rekening.php";
  }
}

// Bagian Kota/Ongkos Kirim
elseif ($_GET[module]=='ongkoskirim'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ongkoskirim/ongkoskirim.php";
  }
}


// Bagian Laporan
elseif ($_GET[module]=='laporan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporan/laporan.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
