<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='order' AND $act=='update'){
   // Update stok barang saat transaksi sukses (Lunas)
   if ($_POST[status]=='Disetujui'){ 
    
      // Update status order
      mysql_query("UPDATE tbl_pesanh SET status='$_POST[status]' where no_order='$_POST[id]'");

      
      header('location:../../media.php?module='.$module);
    }	  
	  elseif($_POST[status]=='Belum Disetujui'){
	   
	    // Update status order Batal
      mysql_query("UPDATE tbl_pesanh SET status='$_POST[status]' where no_order='$_POST[id]'");

	    header('location:../../media.php?module='.$module);
	  }
   
}
}
?>
