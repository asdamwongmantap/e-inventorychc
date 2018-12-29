<?php
	$sid = session_id();
	$sql = mysql_query("SELECT SUM(jumlah*(harga)) as total,SUM(jumlah) as totaljumlah FROM keranjangbelanja, buah 
			                WHERE id_session='$sid' AND keranjangbelanja.id_buah=buah.id_buah");
	
    //$disc        = ($r[diskon]/100)*$r[harga];
    //$subtotal    = ($r[harga]-$disc) * $r[jumlah];
		                
	while($r=mysql_fetch_array($sql)){

  if ($r['totaljumlah'] != ""){
    $total_rp    = format_rupiah($r['total']);

    echo "($r[totaljumlah]) Buah<br />
          <span class='border_cart'></span>
          Total: <span class='price'>Rp. $total_rp</span><br />
          <i><a href='media.php?module=keranjang'>Keranjang</a></i> | <i><a href='selesai-belanja.html'>Selesai</a></i><br />";
  }
  else{
    echo "0 Buah<br />
          <span class='border_cart'></span>
          Total: <span class='price'>Rp. 0</span>";
  }
  }
?>

