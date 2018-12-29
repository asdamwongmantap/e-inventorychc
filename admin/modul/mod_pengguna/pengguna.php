<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_pengguna/aksi_pengguna.php";
switch($_GET[act]){
  // Tampil pengguna
  default:
    echo "<h2>Pengguna</h2>
          <input type=button value='Tambah Pengguna' onclick=\"window.location.href='?module=pengguna&act=tambahpengguna';\">
          <table>
          <tr><th>no</th><th>Username</th><th>Password</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM tbl_login ORDER BY username DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
				
                <td>$r[username]</td>
				<td>$r[password]</td>
                <td><a href=?module=pengguna&act=editpengguna&id=$r[username]>Edit</a> | 
		                <a href='$aksi?module=pengguna&act=hapus&id=$r[username]'>Hapus</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pengguna"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
 
    break;
  
  case "tambahpengguna":
    echo "<h2>Tambah Pengguna</h2>
          <form method=POST action='$aksi?module=pengguna&act=input'>
          <table width='100%'>
		  <tr><td width=100>Username</td>     <td> : <input type=text name='username' size=60></td></tr>
          <tr><td width=100>Password</td>     <td> : <input type=password name='password' size=60></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editpengguna":
    $edit = mysql_query("SELECT * FROM tbl_login WHERE username='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Pengguna</h2>
          <form method=POST action=$aksi?module=pengguna&act=update>
          <input type=hidden name=id value=$r[username]>
          <table>
          <tr><td width=70>Password</td>     <td> : <input type=password name='password' size=60 value='$r[password]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>