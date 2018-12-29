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

// Hapus penyewa
if ($module=='pegawai' AND $act=='hapus'){
         mysql_query("DELETE FROM tbl_login WHERE username='$_GET[id]'");
		 mysql_query("DELETE FROM tbl_pegawai WHERE nip='$_GET[id]'");
		 
  header('location:../../media.php?module='.$module);

}

// Input penyewa
elseif ($module=='pegawai' AND $act=='input'){
 

    mysql_query("INSERT INTO tbl_pegawai(nip,
									nama,
                                    alamat,
                                    nohp,
									email,
									jabatan) 
                            VALUES( '$_POST[nip]',
									'$_POST[nama]',
                                   '$_POST[alamat]',
                                   '$_POST[nohp]',
                                   '$_POST[email]',
                                   '$_POST[jabatan]')");
								   
	mysql_query("INSERT INTO tbl_login(username,
									password) 
                            VALUES( '$_POST[nip]',
									md5('$_POST[password]'))");
  header('location:../../media.php?module='.$module);
  
}

// Update penyewa
elseif ($module=='pegawai' AND $act=='update'){
  
    mysql_query("UPDATE tbl_pegawai SET nama = '$_POST[nama]',
                                   alamat       = '$_POST[alamat]',
                                   nohp        = '$_POST[nohp]',
								   email='$_POST[email]',
								   jabatan='$_POST[jabatan]'
                             WHERE nip   = '$_POST[id]'");
							 
	mysql_query("UPDATE tbl_login SET password = md5('$_POST[password]')
                             WHERE username   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  
}
}
?>