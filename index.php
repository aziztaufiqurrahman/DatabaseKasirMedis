<?php
session_start();
require "connect.php";
require "models/customers.php";
require "models/orders.php";
require "models/products.php";
require "models/producttypes.php";
$type = ProductTypes::getAll($db);
$totalcustomers = Customers::count($db);
$totalorders = Orders::count($db);
$totalincome = Orders::getIncomeForThisMonth($db);
$totalproducts = Products::count($db);
// guard
$role = "NONE";
if (isset($_SESSION['employee']) && !empty($_SESSION['employee']))
{
  $auth = $_SESSION['employee'];
  $role = $auth->ROLE;
}
?>
<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->


<!-- Mirrored from html.lionode.com/healthcare/hc001/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Nov 2021 01:44:16 GMT -->
<head>
  <!-- =====  BASIC PAGE NEEDS  ===== -->
  <meta charset="utf-8">
  <title>APOTEKita Sehat</title>
  <!-- =====  SEO MATE  ===== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="distribution" content="global">
  <meta name="revisit-after" content="2 Days">
  <meta name="robots" content="ALL">
  <meta name="rating" content="8 YEARS">
  <meta name="Language" content="en-us">
  <meta name="GOOGLEBOT" content="NOARCHIVE">
  <!-- =====  MOBILE SPECIFICATION  ===== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="viewport" content="width=device-width">
  <!-- =====  CSS  ===== -->
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
  <link rel="shortcut icon" href="images/favicon.png">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.html">
  <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.html">
  <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.html">
  <link href="DataTables/datatables.css" rel="stylesheet">
</head>

<body>
  <!-- =====  LODER  ===== -->
  <div class="loder"></div>
  <div class="wrapper">
    <div id="subscribe-me" class="modal animated fade in" role="dialog" data-keyboard="true" tabindex="-1">
      <div class="newsletter-popup">
        <img class="offer" src="images/heii.jpg" alt="offer">
        <div class="newsletter-popup-static newsletter-popup-top">
          <div class="popup-text">
            <div class="popup-title">Hallo<span><br/>SEMOGA SELALU SEHAT</div>
            <div class="popup-desc">
              <div>Selamat Datang. <br/> Selamat Bekerja. <br/> Kerja keras. <br/> Kerja ikhlas. <br/> Kerja cerdas.<br/><br/>
              -Kelompok 4-
              </div>
            </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- =====  HEADER START  ===== -->
    <header id="header">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <ul class="header-top-left">
                <?php
                if ($role != "NONE") echo $role.", <b>".$auth->NAME."</b> (@".$auth->USERNAME.")";
                ?>
              </ul>
            </div>
            <div class="col-sm-6">
              <ul class="header-top-right text-right">
                <li class="account">
                  <?php 
                  if (!empty($_SESSION['employee'])){
                    echo'<a href="logout.php">Keluar</a>';
                  }else{
                    echo'<a href="login.php">Masuk</a>';
                  }
                  ?>
                </li>
                <li class="sitemap"><a href="https://goo.gl/maps/t1pZEah8czZkTvxx6" target="_blank">Kampus Kita</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="header">
        <div class="container">
          <nav class="navbar">
            <div class="navbar-header mtb_20"> <a class="navbar-brand" href="index.php"> <img alt="HealthCared" src="images/logokami3.png"> </a> </div>
            <div class="header-right pull-right mtb_50">
              <button class="navbar-toggle pull-left" type="button" data-toggle="collapse" data-target=".js-navbar-collapse"> <span class="i-bar"><i class="fa fa-bars"></i></span></button>
              <div class="main-search pull-right">
                <div class="search-overlay">
                  <!-- Close Icon -->
                  <a href="javascript:void(0)" class="search-overlay-close"></a>
                  <!-- End Close Icon -->
                  <div class="container">
                    <!-- Search Form -->
                    <form role="search" id="searchform" action="http://html.lionode.com/search" method="get">
                      <label class="h5 normal search-input-label">Enter keywords To Search Entire Store</label>
                      <input value="" name="q" placeholder="Search here..." type="search">
                      <button type="submit"></button>
                    </form>
                    <!-- End Search Form -->
                  </div>
                </div>
              </div>
            </div>
            <div class="collapse navbar-collapse js-navbar-collapse pull-right">
              <ul id="menu" class="nav navbar-nav">
              <?php
                echo "<li><a href='index.php'>Utama</a></li>";
                if ($role == "Cashier")
                {
                  echo "<li><a href='listproducts.php'>Daftar Produk</a></li>";
                  echo "<li><a href='orders.php'>Transaksi</a></li>";
                  echo "<li><a href='myorders.php'>Riwayat Transaksi</a></li>";
                }
                else if ($role == "Manager")
                {
                  echo "<li><a href='listproducts.php'>Daftar Produk</a></li>";
                }
                else if ($role == "Administrator")
                {
                  echo "<li><a href='listproducts.php'>Daftar Produk</a></li>";
                  echo "<li><a href='orders.php'>Transaksi</a></li>";
                  echo "<li><a href='histories.php'>Riwayat Transaksi</a></li>";
                  echo "<li><a href='employee.php'>Kelola Pegawai</a></li>";
                }
                if ($role != "NONE") echo "<li><a href='accounts.php'>Profil</a></li>";
                echo "<li><a href='about-us.php'>Tentang Kami</a></li>";
              ?>
              </ul>
            </div>
            <!-- /.nav-collapse -->
          </nav>
        </div>
      </div>
      <div class="header-bottom">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-3">
              <div class="category">
                <div class="menu-bar" data-target="#category-menu,#category-menu-responsive" data-toggle="collapse" aria-expanded="true" role="button">
                  <h4 class="category_text">Daftar Produk</h4>
                  <span class="i-bar"><i class="fa fa-bars"></i></span></div>
              </div>
              <div id="category-menu-responsive" class="navbar collapse " aria-expanded="true" role="button">
                <div class="nav-responsive">
                  <ul class="nav  main-navigation collapse in">
                    <li><a href="#">Anti Inflamasi</a></li>
                    <li><a href="#">Anti Septik</a></li>
                    <li><a href="#">Vitamin</a></li>
                    <li><a href="#">Alat Kesehatan</a></li>
                    <li><a href="#">Masker</a></li>
                    <li><a href="#">P3K</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-9">
              <div class="header-bottom-right offers">
              	<div class="marquee"><span><i class="fa fa-circle" aria-hidden="true"></i>Kesehatan Pelanggan Adalah Prioritas Kami</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>SELAMAT DATANG di APOTEKita SEHAT</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>Apotek Kesayangan Anda</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>Kami Siap Membantu</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- =====  HEADER END  ===== -->
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
        <div id="column-left" class="col-sm-4 col-md-4 col-lg-3 ">
          <div id="category-menu" class="navbar collapse mb_40 hidden-sm-down in" aria-expanded="true" role="button">
            <div class="nav-responsive">
              <ul class="nav  main-navigation collapse in ">  <?php 
                    foreach ($type as $t){ 
                      echo "<li><a href='listproducts.php?id=".$t ["ID_TYPE"]."'>".$t["TYPE"]."</a></li>";
                    }
                    ?> </ul>
              </ul>
            </div>
          </div>
          <div class="left_banner left-sidebar-widget mt_30 mb_50"> <a href="#"><img src="images/leftt 1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
          <div class="left-cms left-sidebar-widget mb_50">
            
          </div>
          <div class="left-special left-sidebar-widget mb_50">
           
          </div>
          
        </div>
        <div id="column-right" class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="banner">
            <div class="main-banner owl-carousel">
              <div class="item"><a href="#"><img src="images/banner utama.png" alt="Main Banner" class="img-responsive" /></a></div>
            </div>
          </div>
          <!-- =====  BANNER END  ===== -->
          <!-- =====  SUB BANNER  STRAT ===== -->
         <div class="row">
            <div class="col-md-12">
              <div class="heading-part mb_20 mt_40 ">
                <h2 class="main_title">Informasi Pendataan</h2>
              </div>
              <div id="p_line">
                <div class="row">
                  <div class="col-md-12 no-padding">
                    <div class="col-md-3">
                      <div class="panel panel-default pull-left">
                        <div class="panel-body">
                          <b>Pendapatan Bulan Ini</b>
                          <p style="padding-top: 10px;">
                          <h4><?php echo "Rp. ".number_format($totalincome, 2, ",", "."); ?></h2>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default pull-left">
                        <div class="panel-body">
                          <b>Jumlah Transaksi</b>
                          <p style="padding-top: 10px;">
                          <h4><?php echo $totalorders; ?> Transaksi</h2>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default pull-left">
                        <div class="panel-body">
                          <b>Jumlah Produk</b>
                          <p style="padding-top: 10px;">
                          <h4><?php echo $totalproducts; ?> Produk</h2>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="panel panel-default pull-left">
                        <div class="panel-body">
                          <b>Jumlah Pelanggan</b>
                          <p style="padding-top: 10px;">
                          <h4><?php echo $totalcustomers; ?> Orang</h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <!-- =====  SUB BANNER END  ===== -->
          <!-- =====  product end  ===== -->
          <!-- =====  Blog ===== -->
          <div id="Blog" class="mt_40">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Website Kesehatan</h2>
            </div>
            <div class="blog-contain box">
              <div class="blog owl-carousel ">
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="https://www.alodokter.com/" target="_blank"> <img src="images/alodokter.jfif" alt="HealthCare"> </a> </div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="https://www.alodokter.com/" target="_blank">ALODOKTER</a> </h6>
                      <p>Platform Kesehatan Tepercaya No.1 Di Indonesia Alodokter adalah perusahaan kesehatan digital nomor satu di Indonesia dengan lebih dari 26 juta pengguna aktif setiap bulannya</p>
                      
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="https://www.halodoc.com/" target="_blank"> <img src="images/halodoc2.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="https://www.halodoc.com/" target="_blank">HALODOC</a> </h6>
                      <p>Sebuah aplikasi platform komunikasi yang memfasilitasi interaksi antara dokter dengan pengguna memberikan kemudahan bagi masyarakat untuk menemui dokter mereka kapan saja
                      </p>
                
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="https://www.klikdokter.com/" target="_blank"> <img src="images/klikdokter2.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="https://www.klikdokter.com/" target="_blank">KLIK DOKTER</a> </h6>
                      <p>Butuh informasi kesehatan yang akurat? chat bersama dokter bisa menjadi solusinya! Chat dokter seputar penyakit yang diderita untuk penanganan yang cepat dan tepat. Ibu dan Anak.
                      </p>
                      
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="https://www.sehatq.com/" target="_blank"> <img src="images/sehatq2.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="https://www.sehatq.com/" target="_blank">SEHAT Q</a> </h6>
                      <p>SehatQ merupakan aplikasi yang menyediakan layanan chat dokter, booking dokter, layanan kesehatan, toko vitamin dan obat online, dan menyajikan beragam informasi seputar kesehatan.</p>
                      
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
            <!-- =====  Blog end ===== -->
          </div>
        </div>
      </div>
    </div>
    <!-- =====  CONTAINER END  ===== -->
    <!-- =====  FOOTER START  ===== -->
  </div>
    <div class="footer pt_30">
      <div class="container">
        <div class="row">
          <div class="col-md-12 footer-block">
            <center><div class="footer-contact">
              <div class="footer-logo mb_40"> <a href="index.php"> <img src="images/logokami3.png" alt="HealthCare"> </a> </div>
              <ul>
                <li>Kelompok A5 <br/> D4 TEKNIK INFORMATIKA</li>
                <li><b>MOTTO KELOMPOK : <br/>KERJA SAMA, SALING MELENGKAPI, MEMBERIKAN YANG TERBAIK</b> </li>
              </ul>
            </div>
          </div></center>
        </div>
      </div>
      <div class="footer-bottom mt_60 ptb_10">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
             <center><div class="copyright-part">SISTEM BASIS DATA</div></center> 
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- =====  FOOTER END  ===== -->
  </div>
  <a id="scrollup">Scroll</a>
  <script src="js/jQuery_v3.1.1.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.magnific-popup.js"></script>
  <script src="js/jquery.firstVisitPopup.js"></script>
  <script src="js/custom.js"></script>
</body>


<!-- Mirrored from html.lionode.com/healthcare/hc001/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Nov 2021 01:46:19 GMT -->
</html>