<script type="text/javascript">
    //set timezone
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" +(sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET[module]=='home'){

 
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola content website. </p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  
}

// Bagian Modul
elseif ($_GET[module]=='modul'){

    include "modul/mod_modul/modul.php";
 
}

// // Bagian Kategori
// elseif ($_GET[module]=='jenis'){
  // if ($_SESSION['leveluser']=='admin'){
    // include "modul/mod_jenis/jenis.php";
  // }
// }

// Bagian alat
elseif ($_GET[module]=='barang'){
 
    include "modul/mod_barang/alat.php";
  
}

// Bagian Mobil
elseif ($_GET[module]=='mobil'){
  
    include "modul/mod_mobil/mobil.php";
  
}

// Bagian penyewa
elseif ($_GET[module]=='pegawai'){
  
    include "modul/mod_pegawai/pegawai.php";
 
}


// Bagian Order
elseif ($_GET[module]=='order'){
 
    include "modul/mod_order/order.php";

}

// Bagian Profil
elseif ($_GET[module]=='pengguna'){
  
    include "modul/mod_pengguna/pengguna.php";
  
}

// Bagian SPK
elseif ($_GET[module]=='downloadspk'){
 
    include "modul/mod_spk/spk.php";

}

// Bagian Cara Pembelian
elseif ($_GET[module]=='carabeli'){
  
    include "modul/mod_carabeli/carabeli.php";
  
}

// Bagian Tagihan
elseif ($_GET[module]=='permintaan'){
  
    include "modul/mod_permintaan/permintaan.php";
  
}

// Bagian Kota/Ongkos Kirim
elseif ($_GET[module]=='ongkoskirim'){
  
    include "modul/mod_ongkoskirim/ongkoskirim.php";
  
}

// Bagian Password
elseif ($_GET[module]=='password'){
  
    include "modul/mod_password/password.php";
  
}

// Bagian Laporan
elseif ($_GET[module]=='laporan'){
  
    include "modul/mod_laporan/laporan.php";
  
}


// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
