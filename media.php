<?php 
  error_reporting(0);
  session_start();	
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  $user="Pengunjung";
  }
  else
  {
	$user="$_SESSION[namalengkap]";  
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Cigading Habeam Centre</title>
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="situsinventory">
	<meta name="keyword" content="TA">
    <meta name="author" content="Uzy">

<link rel="shortcut icon" href="images/logochclg.png" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="" />

<link href="style.css" rel="stylesheet" type="text/css" />
<link href="navbar.css" rel="stylesheet" type="text/css" />
 <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/vertikalmenu.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

<link href="lightbox/themes/default/jquery.lightbox.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>


<!--[if lte IE 7]>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<![endif]-->
</head>

<body style="background:url(images/bg.jpg);">
<div id="main_container" style="background:#ffffff;margin-top:20px;margin-bottom:20px;height:100%;">

	<div id="header"></div>
<!--<span class="borderheader"></span>-->

 <nav id='menu' style="background:#a2324c;">
<input type='checkbox'/>
<label>&#8801;<span>Navigation</span></label>

<ul>
<?php
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
echo '
<li><a href="media.php?module=home">Beranda</a></li> 
<li><a href="media.php?module=semuaalat">Daftar barang</a></li> 
<li><a href="media.php?module=caraminta">Cara Permintaan Barang</a></li>';

}
else
  {
	  $user=$_SESSION['namauser'];
$identitas=mysql_query("SELECT * FROM tbl_pegawai WHERE nip='".$user."'");
$s=mysql_fetch_array($identitas);
if (($s['jabatan']=='Bag. Gudang')){echo '
	<li><a href="media.php?module=home">Beranda</a></li> 
<li><a href="media.php?module=profilkami">Profil</a></li> 
<li><a href="media.php?module=semuaalat">Daftar Barang</a></li> 
<li><a href="media.php?module=tambahorder">Pesan Barang</a></li> 
<li><a href="media.php?module=rekappesanan">Rekap Pesanan barang</a></li>';}
else{
	echo '
	<li><a href="media.php?module=home">Beranda</a></li> 
<li><a href="media.php?module=profilkami">Profil</a></li> 
<li><a href="media.php?module=semuaalat">Daftar Barang</a></li> 
<li><a href="media.php?module=rekappermintaan">Rekap Permintaan barang</a></li> ';
}
  }
?>
<div style="padding-top:px;float:right;font-weight:bold;padding-right:20px;text-transform:uppercase;">

<?php
               if (!empty($_SESSION['namauser']) AND !empty($_SESSION['passuser'])){
				?>
                
                  <a href="logout.php" style="color:white;">
                    Logout
                  </a>
               
                <?php
			    }
			    
                if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
				?>  
               
                  <a href="login.php" style="color:white;">
                    Log in
                  </a>
                
                <?php
				}
				?></div>
</ul>
</nav>

 
    
  <div id="main_content"> 
      <div class="crumb_navigation">
    Anda sedang berada di: <?php include "breadcrumb.php";?>
  </div>     
 

 <!--<div class="left_content"> 
        
	  <?php include "kanan.php";?>
  </div>  -->
        
   
   <div class="center_content" style="width:750px;">
      <?php include "tengah.php";?>           
   </div>
   
    
            
   </div><!-- end of main content -->
   
   <div class="footer" style="background:#a2324c;">        
        <div class="left_footer" style="text-align:center;"><center>
        JL.K.H.Hasyim Ashari No.2 Jakarta 10130 Indonesia<br>
		Phone / fax : (+6221) 634 3933 , 634 3405 / 633 8438
        </div>
   </div>                 

</div>
<!-- end of main_container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	
	 

</body>
</html>
