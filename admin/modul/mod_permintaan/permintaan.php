<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_permintaan/aksi_permintaan.php";
switch($_GET[act]){
  // Tampil Tagihan
  default:
    echo "<h2>Daftar Permintaan</h2>
          <table>
          <tr><th>No. PR</th><th>Nama Pegawai</th><th>Tanggal PR</th><th>Status</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM tbl_permintaan sh, tbl_pegawai p WHERE sh.nip=p.nip ORDER BY sh.no_pr DESC LIMIT $posisi,$batas");
  
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_pr]);
      echo "<tr><td align=center>$r[no_pr]</td>
				<td>$r[nama]</td>
                <td>$tanggal</td>
                <td>$r[status]</td>
		            <td><a href=?module=permintaan&act=detailpr&id=$r[no_pr]>Detail</a></td></tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT sh.no_pr, sh.tgl_pr, p.nama
FROM tbl_permintaan sh, pegawai p
WHERE sh.nip=p.nip"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;
  
    
  case "detailpr":
    $edit = mysql_query("SELECT * FROM tbl_permintaan sh, tbl_pegawai p WHERE sh.nip=p.nip AND sh.no_pr='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r[tgl_pr]);
    
    if ($r[status]=='Belum Disetujui'){
        $pilihan_status = array('Belum Disetujui', 'Disetujui');
    }
    elseif ($r[status]=='Disetujui'){
        $pilihan_status = array('Belum Disetujui', 'Disetujui');    
    }
    else{
        $pilihan_status = array('Belum Disetujui', 'Disetujui');    
    }

    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<h2>Rincian Permintaan</h2>
          <form method=POST action=$aksi?module=permintaan&act=update>
          <input type=hidden name=id value=$r[no_pr]>

          <table>
          <tr><td>No. PR</td>        <td> : $r[no_pr]</td></tr>
          <tr><td>Tanggal PR</td> <td> : $tanggal</td></tr>
          <tr><td>Status Permintaan      </td><td>: <select name=status>$pilihan_order</select> 
          <input type=submit value='Ubah Status'></td></tr>
          </table></form>";
		  
  // tampilkan data pegawai
  
  echo "<table border=0 width=500>
        <tr><th colspan=2>Data pegawai</th></tr>
        <tr><td>Nama Pegawai</td><td> : $r[nama]</td></tr>
        <tr><td>Alamat</td><td> : $r[alamat]</td></tr>
        <tr><td>No. Telpon/HP</td><td> : $r[nohp]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>
		</table>";


  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM tbl_permintaand tp,tbl_barang a
                                 WHERE tp.kd_barang=a.kd_barang 
                                 AND tp.no_pr='$_GET[id]'");
  
  echo "<table border=0 width=500>
        <tr><th>Nama Barang</th><th>Jumlah</th><th>Sub Total</th></tr>";
  

  while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total		
   $subtotalitemtabel       = $s[jumlah];
   $subtotalitem       = $subtotalitem + $s[jumlah]; 
    $total_item    = $subtotalitem;
    echo "<tr><td>$s[nama_brg]</td><td align=center>$s[jumlah]</td><td align=right>$subtotalitemtabel</td></tr>";
  }
echo "<tr><td colspan=2 align=right>Total              Rp. : </td><td align=right><b>$subtotalitem</b></td></tr>      
      <tr><td colspan=2 align=right>Grand Total        Rp. : </td><td align=right><b>$total_item</b></td></tr>
      </table>";

  break;
}
}
?>
