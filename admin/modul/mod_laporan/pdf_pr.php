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
$pdf->addText(200, 820, 16,'<b>Laporan Permintaan Barang</b>');
$pdf->addText(200, 800, 14,'<b>PT. Cigading Habeam Centre</b>');
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
$sql = mysql_query("SELECT sh.no_pr as faktur,DATE_FORMAT(sh.tgl_pr, '%d-%m-%Y') as tanggal, p.nama,
                    a.nama_brg,sd.jumlah 
                    FROM tbl_permintaan sh, tbl_permintaand sd, tbl_barang a, tbl_pegawai p 
                    WHERE (sd.kd_barang=a.kd_barang) 
                    AND (sd.no_pr=sh.no_pr) 
					AND (sh.nip=p.nip)
					AND (sh.tgl_pr BETWEEN '$mulai' AND '$selesai')");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $quantityharga=rp($r[banyak]*$r[harga]);
  $hargarp=rp($r[harga]); 
  $faktur=$r[faktur];
   $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
 $bln_skrg = $array_bulan[date('n')];
//$bln_skrg = date("m");
$thn_skrg = date ("Y");

  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>No. PR</b>'=>$faktur .'/CHC/FPMB/' .$bln_skrg.'/'.$thn_skrg , 
                  '<b>Tanggal</b>'=>$r[tanggal], 
				  '<b>Nama Pegawai</b>'=>$r[nama],
                  '<b>Nama Alat</b>'=>$r[nama_brg], 
                  '<b>Qty</b>'=>$r[jumlah], 
                  '<b>Sub Total</b>'=>$r[jumlah]);
	$total = $total+$r[jumlah];
	$totqu = $totqu + $r[jumlah];
  $i++;
}

$pdf->ezTable($data, '', '', '');

$tot=rp($total);
$pdf->ezText("\n\nTotal keseluruhan Barang : Rp. {$total}");
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
