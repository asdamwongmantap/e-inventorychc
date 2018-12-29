<?php
include "config/koneksi.php";
session_start();
$kar1=strstr($_POST['email'], "@");
$kar2=strstr($_POST['email'], ".");

// Cek email penyewa di database
$cek_email=mysql_num_rows(mysql_query("SELECT email FROM penyewa WHERE email='$_POST[email]'"));
// Kalau email sudah ada yang pakai
if ($cek_email > 0){
  echo "Email <b>$_POST[email]</b> sudah ada yang pakai.<br />
        <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
elseif (empty($_POST['nama_penyewa']) || empty($_POST['password']) || empty($_POST['alamat']) || empty($_POST['nohp']) || empty($_POST['email'])){
  echo "Data yang Anda isikan belum lengkap<br />
  	    <a href='selesai-belanja.html'><b>Ulangi Lagi</b>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama_penyewa]")){
  echo "Nama tidak boleh diisi dengan angka atau simbol.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

if(!empty($_POST['kode'])){
  if($_POST['kode']==$_SESSION['captcha_session']){

$no_penyewa   = $_POST['no_penyewa'];
$nama_penyewa   = $_POST['nama_penyewa'];
$alamat = $_POST['alamat'];
$telpon = $_POST['nohp'];
$email = $_POST['email'];
$password=$_POST['password'];

// simpan data penyewa 
mysql_query("INSERT INTO penyewa(no_penyewa, nama_penyewa, password, alamat, nohp, email) 
             VALUES('$no_penyewa','$nama_penyewa','$password','$alamat','$telpon','$email')");
			 header('location:media.php?module=home');
			 }
else{
echo "Kode yang Anda masukkan tidak cocok<br />
<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
}
?>