<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_alat/aksi_alat.php";
switch($_GET[act]){
  // Tampil alat
  default:
    echo "<h2>Barang</h2>
          <input type='button' class='button' style='color:white;background:#a2324c;' value='Tambah Barang' onclick=\"window.location.href='?module=barang&act=tambahbarang';\">
          <table style='width:100%;'>
          <tr><th>no</th><th>nama alat</th><th>Jenis Barang</th><th>Posisi</th><th>stok</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM view_barang ORDER BY kd_barang DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      echo "<tr style='text-align:center;'><td>$no</td>
				
                <td><a href=?module=barang&act=editbarang&id=$r[kd_barang]>$r[nama_brg]</a></td>
				<td>$r[jenisbrg]</td>
                <td>$r[posisi]</td>
                <td align=center>$r[stok]</td>
                
		            <td><a href='$aksi?module=barang&act=hapus&id=$r[kd_barang]'><img src=../images/delete.png border=0 title=Hapus></a>&nbsp;&nbsp;<a href='?module=barang&act=editbarang&id=$r[kd_barang]'><img src=../images/services.png border=0 title=Ubah></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM view_barang"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
 
    break;
  
  case "tambahbarang":
    echo "<h2>Tambah Barang</h2>
          <form method=POST action='$aksi?module=barang&act=input' enctype='multipart/form-data'>
          <table width='100%'>
		  <tr><td width=100>Kode Barang</td>     <td> : <input type=text name='kd_barang' size=60></td></tr>
          <tr><td width=100>Nama Barang</td>     <td> : <input type=text name='nama_brg' size=60></td></tr>
		  <tr><td width=100>Jenis Barang</td>     <td> : <input type=text name='jenisbrg' size=60></td></tr>
          <tr><td>Posisi</td>     <td> : <input type=text name='posisi' size=10></td></tr>
          <tr><td>Deskripsi</td>  <td> <textarea name='deskripsi' style='width: 580px; height: 350px;'></textarea></td></tr>
		  <tr><td>Stok</td>     <td> : <input type=text name='stok' size=3></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editbarang":
    $edit = mysql_query("SELECT * FROM view_barang WHERE kd_barang='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	

    echo "<h2>Edit Barang</h2>
          <form method=POST action='$aksi?module=barang&act=update' enctype='multipart/form-data'>
          <input type=hidden name='id' value=$r[kd_barang]>
          <table>
          <tr><td>Nama alat</td>     <td> : <input type=text name='nama_brg' size=60 value='$r[nama_brg]'></td></tr>
          <tr><td>Jenis</td>  <td> : <input type=text name='jenisbrg' size=60 value='$r[jenisbrg]'><input type=hidden name='kd_jenisbrg' size=30 value='$r[kd_jenisbrg]'></td></tr>
          <tr><td>Posisi</td>     <td> : <input type=text name='posisi' value=$r[posisi] size=10></td></tr>
		  <tr><td>Deskripsi</td>   <td> <textarea name='deskripsi' style='width: 600px; height: 350px;'>$r[deskripsi]</textarea></td></tr>
          <tr><td>Stok</td>     <td> : <input type=text name='stok' value=$r[stok] size=3></td></tr>
          <tr><td>Gambar</td> <td> :  
          <img src='../foto_produk/small_$r[gambar]' /></td></tr>
          <tr><td>Ganti Gambar</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>
