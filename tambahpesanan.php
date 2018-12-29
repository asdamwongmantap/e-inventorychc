<?php 
session_start();
error_reporting(0);
include 'config/koneksi.php';
include 'config/library.php';
$sid = session_id();
$tgl_sekarang = date("Ymd");
$namabarang   = $_POST['nama_barang'];
$banyak   = $_POST['banyak'];
	mysql_query("INSERT INTO tbl_pesansementara (tgl_order_sementara,id_session, nama_barang, banyak)
				VALUES ('$tgl_sekarang','$sid', '$namabarang','$banyak')");
?>