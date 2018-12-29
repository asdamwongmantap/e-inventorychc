<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='tensip' AND $act=='tambah'){

	$sid = session_id();

	$sql2 = mysql_query("SELECT stok FROM alat WHERE no_alat='$_GET[id]'");
	$r=mysql_fetch_array($sql2);
	$stok=$r[stok];
  
  if ($stok == 0){
      echo "stok habis";
  }
  else{
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<script>alert('Silahkan LOGIN Terlebih Dahulu'); window.location = 'media.php?module=login'</script>";
}
else{
	// check if the product is already
	// in cart table for this session
	$sql = mysql_query("SELECT no_alat FROM sewa_sementara
			WHERE no_alat='$_GET[id]' AND id_session='$sid'");
	$ketemu=mysql_num_rows($sql);
	if ($ketemu==0){
		// put the product in cart table
		mysql_query("INSERT INTO sewa_sementara (tgl_sewa_sementara,id_session, no_alat, banyak, totaljam)
				VALUES ('$tgl_sekarang','$sid', '$_GET[id]', 1, 1)");
	} else {
		// update product quantity in cart table
		mysql_query("UPDATE sewa_sementara 
		        SET jumlah = jumlah + 1
				WHERE id_session ='$sid' AND no_alat='$_GET[id]'");		
	}	
	deleteAbandonedCart();
	header('Location:media.php?module=tensip');
  }				
}
}

elseif ($module=='tensip' AND $act=='hapus'){
	mysql_query("DELETE FROM sewa_sementara WHERE no_sewa_sementara='$_GET[id]'");
	header('Location:media.php?module=tensip');				
}

//update subtotaljam
elseif ($module=='tensip' AND $act=='update'){
  $id       = $_POST[id];
  
  $jml_data = count($id);
  $jammulai   = $_POST[jam_mulai]; //Jam Mulai
  $jamselesai   = $_POST[jam_selesai]; //Jam Selesai
  
  function selisih($jammulai, $jamselesai)
  {
  list ($h,$m,$s)=explode(":",$jammulai);
  $dtawal=mktime($h,$m,$s,"1","1","1");
  list ($h,$m,$s)=explode(":",$jamselesai);
  $dtakhir=mktime($h,$m,$s,"1","1","1");
  $dtselisih=$dtakhir-$dtawal;
  
  $totalmenit=$dtselisih/60;
  $totaldetik=$totalmenit/60;
  $jam=explode(".",$totalmenit/60);
  $menit=explode(".",$totaldetik/60);
  $sisamenit=($totalmenit/60)-$jam[0];
  $sisadetik=($totaldetik/60)-$menit[0];
  $sisamenit2=$sisamenit*60;
  $sisadetik2=$sisadetik*60;
  
  return "$jam[0] $menit[0] $sisadetik2";
  header('Location:media.php?module=tensip');
  
  }
  
  
}


/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM sewa_sementara 
	        WHERE tgl_belanja < '$kemarin'");
}
?>