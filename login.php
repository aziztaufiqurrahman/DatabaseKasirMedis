<?php
if ($_GET["status"] == "gagal"){
  echo"<script>alert('Login gagalllllllll!!!, harap periksa kembali username atau password anda!!')</script>";
}
?>

<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from html.lionode.com/healthcare/hc001/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Nov 2021 01:46:54 GMT -->
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
</head>

<body>
  <!-- =====  LODER  ===== -->
  <div class="loder"></div>
  <div class="wrapper">
    <!-- =====  HEADER START  ===== -->
    <header id="header">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <ul class="header-top-left">
                <li class="language dropdown"> <span class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"> <img src="images/Indonesia.gif" alt="img"> Indonesia <span class="caret"></span> </span>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#"><img src="images/Indonesia.gif" alt="img"> Indonesia</a></li>
                  </ul>
              </ul>
            </div>
            <div class="col-sm-6">
              <ul class="header-top-right text-right">
                <li class="account"><a href="login.html">Masuk</a></li>
                <li class="sitemap"><a href="https://goo.gl/maps/t1pZEah8czZkTvxx6" target="_blank">Kampus Kita</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="header">
        <div class="container">
          <nav class="navbar">
            <div class="navbar-header mtb_20"> <a class="navbar-brand" href="index.html"> <img alt="HealthCared" src="images/logokami3.png"> </a> </div>
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
                <li> <a href="index.html">Halaman Utama</a></li>
                <li> <a href="category_page.html">Daftar Produk</a></li>
                <li> <a href="checkout_page.html">Riwayat Transaksi</a></li>
                <li> <a href="calculator.html">Transaksi</a></li>
                <li> <a href="employee.html">Kelola Pegawai</a></li>
                <li> <a href="about-us.html">Tentang Kami</a></li>
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
              <div id="category-menu-responsive" class="navbar collapse " aria-expanded="true"  role="button">
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
        <div id="column-left" class="col-sm-4 col-md-4 col-lg-3 hidden-xs">
          <div id="category-menu" class="navbar collapse in  mb_40" aria-expanded="true" role="button">
            <div class="nav-responsive">
              <ul class="nav  main-navigation collapse in ">
                <li><a href="#">Anti Inflamasi</a></li>
                <li><a href="#">Anti Septik</a></li>
                <li><a href="#">Vitamin</a></li>
                <li><a href="#">Alat Kesehatan</a></li>
                <li><a href="#">Masker</a></li>
                <li><a href="#">P3K</a></li>
              </ul>
            </div>
          </div>
          <div class="left_banner left-sidebar-widget mt_30 mb_50"> <a href="#"><img src="images/leftt 1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- contact  -->
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="panel-login">
                <div class="panel-heading">
                  <div class="row mb_20">
                    <div class="col-xs-12">
                      <center> <a href="#" class="active" id="login-form-link">Login</a> </center>
                    </div>

                  </div>
                  <hr>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form id="login-form" action="performlogin.php" method="post">
                        <div class="form-group">
                          <input type="text" name="username" id="username1" tabindex="1" class="form-control" placeholder="Username" value="">
                        </div>
                        <div class="form-group">
                          <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group text-center">
                          <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                          <label for="remember"> Remember Me</label>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                              <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Single Blog  -->
  <!-- End Blog   -->
  <!-- =====  CONTAINER END  ===== -->
  <!-- =====  FOOTER START  ===== -->
  <div class="footer pt_30">
    <div class="container">
      <div class="row">
        <div class="col-md-12 footer-block">
          <center><div class="footer-contact">
            <div class="footer-logo mb_40"> <a href="index.html"> <img src="images/logokami3.png" alt="HealthCare"> </a> </div>
            <ul>
              <li>KELOMPOK A4 <br/> D4 TEKNIK INFORMATIKA</li>
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
  </div>
  <!-- =====  FOOTER END  ===== -->
  <a id="scrollup">Scroll</a>
  <script src="js/jQuery_v3.1.1.min.js"></>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.magnific-popup.js"></script>
  <script src="js/custom.js"></script>


<!-- Mirrored from html.lionode.com/healthcare/hc001/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Nov 2021 01:46:54 GMT -->
</html>