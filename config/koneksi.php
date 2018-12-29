<?php
$server = "localhost";//hosting online mysql
$username = "root";//username online
$password = "";//pasword online
$database = "sinventori_chc";//db_name online

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
