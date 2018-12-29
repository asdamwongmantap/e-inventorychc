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

// Hapus pengguna
if ($module=='pengguna' AND $act=='hapus'){
         mysql_query("DELETE FROM pengguna WHERE username='$_GET[id]'");
  
  header('location:../../media.php?module='.$module);

}

// Input pengguna
elseif ($module=='pengguna' AND $act=='input'){
 

    mysql_query("INSERT INTO tbl_login(	username,
									password) 
                            VALUES( '$_POST[username]',
									md5('$_POST[password]'))");
  header('location:../../media.php?module='.$module);
  
}

// Update pengguna
elseif ($module=='pengguna' AND $act=='update'){
  
    mysql_query("UPDATE tbl_login SET password = md5('$_POST[password]') WHERE username   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  
}
}
?>