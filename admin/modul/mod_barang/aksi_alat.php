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

// Hapus alat
if ($module=='barang' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM tbl_barang WHERE kd_barang='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM tbl_barang WHERE kd_barang='$_GET[id]'");
	 
     unlink("../../../foto_produk/$_GET[namafile]");   
     unlink("../../../foto_produk/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM tbl_barang WHERE kd_barang='$_GET[id]'");
	 
	 
  }
		header('location:../../media.php?module='.$module);

  }


// Input alat
elseif ($module=='barang' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $alat_seo      = seo_title($_POST[nama_alat]);
 

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=barang)</script>";
    }
    else{
    UploadImage($nama_file_unik);

    mysql_query("INSERT INTO tbl_barang(kd_barang,
									nama_brg,
									kd_jenisbrg,
                                    posisi,
									deskripsi,
                                    stok,
                                    gambar) 
                            VALUES( '$_POST[kd_barang]',
									'$_POST[nama_brg]',
									'$_POST[jenisbrg]',
                                   '$_POST[posisi]',
                                   '$_POST[deskripsi]',
                                   '$_POST[stok]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO tbl_barang(kd_barang,
									nama_brg,
									jenisbrg,
                                    posisi,
									deskripsi,
                                    stok) 
                            VALUES( '$_POST[kd_barang]',
									'$_POST[nama_brg]',
									'$_POST[jenisbrg]',
                                   '$_POST[posisi]',
                                   '$_POST[deskripsi]',
                                   '$_POST[stok]',
                                   '$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }
}

// Update alat
elseif ($module=='barang' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

    $alat_seo      = seo_title($_POST[nama_brg]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE tbl_barang SET nama_brg = '$_POST[nama_brg]', 
                                   kd_jenisbrg = '$_POST[kd_jenisbrg]',
                                   posisi       = '$_POST[posisi]',
								   deskripsi   = '$_POST[deskripsi]',
                                   stok        = '$_POST[stok]'
                             WHERE kd_barang   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=barang)</script>";
    }
    else{
    UploadImage($nama_file_unik);
    mysql_query("UPDATE tbl_barang SET nama_brg = '$_POST[nama_brg]', 
                                   kd_jenisbrg = '$_POST[kd_jenisbrg]',
                                   posisi       = '$_POST[posisi]',
								   deskripsi   = '$_POST[deskripsi]',
                                   stok        = '$_POST[stok]',
                                   gambar      = '$nama_file_unik'   
                             WHERE kd_barang   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
    }
  }
}
}
?>
