<?php 
include 'config/koneksi.php';
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="navbar.css" rel="stylesheet" type="text/css" />
 <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/vertikalmenu.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

<link href="lightbox/themes/default/jquery.lightbox.css" rel="stylesheet" type="text/css" />
<table class="data" border="1" width="620px" style="text-align:centre;padding-left:10px;">
	<tr>
		<th style="background:#a2324c;color:#ffffff;">Nama Barang</th>
		<th width="50px" style="background:#a2324c;color:#ffffff;">Banyak</th>
	</tr>
	<?php 
	$data = mysql_query("select nama_barang, banyak from tbl_pesansementara");
	while($d=mysql_fetch_array($data)){
	?>
	<tr>
		<td style="text-align:centre;"><?php echo $d['nama_barang'] ?></td>
		<td style="text-align:centre;"><?php echo $d['banyak'] ?></td>
	</tr>
	<?php } ?>
</table>