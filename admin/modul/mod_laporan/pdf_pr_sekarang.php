<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
error_reporting(0);

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
$pdf->addText(200, 820, 16,'<b>Laporan Penyewaan</b>');
$pdf->addText(200, 800, 14,'<b>CV. Kramat Teknik</b>');
// Garis atas untuk header
$pdf->line(10, 795, 578, 795);

// Garis bawah untuk footer
$pdf->line(10, 50, 578, 50);
// Teks kiri bawah
$pdf->addText(30,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s'));

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

$sekarang=date('Y-m-d');

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("SELECT sh.id_sewa as faktur,DATE_FORMAT(sh.tgl_sewa, '%d-%m-%Y') as tanggal, p.nama_penyewa,
                    a.nama_alat,sd.banyak,a.harga 
                    FROM sewa_header sh, sewa_detail sd, alat a, penyewa p 
                    WHERE (sd.no_alat=a.no_alat) 
                    AND (sd.id_sewa=sh.id_sewa) 
					AND (sh.no_penyewa=p.no_penyewa)
					AND (sh.tgl_sewa='$sekarang')");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $quantityharga=rp($r[banyak]*$r[harga]);
  $hargarp=rp($r[harga]); 
  $faktur=$r[faktur];
  
  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>Faktur</b>'=>$faktur, 
                  '<b>Tanggal</b>'=>$r[tanggal], 
				  '<b>Penyewa</b>'=>$r[nama_penyewa],
                  '<b>Nama Alat</b>'=>$r[nama_alat], 
                  '<b>Qty</b>'=>$r[banyak], 
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
  $skrg=date('d-M-Y');
  echo "Tidak ada Penyewaan pada Tanggal ; <b>$skrg</b><br /><br />
       <input type=button value=Kembali onclick=self.history.back()>";
}
}
?>
