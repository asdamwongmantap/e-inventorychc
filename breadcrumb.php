<?php
if($_GET['module']=='home'){
	echo "<span class='current'>Halaman Utama</span>";
}
elseif($_GET['module']=='detailalat'){
	echo "<span class='current'>Rincian Barang</span>";
}
elseif($_GET['module']=='profilkami'){
	echo "<span class='current'>Tentang Kami</span>";
}
elseif($_GET['module']=='caraminta'){
	echo "<span class='current'>Cara Permintaan barang</span>";
}
elseif($_GET['module']=='semuaalat'){
	echo "<span class='current'>Daftar Semua Barang</span>";
}
elseif($_GET['module']=='keranjang'){
	echo "<span class='current'>Form Permintaan Barang</span>";
}
elseif($_GET['module']=='hubungikami'){
	echo "<span class='current'>Hubungi Kami</span>";
}
elseif($_GET['module']=='login'){
	echo "<span class='current'>Halaman Login</span>";
}
elseif($_GET['module']=='selesaibelanja'){
	echo "<span class='current'>Halaman Selesai Belanja</span>";
}
elseif($_GET['module']=='daftarmember'){
	echo "<span class='current'>Pendaftaran Anggota</span>";
}
elseif($_GET['module']=='simpantransaksimember'){
	echo "<span class='current'>Halaman Proses Transaksi</span>";
}
elseif($_GET['module']=='rekappermintaan'){
	echo "<span class='current'>Daftar Permintaan Barang</span>";
}
elseif($_GET['module']=='rekappemesanan'){
	echo "<span class='current'>Daftar Pemesanan</span>";
}
elseif($_GET['module']=='tensip'){
	echo "<span class='current'>Tensip Peminjaman</span>";
}
elseif($_GET['module']=='viewtensip'){
	echo "<span class='current'>Rincian Tensip</span>";
}
elseif($_GET['module']=='lupapassword'){
	echo "<span class='current'>Lupa Password</span>";
}
elseif($_GET['module']=='simpantransaksiorder'){
	echo "<span class='current'>Penyimpanan Tensip</span>";
}
elseif($_GET['module']=='tagihan'){
	echo "<span class='current'>Tagihan</span>";
}
elseif($_GET['module']=='bayartagihan'){
	echo "<span class='current'>Konfirmasi Pembayaran Tagihan</span>";
}
elseif($_GET['module']=='simpantagihan'){
	echo "<span class='current'>Penyimpanan Tagihan</span>";
}
elseif($_GET['module']=='tambahorder'){
	echo "<span class='current'>Form Pemesanan Barang</span>";
}

?>
