<?php
include "config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = $_POST['nip'];
$pass     = md5($_POST['password']);

// pastikan username dan password adalah berupa huruf atau angka.
// if (!ctype_alnum($username) OR !ctype_alnum($pass)){
 // echo "Maaf Anda Harus memasukkan username atau password dengan benar !!";
// }
// else{
$login=mysql_query("SELECT * FROM tbl_login WHERE username='$username' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  
$identity=mysql_query("SELECT * FROM tbl_pegawai WHERE nip='$username'");
$s=mysql_fetch_array($identity);
  
 $_SESSION[namauser]     = $r[username];
 $_SESSION[namauser]     = $s[nip];
 $_SESSION[namalengkap]  = $s[nama];
 $_SESSION[passuser]     = $r[password];
 $_SESSION[leveluser]     = $s[jabatan];

    $sid_lama = session_id();
	session_regenerate_id();
	$sid_baru = session_id();
	

  header('location:media.php?module=home');
  
}
else{
 echo "<script>alert('Login Gagal, username atau password anda salah'); window.location = 'media.php?module=login'</script>";
}
//}
?>