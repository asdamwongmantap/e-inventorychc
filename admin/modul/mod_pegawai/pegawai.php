<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_pegawai/aksi_penyewa.php";
switch($_GET[act]){
  // Tampil penyewa
  default:
    echo "<h2>Pegawai</h2>
          <input type=button value='Tambah Pegawai' onclick=\"window.location.href='?module=pegawai&act=tambahpegawai';\">
          <table>
          <tr><th>no</th><th>NIP</th><th>Nama Pegawai</th><th>Alamat</th><th>No HP</th><th>Email</th><th>Password</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM view_pegawai ORDER BY nip DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
				<td>$r[nip]</td>
                <td>$r[nama]</td>
				<td>$r[alamat]</td>
                <td>$r[nohp]</td>
				<td>$r[email]</td>
				<td>$r[password]</td>
                <td><a href=?module=pegawai&act=editpegawai&id=$r[nip]>Edit</a> | 
		                <a href='$aksi?module=pegawai&act=hapus&id=$r[nip]'>Hapus</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM penyewa"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
 
    break;
  
  case "tambahpegawai":
    echo "<h2>Tambah Pegawai</h2>
          <form method=POST action='$aksi?module=pegawai&act=input'>
          <table width='100%'>";
		  $nopenyewa=mysql_query("select * from view_pegawai order by nip DESC LIMIT 0,1");
						$data=mysql_fetch_array($nopenyewa);
							$kodeawal=substr($data['no_penyewa'],2,3)+1;
							if($kodeawal<10){
								$kode='PA00'.$kodeawal;
								}elseif($kodeawal > 9 && $kodeawal <=99){
								$kode='PA0'.$kodeawal;
								}else{
								$kode='PA'.$kodeawal;
								}
	echo "
		  <tr><td width=100>NIP</td>     <td> : <input type=text name='nip' size=60></td></tr>
          <tr><td width=100>Nama Pegawai</td>     <td> : <input type=text name='nama' size=60></td></tr>
          <tr><td>Alamat</td>  <td> <textarea name='alamat' style='width: 580px; height: 350px;'></textarea></td></tr>
          <tr><td width=100>No HP</td>     <td> : <input type=text name='nohp' size=60></td></tr>
          <tr><td width=100>Email</td>     <td> : <input type=text name='email' size=60></td></tr>
		  <tr><td width=100>Password</td>     <td> : <input type=password name='password' size=60></td></tr>
		  <tr><td width=100>Jabatan</td>     <td> : <input type=text name='jabatan' size=60></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editpegawai":
    $edit = mysql_query("SELECT * FROM view_pegawai WHERE nip='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	

    echo "<h2>Edit Pegawai</h2>
          <form method=POST action='$aksi?module=pegawai&act=update' enctype='multipart/form-data'>
          <input type=text name='id' value=$r[nip]>
          <table>
          <tr><td>Nama Pegawai</td>     <td> : <input type=text name='nama' size=60 value='$r[nama]'></td></tr>
         <tr><td>Alamat</td>   <td> <textarea name='alamat' style='width: 600px; height: 350px;'>$r[alamat]</textarea></td></tr>
         <tr><td>No HP</td>     <td> : <input type=text name='nohp' size=60 value='$r[nohp]'></td></tr>
		 <tr><td>Email</td>     <td> : <input type=text name='email' size=60 value='$r[email]'></td></tr>
		 <tr><td>Password</td>     <td> : <input type=password name='password' size=60 value='$r[password]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>
