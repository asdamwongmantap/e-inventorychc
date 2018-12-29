<script language="javascript">
function validasi(form){

function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;
  return true;
}
</script>

<?php
// Halaman utama (Home)
if ($_GET[module]=='home'){
  $sql=mysql_query("SELECT * FROM tbl_barang ORDER BY kd_barang DESC LIMIT 12");
  while ($r=mysql_fetch_array($sql)){
    
    include "diskon_stok.php";

    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title' style='background:#a2324c;'><a href='media.php?module=detailalat&id=$r[kd_barang]'>$r[nama_brg]</a></div>
             <div class='product_img'>
               <a href='foto_produk/$r[gambar]' title='$r[nama_brg]' class='lightbox'>
               <img src='foto_produk/$r[gambar]' border='0' height='110' title='klik untuk memperbesar gambar' /></a>
              </div>
          <div class='prod_price' style='background:#a2324c;'>$divharga</div>
		  <div style='margin-top:10px;'>$tombol&nbsp;<a href='media.php?module=detailalat&id=$r[kd_barang]' class='button' style='color:white;background:#a2324c;'>Detail</a></div>
		  
            </div>
          <div class='bottom_prod_box'></div>
          
          </div>";
  }
}


// Modul detail alat
elseif ($_GET[module]=='detailalat'){
  // Tampilkan detail alat berdasarkan alat yang dipilih
	$detail=mysql_query("SELECT * FROM alat    
                      WHERE alat.kd_barang='$_GET[id]'");
	$r = mysql_fetch_array($detail);
  
  include "diskon_stok.php";
  
  echo "
    	  <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
                 <div class='product_img_big'>
                   <a href='foto_produk/$r[gambar]' title='$r[nama_brg]' class='lightbox'>
               <img src='foto_produk/$r[gambar]' border='0' height='110' title='klik untuk memperbesar gambar' /></a><br />
            <div class='prod_price' style='background:#a2324c;'>$divharga</div>
           
            $tombol
            </div>
          <div class='details_big_box'>
            <div class='product_title_big'>$r[nama_brg]</div>
              <div>$r[deskripsi]</div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";                                      
}


// Menu utama di header

// Modul profil
elseif ($_GET[module]=='profilkami'){
  
  echo "
    	  <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
                 
          <div class='details_big_box'>
            <div class='product_title_big'>Profil PT. Cigading Habeam Centre</div>
              <div style='width:600px;'>PT. Cigading Habeam Centre merupakan perusahaan baja yang berada di daerah Cilegon, Banten.<br> Perusahaan ini bergerak di bidang produksi baja untuk keperluan bangunan industri, pabrik-pabrik, pembuatan jembatan, dan perusahaan.</div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";                              
}


// Modul cara pembelian
elseif ($_GET[module]=='caraminta'){
  

  echo "
    	  <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
                 
          <div class='details_big_box'>
            <div class='product_title_big' style='width:700px;border:0px solid black;text-transform:uppercase;text-align:center;'><h3>Prosedur Permintaan Barang PT. Cigading Habeam Centre</h3></div>
				<div style='width:800px;'><ol>
				<li>Pegawai Harus melakukan LOGIN Terlebih Dahulu Agar Dapat Melakukan Permintaan Barang</li></p><p></p>
				<li>Apabila Pegawai Belum Mempunyai Akun Maka Harus mendaftar terlebih dahulu</li></p><p></p>
			  <li>Setelah melakukan LOGIN, Klik pada tombol MINTA pada alat yang ingin Anda minta.</li></p><p></p>
				<li>Alat yang Anda minta akan masuk ke dalam Daftar Permintaan.</li></p><p></p>
				<li>Anda dapat melakukan perubahan jumlah alat yang diinginkan dengan mengganti angka di kolom Jumlah, kemudian klik tombol Update. Sedangkan untuk menghapus sebuah alat dari Daftar Permintaan, klik tombol <font style='weight:boldest;'>X</font> yang berada di kolom paling kanan.</li></p><p></p>
				<li>Jika sudah selesai, klik tombol Selesai , maka akan tampil form untuk pengisian data pegawai.</li></p><p></p>
				<li>Setelah data pegawai selesai diisikan, klik tombol Proses, maka akan tampil data pegawai beserta alat yang dimintanya (jika diperlukan catat nomor permintaan yang tertera dihalaman). Dan juga ada total barang.</li></p><p></p>
				</div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
			<a href='' class='button' style='float:left;background:#a2324c;'>Cetak</a>
          </div>";                              
}


// Modul semua alat
elseif ($_GET[module]=='semuaalat'){

 
  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging2;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan semua alat
  $sql=mysql_query("SELECT * FROM tbl_barang ORDER BY kd_barang DESC LIMIT $posisi,$batas");

  while ($r=mysql_fetch_array($sql)){
  
    include "diskon_stok.php";

     echo "<div class='prod_box' style='border-radius:4px;border:1px solid #a2324c;margin-top:10px;margin-bottom:10px;margin-right:20px;'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title' style='background:#a2324c;'><a href='media.php?module=detailalat&id=$r[kd_barang]'>$r[nama_brg]</a></div>
             <div class='product_img'>
               <a href='foto_produk/$r[gambar]' title='$r[nama_brg]' class='lightbox'>
               <img src='foto_produk/$r[gambar]' border='0' height='110' title='klik untuk memperbesar gambar' /></a>
              </div>
          <div class='prod_price' style='background:#a2324c;'>$divharga</div>
		   <div style='margin-top:10px;'>$tombol&nbsp;<a href='media.php?module=detailalat&id=$r[kd_barang]' class='button' style='color:white;background:#a2324c;'>Detail</a></div>
		  
            </div>
          <div class='bottom_prod_box'></div>
          </div>";
  }  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM tbl_barang"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halalat], $jmlhalaman);

  echo "<div class='center_title_bar' style='background:#ffffff;float:left;text-align:left;width:100%;height:60px;'>Halaman Ke : $linkHalaman </div>";
}


// Modul keranjang belanja
elseif ($_GET[module]=='keranjang'){
  // Tampilkan alat-alat yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM tbl_mintasementara, view_barang 
			                WHERE tbl_mintasementara.id_session='$sid' AND tbl_mintasementara.kd_barang=view_barang.kd_barang");
  $ketemu=mysql_num_rows($sql);
  if($ketemu=0){
    echo "<script>window.alert('Daftar barang yang akan Diminta Masih Kosong');
        window.location=('media.php?module=home')</script>";
    }
  else{  
 $user= $_SESSION[namauser];
 $password=$_SESSION[passuser];

$sql1 = "SELECT * FROM tbl_pegawai WHERE nip='$user'";
$hasil1 = mysql_query($sql1);
$rpa = mysql_fetch_array($hasil1);
    echo "
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
          <form method=post action=media.php?module=simpantransaksimember enctype='multipart/form-data'>
		  
		  <table>
      <tr><td>Nama Lengkap</td><td> : <input type=text name=nama value='$rpa[nama]' disabled/></td></tr>
      <tr><td>Alamat</td><td> : <input type=text name=alamat value='$rpa[alamat]' disabled/>
     </td></tr>
      <tr><td>Telpon/HP</td><td> : <input type=text name=nohp value='$rpa[nohp]' disabled/></td></tr>
      <tr><td>Email</td><td> : <input type=text name=email value='$rpa[email]' disabled/></td></tr>
      <tr><td>&nbsp;</td><td>&nbsp;<input type=submit class='button' name=submit style='color:white;background:#a2324c;' Value=PROSES size=40></td></tr>
      </table>
	  </form>
		  
		  <form method=post action=aksi.php?module=keranjang&act=update>
          <table border=1 width=620px height=300px cellpadding=3 align=center>
          <tbody>
          <tr bgcolor=#ffffff><th>No</th><th width='200px'>Nama Barang</th><th>Jenis Barang</th><th>Jumlah</th>
          <th>Tindakan</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){  
    $subtotalitem       = $subtotalitem + $r[banyak];  
    $total_item    = $subtotalitem;
    echo "<tr bgcolor=#ffffff>
			<td>$no</td>
			<input type=hidden name=id[$no] value=$r[no_pr_sementara]>
              <td>$r[nama_brg]</td>
			  <td>$r[jenisbrg]</td>
				<td><select name='jml[$no]' value=$r[banyak] style='width:50px;' onChange='this.form.submit()'>";
              for ($j=1;$j <= $r[stok];$j++){
                  if($j == $r[banyak]){
                   echo "<option selected>$j</option>";
                  }else{
                   echo "<option>$j</option>";
                  }
              }
			  echo "
			  </select></td>
              <td align=center><a href='aksi.php?module=keranjang&act=hapus&id=$r[no_pr_sementara]'>
              <img src=images/delete.png border=0 title=Hapus></a></td>
          </tr>";
    $no++; 
  } 
  echo "<tr><td colspan=3 align=right><br><b>Total</b>:</td><td colspan=2><br><b>$total_item Item</b></td></tr>
       
		
        </tr>
        </tbody></table><p></p>
		<a href='media.php?module=home' class='button' style='color:white;background:#a2324c;'>Lanjutkan Belanja</a><br/></form><br />
        
        </div>
        
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";
  }

}

// Modul hubungi kami
elseif ($_GET[module]=='hubungikami'){
  echo "
    	  <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
                 <div class='product_img_big'>
                 <img src='foto_banner/shop-open.png' border='0' />
            </div>
          <div class='details_big_box'>
            <div class='product_title_big'>Hubungi Kami Secara Online:</div>
              <div>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form action=hubungi-aksi.html method=POST>
        <tr><td>Nama</td><td> : <input type=text name=nama size=30></td></tr>
        <tr><td>Email</td><td> : <input type=text name=email size=30></td></tr>
        <tr><td>Subjek</td><td> : <input type=text name=subjek size=40></td></tr>
        <tr><td valign=top>sewa</td><td> <textarea name=sewa  style='width: 270px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(masukkan 6 kode di atas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim></td></tr>
        </form></table>
          </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";                              
}

// Modul selesai belanja
elseif ($_GET[module]=='selesaibelanja'){
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM tbl_mintasementara, alat 
			                WHERE id_session='$sid' AND tbl_mintasementara.kd_barang=alat.kd_barang");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
   echo "<script> alert('Daftar Alat Yang Akan Disewa masih kosong');window.location='index.php'</script>\n";
   	 exit(0);
	}
	else{
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<script>alert('Silahkan LOGIN Terlebih Dahulu'); window.location = 'media.php?module=login'</script>";
}
else{
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
      <form name=form2 action=media.php?module=simpantransaksimember method=POST onSubmit=\"return validasi2(this)\">
      <table>
      <tr><td>Email</td><td> : <input type=text name=email size=30></td></tr>
      <tr><td>Password</td><td> : <input type=password name=password size=30></td></tr>
      <tr><td><input type='submit' class='button' value='Login'>&nbsp;&nbsp;&nbsp;</td><td><a href='media.php?module=daftarmember' class='button'>Daftar</a>&nbsp;&nbsp;&nbsp;<a href='media.php?module=lupapassword' class='button'>Lupa Password?</a></td></tr>
      </table>
      </form>
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>"; 
}		     	
  }
  echo" 
  <script>
$(document).ready(function() {
$('.prod_box').addClass('animated bounce');
  });
</script>";
}      
elseif ($_GET[module]=='login'){
echo "<script>window.location = 'login.php'</script>";
 }
// Modul Daftar
elseif ($_GET[module]=='daftarmember'){
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>";
			  
						$notbl_pegawai=mysql_query("select * from tbl_pegawai order by nip DESC LIMIT 0,1");
						$data=mysql_fetch_array($notbl_pegawai);
							$kodeawal=substr($data['nip'],2,3)+1;
							if($kodeawal<10){
								$kode='PA00'.$kodeawal;
								}elseif($kodeawal > 9 && $kodeawal <=99){
								$kode='PA0'.$kodeawal;
								}else{
								$kode='PA'.$kodeawal;
								}
echo "
      <form name=form action=simpantbl_pegawai.php method=POST onSubmit=\"return validasi(this)\">
      <table>
	    <tr><td>&nbsp;</td><td>&nbsp;<input type=hidden name=nip size=30 value='$kode' read-only/></td></tr>
      <tr><td>Nama Lengkap</td><td> : <input type=text name=nama size=30></td></tr>
      <tr><td>Password</td><td> : <input type=password name=password></td></tr>
      <tr><td>Alamat Pengiriman</td><td> : <input type=text name=alamat size=80>
     </td></tr>
      <tr><td>Telpon/HP</td><td> : <input type=text name=nohp></td></tr>
      <tr><td>Email</td><td> : <input type=text name=email size=30></td></tr>
      
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
      <tr><td colspan=2><input type='submit' class='button' value='Daftar'></td></tr>
      </table>
      </form>
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";                      
}


elseif ($_GET[module]=='rekappemesanan'){
 $user= $_SESSION[namauser];
 $password=$_SESSION[passuser];
    echo "
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>";
          

	$sql = mysql_query("SELECT * FROM tbl_pesanh tph, tbl_pegawai p WHERE tph.nip=p.nip AND p.nip='$user'");
 
 


echo "  
          <table border=1 width=620px height=100px cellpadding=3 align=center>
          <tbody>
          <tr bgcolor=#ffffff><th>No. Order</th><th width='120px'>Tanggal Order</th><th>Nama Pemesan</th><th colspan=2 align=center>Tindakan</th></tr>";


  while($r=mysql_fetch_array($sql)){
    
    echo "<tr bgcolor=#ffffff><td>$r[no_order]</td>
              
              <td>$r[tgl_order]</td>
				<td>$r[nama]</td>
				<td align=center><a href='media.php?module=inputpesan&no_order=$r[no_order]'><img src=images/page_add.png border=0 title='Input Pemesanan'></a></td>
				<td align=center><a href='media.php?module=viewpesan&no_order=$r[no_order]'><img src=images/eye.png border=0 title='Lihat Pemesanan'></a></td>
              </tr>";
		  

	
  
  } 
  
  echo "</tbody></table></form><br />
        
        </div>
        
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>
		
	  ";
		  
}

elseif ($_GET[module]=='rekappermintaan'){
 $user= $_SESSION[namauser];
 $password=$_SESSION[passuser];
     echo "
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>";
          

	$sql = mysql_query("SELECT * FROM tbl_permintaan tp, tbl_pegawai p WHERE tp.nip=p.nip AND p.nip='$user'");
 
 


echo "  
          <table border=1 width=620px height=100px cellpadding=3 align=center>
          <tbody>
          <tr bgcolor=#ffffff><th>No. PR</th><th width='120px'>Tanggal Permintaan</th><th>Nama Pegawai</th><th colspan=2 align=center>Tindakan</th></tr>";


  while($r=mysql_fetch_array($sql)){
    
    echo "<tr bgcolor=#ffffff><td>$r[no_pr]</td>
              
              <td>$r[tgl_pr]</td>
				<td>$r[nama]</td>
				<td align=center><a href='media.php?module=listpermintaan&no_pr=$r[no_pr]'><img src=images/eye.png border=0 title='Lihat Permintaan'></a></td>
              </tr>";
		  

	
  
  } 
  
  echo "</tbody></table><br />
        
        </div>
        
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>
		
	  ";
    	                      
}

// Modul Tensip
elseif ($_GET[module]=='inputpesan'){
$no_order=$_GET[no_order];
 $user= $_SESSION[namauser];
 $password=$_SESSION[passuser];
    echo "
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
          <form method=post action=media.php?module=simpanpesan>
		  
		  <table>
		<tr><td>&nbsp;</td><td>&nbsp;<input type=hidden name=no_order value='$no_order'/></td></tr>
      
      <tr><td>Tanggal Kerja</td><td> : <input type=date name=tgl_order />
     </td></tr>
     ";

// Tampilkan alat-alat yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT *FROM tbl_pesand, tbl_barang WHERE tbl_pesand.kd_barang=tbl_barang.kd_barang 
AND tbl_pesand.no_order='$no_order'");
 
 $user= $_SESSION[namauser];
 $password=$_SESSION[passuser];


echo "
		  
		  
          <table border=1 width=620px height=300px cellpadding=3 align=center>
          <tbody>
          <tr bgcolor=#ffffff><th>No</th><th width='120px'>Nama alat</th><th>Tanggal Mulai</th><th>Tanggal Selesai</th>
          <th width='80px'>Total Waktu</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
  
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");

   
	$subtotal    = ($r[harga]-$disc) * $r[totalWaktu]*$r[banyak];
	 
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
	
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    
    echo "<tr bgcolor=#ffffff><td>$no</td>
              <input type=hidden name=id[$no] value=$r[no_pr]>
			  <input type=hidden name=kd_barang[$no] value=$r[kd_barang] style='width:90%;'>
              <td>$r[nama_brg]</td>
				<td><input type=text name=tgl_mulai[$no] style='width:90%;'>
				</br><font size=2><i>Tahun-Bulan-Tanggal</i></font></td>
              <td><input type=text name=tgl_selesai[$no] style='width:90%;'>
			  </br><font size=2><i>Tahun-Bulan-Tanggal</i></font></td>
              <td><input type=text name=subtotal_Waktu[$no] style='width:30%;'>&nbsp;Hari</td>
              
          </tr>";
		  
    $no++; 
	
  
  } 
  
  
  
  echo "<tr><td colspan=6> : <input type=submit name=submit Value=PROSES size=40></td></tr>
        </tbody></table></form><br />
        
        </div>
        
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>
		
	  ";
  

    	                      
}

// Modul Lihat Tensip
elseif ($_GET[module]=='viewtensip'){
$no_pr=$_GET[no_pr];
 $user= $_SESSION[namauser];
 $password=$_SESSION[passuser];
 $sql = mysql_query("SELECT * FROM rekap_pemakaian WHERE no_pr='$no_pr'");

    echo "
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>";
          $t=mysql_fetch_array($sql);
   echo "
		  <table>
		<tr><td><b>ID Sewa</b></td><td> : $no_pr</td></tr>
      
      <tr><td><b>Tanggal Kerja</b></td><td> : $t[tgl_kerja]
     </td></tr><tr><td>&nbsp;
     </td></tr>
     ";

// Tampilkan alat-alat yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT *FROM rekap_pemakaian, alat WHERE rekap_pemakaian.kd_barang=alat.kd_barang 
AND rekap_pemakaian.no_pr='$no_pr'");
 
 $user= $_SESSION[namauser];
 $password=$_SESSION[passuser];


echo "<table cellpadding=10 border=1>
      <tr><th rowspan=2>No</th><th rowspan=2 width=40%>Nama Alat</th><th colspan=2><center>Waktu Kerja</th><th rowspan=2>Jumlah</th></tr>
	  <tr><th>Tanggal Mulai</th><th>Tanggal Selesai</th></tr>"; 
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
  $subtotalwaktu    = $r[subtotal_waktu] ;
   $totalWaktu       = $totalWaktu + $subtotalwaktu;
  
  echo "<tr><td>$no</td><td>$r[nama_brg]</td><td align=center>$r[tgl_mulai]</td><td>$r[tgl_selesai]</td>                             <td align=right>$r[subtotal_waktu] Hari</td></tr>
  ";
  
    
		  
    $no++; 
	
  
  } 
  
  
  
  echo " <tr><td colspan=4 align=right>Total Waktu : </td><td align=right><b>$totalWaktu Hari</b></td></tr></table><br />
        
        </div>
        
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>
		
	  ";

    	                      
}

//simpan tensip
elseif ($_GET[module]=='simpantensip'){

$no_pr=$_POST['no_pr'];
$sql5 = "SELECT * FROM tbl_permintaan sh, tbl_pegawai p WHERE sh.nip=p.nip AND sh.no_pr='$no_pr'";
$hasil5 = mysql_query($sql5);
$tpp = mysql_fetch_array($hasil5);

$id       = $_POST[id];
  $jml_data = count($id);
  $tglmulai   = $_POST['tgl_mulai']; // Waktu mulai
  $tglselesai   = $_POST['tgl_selesai']; // Waktu selesai
  $subtotalwaktu=$_POST['subtotal_Waktu'];
  $noalat=$_POST['kd_barang'];
  $tglkerja=$_POST['tgl_kerja'];
  for ($i=1; $i <= $jml_data; $i++){

      mysql_query("UPDATE rekap_pemakaian SET tgl_kerja='$tglkerja',tgl_mulai = '".$tglmulai[$i]."', tgl_selesai = '".$tglselesai[$i]."',subtotal_waktu = '".$subtotalwaktu[$i]."' WHERE no_pr = '$no_pr' AND kd_barang='".$noalat[$i]."'");
      
	  }
	  
	  echo "<script>window.alert('INPUT TENSIP BERHASIL');
         window.location=('media.php?module=tensipid')</script>";
    	 
}


//tagihan
elseif ($_GET[module]=='listpermintaan'){

$no_pr=$_GET['no_pr'];
$sql5 = "SELECT * FROM tbl_permintaan tp, tbl_pegawai p WHERE tp.nip=p.nip AND tp.no_pr='$no_pr'";
$hasil5 = mysql_query($sql5);
$tpp = mysql_fetch_array($hasil5);
  
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
     
      <table>
      <tr><td>Nama Lengkap   </td><td> : <b>$tpp[nama]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $tpp[alamat] </td></tr>
      <tr><td>Telpon         </td><td> : $tpp[nohp] </td></tr>
      <tr><td>E-mail         </td><td> : $tpp[email] </td></tr></table><hr /><br />
      
      Nomor Order: <b>$no_pr</b><br />";
	  
      $daftaralat=mysql_query("SELECT * FROM tbl_permintaand tpd,tbl_barang tb
                                 WHERE tpd.kd_barang=tb.kd_barang 
                                 AND tpd.no_pr='$no_pr'");

echo "<p></p>
	  <table cellpadding=10 border=1>
      <tr><th>No</th><th>Nama Alat</th><th>Jumlah</th><th>Sub Total</th></tr>";
        
$no=1;
while ($d=mysql_fetch_array($daftaralat)){
   
   $subtotalitem  = $subtotalitem + $d[jumlah];  
   $total_item    = $subtotalitem;
   $grandtotalitem    = $total_item; 

   echo "<tr><td>$no</td><td>$d[nama_brg]</td><td align=center>$d[jumlah]</td><td align=right>$subtotalitem</td></tr>";

   $sewa.="$d[jumlah] $d[nama_brg] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}
 echo "<tr><td colspan=3 align=right>Total : </td><td align=right><b>$total_item</b></td></tr>
          
      <tr><td colspan=3 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotalitem</b></td></tr>
      </table>";
echo "<p></p>
	  <a href='media.php?module=home' class='button' style='color:white;background:#a2324c;'>Kembali Ke Beranda</a></br>";
     // echo "<script>window.alert('TENSIP BERHASIL DIMASUKKAN');
        // window.location=('media.php?module=home')</script>";
		echo "
          </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";  
  
  
}

//Konfimasi pembayaran tagihan
elseif ($_GET[module]=='bayartagihan'){

$no_pr=$_GET['no_pr'];
$sql5 = "SELECT * FROM tbl_permintaan sh, tbl_pegawai p WHERE sh.nip=p.nip AND sh.no_pr='$no_pr'";
$hasil5 = mysql_query($sql5);
$tpp = mysql_fetch_array($hasil5);
  
    	   echo "
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
          <form method=post action=media.php?module=simpantagihan enctype='multipart/form-data'>
		  
		  <table>
      <tr><td>&nbsp;</td><td>&nbsp;<input type=hidden name=no_pr value='$tpp[no_pr]'/></td></tr>
      <tr><td>Tanggal Sewa</td><td> : <input type=text name=tgl_sewa value='$tpp[tgl_sewa]' disabled/>
     </td></tr>
 
      <tr><td>Bukti Bayar</td><td> : <input type=file name=fupload size=40></td></tr>
	  <tr><td>&nbsp;</td><td> : <input type=submit name=submit Value=PROSES size=40></td></tr>
      </table>
	  </form>";
		echo "
          </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";  
  
  
}

//simpan bayartagihan
elseif ($_GET[module]=='simpantagihan'){

$no_pr=$_POST['no_pr'];
$sql5 = "SELECT * FROM tbl_permintaan sh, tbl_pegawai p WHERE sh.nip=p.nip AND sh.no_pr='$no_pr'";
$hasil5 = mysql_query($sql5);
$tpp = mysql_fetch_array($hasil5);

// mendapatkan nomor tbl_pegawai



$id       = $_POST[no_pr];
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

      mysql_query("UPDATE tbl_permintaan SET buktibayar='$nama_file' WHERE no_pr='$id'");
      move_uploaded_file($_FILES['fupload']['tmp_name'], 'admin/modul/mod_tagihan/buktibayar/'.$_FILES['fupload']['name']);
	  
	echo "<script>window.alert('UPLOAD BUKTI BAYAR BERHASIL');
         window.location=('media.php?module=tagihanid')</script>";
    	    
  
  
}

// Modul lupa password
elseif ($_GET[module]=='lupapassword'){

    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
      <form name=form3 action=media.php?module=kirimpassword method=POST>
      <table>
      <tr><td>Masukkan Email Anda</td><td> : <input type=text name=email size=30></td></tr>
      <tr><td colspan=2><input type='submit' class='button' value='Kirim'></td></td></tr>
      </table>
      </form>
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";                      
}


// Modul kirim password
elseif ($_GET[module]=='kirimpassword'){

// Cek email tbl_pegawai di database
$cek_email=mysql_num_rows(mysql_query("SELECT email FROM tbl_pegawai WHERE email='$_POST[email]'"));
// Kalau email tidak ditemukan
if ($cek_email == 0){
  echo "Email <b>$_POST[email]</b> tidak terdaftar di database kami.<br />
        <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
else{

$password_baru = substr(md5(uniqid(rand(),1)),3,10);

// ganti password tbl_pegawai dengan password yang baru (reset password)
$query=mysql_query("update tbl_pegawai set password='$password_baru' where email='$_POST[email]'");

// dapatkan email_pengelola dari database
$sql2 = mysql_query("select email_pengelola from modul where id_modul='43'");
$j2   = mysql_fetch_array($sql2);

$subjek="Password Baru";
$sewa="Password Anda yang baru adalah <b>$password_baru</b>";
// Kirim email dalam format HTML
$dari = "From: $j2[email_pengelola]\r\n";
$dari .= "Content-type: text/html\r\n";

// Kirim password ke email tbl_pegawai
mail($_POST[email],$subjek,$sewa,$dari);

  echo "<div class='center_title_bar'>Kirim Password</div>
    	  <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
                 <div class='product_img_big'>
                 <img src='foto_banner/gedung.jpg' border='0' />
            </div>
          <div class='details_big_box'>
            <div class='product_title_big'>Password Sudah Terkirim</div>
              <div>
              <br />Silahkan cek email Anda.
              </div>
          </div>    
        </div>
            <div class='bottom_prod_box_big'></div>
          </div>";
}                              
}

// Modul simpan transaksi member
elseif ($_GET[module]=='simpantransaksimember'){

$user= $_SESSION[namauser];
$password=$_SESSION[passuser];

$sql = "SELECT * FROM tbl_pegawai WHERE nip='$user'";
$hasil = mysql_query($sql);
$r = mysql_fetch_array($hasil);

// fungsi untuk mendapatkan isi keranjang permintaan
function isi_keranjang(){
	$isikeranjang = array();
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM tbl_mintasementara where id_session='$sid'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$Waktu_skrg = date("H:i:s");

$id = mysql_fetch_array(mysql_query("SELECT nip FROM tbl_pegawai WHERE nip='$user'"));

// mendapatkan nomor pegawai
$nip=$id[nip];


// simpan data sewa 
mysql_query("INSERT INTO tbl_permintaan(tgl_pr, nip) VALUES('$tgl_skrg','$nip')");
$no_pr=mysql_insert_id();
// panggil fungsi isi_keranjang dan hitung jumlah alat yang disewa
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);


// simpan data detail sewa  
for ($i = 0; $i < $jml; $i++)
{
  mysql_query("INSERT INTO tbl_permintaand 
               VALUES('$no_pr',
			   '{$isikeranjang[$i]['kd_barang']}',
				'{$isikeranjang[$i]['banyak']}')");
				}

//pengurangan stok barang
for ($i = 0; $i < $jml; $i++)
{
  mysql_query("UPDATE tbl_barang SET stok=stok -'{$isikeranjang[$i]['banyak']}' WHERE kd_barang='{$isikeranjang[$i]['kd_barang']}' ");
				}
				
// setelah data permintaan tersimpan, hapus data permintaan di tabel sewa sementara (tbl_mintasementara)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM tbl_mintasementara
	  	         WHERE no_pr_sementara = {$isikeranjang[$i]['no_pr_sementara']}");
}

function isi_tensip(){
	$isitensip = array();
	
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM rekap_sementara where id_session='$sid'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isitensip[] = $r;
	}
	return $isitensip;
}
$isitensip = isi_tensip();
$jml2          = count($isitensip);
$tgl_skrg2 = date("Ymd");
for ($i = 0; $i < $jml2; $i++)
{
  mysql_query("INSERT INTO rekap_pemakaian (no_pr, kd_barang, tgl_kerja) 
               VALUES('$no_pr',
			   '{$isitensip[$i]['kd_barang']}','$tgl_skrg2')");
				}
				
// setelah data sewa tersimpan, hapus data sewa di tabel sewa sementara (tbl_mintasementara)
for ($i = 0; $i < $jml2; $i++) {
  mysql_query("DELETE FROM rekap_sementara
	  	         WHERE no_tensip_sementara = {$isitensip[$i]['no_tensip_sementara']}");
}
 $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
 $bln_skrg = $array_bulan[date('n')];
//$bln_skrg = date("m");
$thn_skrg = date ("Y");

    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
     
      <table>
	  <tr><td>No. Permintaan </td><td> : <b>$no_pr / CHC / FPMB / $bln_skrg / $thn_skrg</b> </td></tr>
      <tr><td>Nama Lengkap   </td><td> : <b>$r[nama]</b> </td></tr>
      <tr><td>Jabatan </td><td> :<b> $r[jabatan]</b> </td></tr>
      </table><hr /><br />";

      $daftaralat=mysql_query("SELECT * FROM tbl_permintaand,tbl_barang 
                                 WHERE tbl_permintaand.kd_barang=tbl_barang.kd_barang 
                                 AND no_pr='$no_pr'");

echo "<table cellpadding=10 border=1>
      <tr><th>No</th><th>Nama Alat</th><th>Qty</th><th>Sub Total</th></tr>";
      
$sewa="Terimakasih telah melakukan sewa online di perusahaan kami <br /><br />  
        Nama: $r[nama] <br />
        Alamat: $r[alamat] <br/>
        Telpon: $r[nohp] <br /><hr />
        
        ID Sewa Anda: $no_pr <br />
        Data Alat Yang Anda Sewa adalah sebagai berikut: <br /><br />";
        
$no=1;
while ($d=mysql_fetch_array($daftaralat)){
   $subtotalitem       = $subtotalitem + $d[jumlah];  
    $total_item    = $subtotalitem;

   echo "<tr><td>$no</td><td>$d[nama_brg]</td><td align=center>$d[jumlah]</td>
                             <td align=right>$subtotalitem</td></tr>";

   $sewa.="$d[jumlah] $d[nama_brg] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}

$grandtotalitem    = $total_item;   

// dapatkan email_pengelola dan nomor rekening dari database
$sql2 = mysql_query("select email_pengelola,nomor_rekening,nomor_hp from modul where id_modul='43'");
$j2   = mysql_fetch_array($sql2);

$sewa.="<br /><br />Total : Rp. $total_rp  
         <br />Grand Total : Rp. $grandtotalitem 
         <br /><br />Silahkan lakukan pembayaran sebanyak Grand Total yang tercantum, rekeningnya: $j2[nomor_rekening]
         <br />Apabila sudah transfer, konfirmasi ke nomor: $j2[nomor_hp]";

$subjek="sewa Online";

// Kirim email dalam format HTML
$dari = "From: $j2[email_pengelola]\r\n";
$dari .= "Content-type: text/html\r\n";

// Kirim email ke tbl_pegawai
mail($email,$subjek,$sewa,$dari);

// Kirim email ke pengelola 
mail("$j2[email_pengelola]",$subjek,$sewa,$dari);

echo "<tr><td colspan=3 align=right>Total : </td><td align=right><b>$total_item</b></td></tr>     
      <tr><td colspan=3 align=right>Grand Total : </td><td align=right><b>$grandtotalitem</b></td></tr>
      </table>";
echo "<hr /><table>
<tr><td>&nbsp;</td><td width=200px>&nbsp;</td>
<td>Cilegon, ...........</td>
</tr>
<tr><td>Yang Menerima, </td><td width=200px>&nbsp;</td>
<td>Yang Menyerahkan, </td>
</tr>
<tr><td>Bag. Produksi&nbsp;&nbsp;&nbsp;</td>
<td width=200px>&nbsp;</td>
<td>Bag. Gudang&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr height=200px><td>(_________________)</td>
<td width=200px>&nbsp;</td>
<td>(_________________)</td>
</tr>
</table>
<a href='media.php?module=home' class='button' style='color:white;background:#a2324c;'>Kembali Ke Beranda</a></br>
                    
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>";  
}                    
?>
