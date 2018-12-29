<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "class.ezpdf.php";
include "../../../config/koneksi.php";
include "rupiah.php";
  
$pdf = new Cezpdf();
 
// Set margin dan font
$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('fonts/Courier.afm');

$all = $pdf->openObject();

// Tampilkan logo
$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo.jpg',20,800,69);

// Teks di tengah atas untuk judul header
$pdf->addText(200, 820, 16,'<b>INVOICE</b>');
// Garis atas untuk header
$pdf->line(10, 795, 578, 795);

// Garis bawah untuk footer
$pdf->line(10, 50, 578, 50);
// Teks kiri bawah
$pdf->addText(30,34,8,'Dicetak Tanggal:' . date( 'd-m-Y, H:i:s'));

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

// Baca input tanggal yang dikirimkan user
$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$id_sewa=$_GET['id_sewa'];
$sql5 = "SELECT * FROM sewa_header sh, penyewa p WHERE sh.no_penyewa=p.no_penyewa AND sh.id_sewa='$id_sewa'";
$hasil5 = mysql_query($sql5);
$tpp = mysql_fetch_array($hasil5);
				  '<b>Nama Lengkap</b>'=>$tpp[nama_penyewa], 
                  '<b>Alamat</b>'=>$tpp[alamat], 
				  '<b>No HP</b>'=>$tpp[nohp],
                  '<b>NEmail</b>'=>$tpp[email];

$sql=mysql_query("SELECT * FROM tensip_peminjaman tp,alat a
                                 WHERE tp.no_alat=a.no_alat 
                                 AND tp.id_sewa='$id_sewa'");

$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $quantityharga=rp($r[banyak]*$r[harga]);
  $hargarp=rp($r[harga]); 
  $faktur=$r[faktur];
  
  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>Nama Alat</b>'=>$r[nama_alat], 
                  '<b>Waktu</b>'=>$r[subtotal_jam]'Jam', 
                  '<b>Harga</b>'=>$hargarp,
                  '<b>Sub Total</b>'=>$quantityharga);
	$total = $total+($r[banyak]*$r[harga]);
	$totqu = $totqu + $r[banyak];
  $i++;
}

$pdf->ezTable($data, '', '', '');

$tot=rp($total);
$pdf->ezText("\n\nTotal keseluruhan : Rp. {$tot}");
$pdf->ezText("\nBanyak yang Disewa : {$jml} unit");
$pdf->ezText("Banyak Keseluruhan Alat Yang Disewa: {$totqu} unit");

// Penomoran halaman
$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
}
else{
  $m=$_POST[tgl_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[thn_mulai];
  $s=$_POST[tgl_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[thn_selesai];
  echo "Tidak ada Penyewaan pada Tanggal $m s/d $s";
}
}
?>
