<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='keranjang' AND $act=='tambah'){

	$sid = session_id();

	$sql2 = mysql_query("SELECT stok FROM tbl_barang WHERE kd_barang='$_GET[id]'");
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
	$sql = mysql_query("SELECT kd_barang FROM tbl_mintasementara
			WHERE kd_barang='$_GET[id]' AND id_session='$sid'");
	$ketemu=mysql_num_rows($sql);
	if ($ketemu < 1){
		// put the product in cart table
		mysql_query("INSERT INTO tbl_mintasementara (tgl_pr_sementara,id_session, kd_barang, banyak)
				VALUES ('$tgl_sekarang','$sid', '$_GET[id]', 1)");
		
	} else {
		// update product quantity in cart table
		mysql_query("UPDATE tbl_mintasementara 
		        SET banyak = banyak + 1
				WHERE id_session ='$sid' AND kd_barang='$_GET[id]'");		
	}	
	deleteAbandonedCart();
	header('Location:media.php?module=keranjang');
  }				
}
}

elseif ($module=='keranjang' AND $act=='hapus'){
	mysql_query("DELETE FROM tbl_mintasementara WHERE no_pr_sementara='$_GET[id]'");
	header('Location:media.php?module=keranjang');				
}

elseif ($module=='keranjang' AND $act=='update'){
  $id       = $_POST[id];
  $jml_data = count($id);
  $jumlah   = $_POST[jml]; // quantity

  for ($i=1; $i <= $jml_data; $i++){
	$sql2 = mysql_query("SELECT*FROM tbl_mintasementara WHERE no_pr_sementara='".$id[$i]."'");
	while($r=mysql_fetch_array($sql2)){
    
      mysql_query("UPDATE tbl_mintasementara SET banyak = '".$jumlah[$i]."'
                                      WHERE no_pr_sementara = '".$id[$i]."'");
      header('Location:media.php?module=keranjang');	
    
  }
  }
}
elseif ($module=='keranjang' AND $act=='tambahpesanan'){
$kdbarang   = $_POST[kd_barang];
$banyak   = $_POST[banyak];
	$sid = session_id();
	mysql_query("INSERT INTO tbl_pesansementara (id_session, kd_barang, banyak)
				VALUES ('$sid', '$kdbarang', '$banyak')");
	
  }

/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM tbl_mintasementara 
	        WHERE tgl_belanja < '$kemarin'");
}
?>