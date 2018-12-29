<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus mobil
if ($module=='mobil' AND $act=='hapus'){
         mysql_query("DELETE FROM mobil WHERE no_pol='$_GET[id]'");
  
  header('location:../../media.php?module='.$module);

}

// Input mobil
elseif ($module=='mobil' AND $act=='input'){
 

    mysql_query("INSERT INTO mobil(	no_pol,
									jenis,
                                    merk,
                                    warna) 
                            VALUES( '$_POST[no_pol]',
									'$_POST[jenis]',
                                   '$_POST[merk]',
                                   '$_POST[warna]')");
  header('location:../../media.php?module='.$module);
  
}

// Update mobil
elseif ($module=='mobil' AND $act=='update'){
  
    mysql_query("UPDATE mobil SET jenis = '$_POST[jenis]',
                                   merk       = '$_POST[merk]',
                                   warna        = '$_POST[warna]'   
                             WHERE no_pol   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  
}
}
?>