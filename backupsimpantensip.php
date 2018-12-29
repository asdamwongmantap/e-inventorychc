<?php

//simpan tensip
elseif ($_GET[module]=='simpantensip'){

$id_sewa=$_POST['id_sewa'];
$sql5 = "SELECT * FROM sewa_header sh, penyewa p WHERE sh.no_penyewa=p.no_penyewa AND sh.id_sewa='$id_sewa'";
$hasil5 = mysql_query($sql5);
$tpp = mysql_fetch_array($hasil5);

$id       = $_POST[id];
  $jml_data = count($id);
  $jammulai   = $_POST['jam_mulai']; // jam mulai
  $jamselesai   = $_POST['jam_selesai']; // jam mulai
  $subtotaljam=$_POST['subtotal_jam'];
  $noalat=$_POST['no_alat'];
  $tglkerja=$_POST['tgl_kerja'];
  for ($i=1; $i <= $jml_data; $i++){

      mysql_query("UPDATE tensip_peminjaman SET tgl_kerja='$tglkerja',jam_mulai = '".$jammulai[$i]."', jam_selesai = '".$jamselesai[$i]."',subtotal_jam = '".$subtotaljam[$i]."' WHERE id_sewa = '$id_sewa' AND no_alat='".$noalat[$i]."'");
      
	  }
	  
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
     
      <table>
      <tr><td>Nama Lengkap   </td><td> : <b>$tpp[nama_penyewa]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $tpp[alamat] </td></tr>
      <tr><td>Telpon         </td><td> : $tpp[nohp] </td></tr>
      <tr><td>E-mail         </td><td> : $tpp[email] </td></tr></table><hr /><br />
      
      Nomor Order: <b>$id_sewa</b><br /><br />";

      $daftaralat=mysql_query("SELECT * FROM tensip_peminjaman tp,alat a
                                 WHERE tp.no_alat=a.no_alat 
                                 AND tp.id_sewa='$id_sewa'");

echo "<table cellpadding=10 border=1>
      <tr><th>No</th><th>Nama Alat</th><th colspan=2>Jumlah</th><th>Harga Per-Jam</th><th>Sub Total</th></tr>";
      
$sewa="Tensip peminjaman <br /><br />  
        Nama: $tpp[nama_penyewa] <br />
        Alamat: $tpp[alamat] <br/>
        Telpon: $tpp[nohp] <br /><hr />
        
        Nomor Order: $id_sewa <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
        
$no=1;
while ($d=mysql_fetch_array($daftaralat)){
   
   $subtotal    = $d[harga] * $d[subtotal_jam] ;
   $subtotaljam    = $d[subtotal_jam] ;

   $total       = $total + $subtotal;
   $totaljam       = $totaljam + $subtotaljam;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($d[harga]);
   $grandtotal=$total*$totaljam;
   $grandtotal_rp=format_rupiah($grandtotal);
   

   echo "<tr><td>$no</td><td>$d[nama_alat]</td><td align=center>$d[subtotal_jam]</td><td>Jam</td>                             <td align=right>$d[harga]</td><td align=right>$subtotal_rp</td></tr>";

   $sewa.="$d[jumlah] $d[nama_alat] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}
 echo "<tr><td colspan=5 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
          
	    <tr><td colspan=5 align=right>Total Jam : </td><td align=right><b>$totaljam Jam</b></td></tr>
            
      <tr><td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";
	  
     // echo "<script>window.alert('TENSIP BERHASIL DIMASUKKAN');
        // window.location=('media.php?module=home')</script>";
		echo "
          </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";  
  
  
}
?>