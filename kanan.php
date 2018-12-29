<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
echo '
<div id="menu6"> 
<ul> 
<li><a href="media.php?module=home">Beranda</a></li> 
<li><a href="media.php?module=profilkami">Tentang Kami</a></li> 
<li><a href="media.php?module=semuaalat">Semua Alat</a></li> 
<li><a href="media.php?module=carasewa">Cara Penyewaan</a></li> 
</ul> 
</div>';
}
else
  {
	echo '
<div id="menu6"> 
<ul> 
<li><a href="media.php?module=home">Beranda</a></li> 
<li><a href="media.php?module=profilkami">Tentang Kami</a></li> 
<li><a href="media.php?module=semuaalat">Semua Alat</a></li> 
<li><a href="media.php?module=carasewa">Cara Penyewaan</a></li> 
<li><a href="media.php?module=tagihanid">Invoice</a></li> 
<li><a href="media.php?module=tensipid">Tensip Peminjaman</a></li> 
</ul> 
</div>';
  }