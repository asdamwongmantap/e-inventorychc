<?php
    // diskon  
    $harga     = format_rupiah($r[harga]);
    $disc      = ($r[diskon]/100)*$r[harga];
    $hargadisc = number_format(($r[harga]-$disc),0,",",".");

    $d=$r['diskon'];
	$stok= $r['stok'];
    // $hargatetap  = "
                    // <span style=\"color:#ffffff;font-size:14px;padding-left:10px;font-family:verdana;\"> Rp. <b>$hargadisc,-</b></span>";
    // $hargadiskon = " 
                    // <span style=\"color:#ffffff;font-size:14px;padding-left:10px;font-family:verdana;\"> Rp. <b>$hargadisc,-</b></span>";
	$stokbarang  = "
                    <span style=\"color:#ffffff;font-size:14px;padding-left:10px;font-family:verdana;\"> Available <b>$stok</b> Item</span>";
    if ($stok!=0){
      $divharga=$stokbarang;
    }else{
      $divharga=0;
    } 

    // tombol stok habis kalau stoknya 0
    $stok        = $r['stok'];
    $tombolbeli  = "<a style='background:#a2324c;COLOR:white;text-align:center;' href=\"aksi.php?module=keranjang&act=tambah&id=$r[kd_barang]\" class='button'>Minta</a>";
    $tombolhabis = "<span style='COLOR:black;text-align:center;text-transform:uppercase;'><a class='button'>Habis</a></span>";
    if ($stok!=0){
      $tombol=$tombolbeli;
    }else{
      $tombol=$tombolhabis;
    } 
?>
