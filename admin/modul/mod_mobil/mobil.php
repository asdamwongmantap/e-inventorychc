<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_mobil/aksi_mobil.php";
switch($_GET[act]){
  // Tampil mobil
  default:
    echo "<h2>Mobil</h2>
          <input type=button value='Tambah mobil' onclick=\"window.location.href='?module=mobil&act=tambahmobil';\">
          <table>
          <tr><th>no</th><th>No Polisi</th><th>Jenis</th><th>Merk</th><th>Warna</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM mobil ORDER BY no_pol DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
				
                <td>$r[no_pol]</td>
				<td>$r[jenis]</td>
                <td>$r[merk]</td>
                <td align=center>$r[warna]</td>
                
		            <td><a href='?module=mobil&act=editmobil&id=$r[no_pol]'>Edit</a> | 
		                <a href='$aksi?module=mobil&act=hapus&id=$r[no_pol]'>Hapus</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM mobil"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
 
    break;
  
  case "tambahmobil":
    echo "<h2>Tambah mobil</h2>
          <form method=POST action='$aksi?module=mobil&act=input'>
          <table width='100%'>
		  <tr><td width=100>No Polisi</td>     <td> : <input type=text name='no_pol' size=60></td></tr>
		  <tr><td width=100>Jenis mobil</td>     <td> : <input type=text name='jenis' size=60></td></tr>
          <tr><td>Merk</td>     <td> : <input type=text name='merk' size=60></td></tr>
          <tr><td>Warna</td>     <td> : <input type=text name='warna' size=60></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editmobil":
    $edit = mysql_query("SELECT * FROM mobil WHERE no_pol='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit mobil</h2>
          <form method=POST action='$aksi?module=mobil&act=update'>
          <input type=hidden name='id' value='$r[no_pol]'>
          <table>
          <tr><td>Jenis Mobil</td>  <td> : <input type=text name='jenis' size=60 value='$r[jenis]'></td></tr>
          <tr><td>Merk</td>     <td> : <input type=text name='merk' value=$r[merk] size=60></td></tr>
          <tr><td>Warna</td>     <td> : <input type=text name='warna' value=$r[warna] size=60></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>