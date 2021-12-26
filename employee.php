<?php 
session_start();
require "connect.php";
require "models/employees.php";
require "models/producttypes.php";
$type = ProductTypes::getAll($db);
$employee = Employees::getAll($db);
// guard
$role = "NONE";
if (isset($_SESSION['employee']) && !empty($_SESSION['employee']))
{
  $auth = $_SESSION['employee'];
  $role = $auth->ROLE;
}
if ($role != "Administrator") return header("location:login.php");
?>

<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->


<!-- Mirrored from html.lionode.com/healthcare/hc001/listproducts.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Nov 2021 01:47:02 GMT -->
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
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
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
          <div id="category-menu" class="navbar collapse in  mb_40" aria-expanded="true" role="button">
            <div class="nav-responsive">
              <ul class="nav  main-navigation collapse in ">  <?php 
                    foreach ($type as $t){ 
                      echo "<li><a href='listproducts.php?id=".$t ["ID_TYPE"]."'>".$t["TYPE"]."</a></li>";
                    }
                    ?> </ul>
            </div>
          </div>
          <div class="left_banner left-sidebar-widget mt_30 mb_50"> <a href="#"><img src="images/leftt 1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
          <div class="left-cms left-sidebar-widget mb_50">
        </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="breadcrumb ptb_20">
            <h1>Kelola Pegawai</h1>
            <ul>
              <li><a href="index.php">Halaman Utama</a></li>
              <li class="active">Kelola Pegawai</li>
            </ul>
          </div>
          <!-- =====  BREADCRUMB END===== -->
        <a href = 'addemployee.php' class = 'btn'> Tambah Pegawai </a> <br></br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Nama Lengkap</th>
                      <th>Role</th>
                      <th>Waktu dibuat</th>
                      <th>Waktu diperbarui</th>
                      <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                 $nomor=1;
                ?>

            <?php foreach ($employee as $key) {
            echo "<tr>";
            echo "<td>".$nomor++."</td>";
            echo "<td>@".$key["USERNAME"]."</td>";
            echo "<td>". $key["NAME"]."</td>";
            echo "<td>". $key["ROLE"]."</td>";
            echo "<td>". formatTS($key["CREATED_AT"]). "</td>";
            echo "<td>". formatTS($key["UPDATED_AT"]). "</td>";
            echo "<td><a href = 'editemployees.php?id=". $key["ID_EMPLOYEE"]. "' > <i class = 'fa fa-pencil'> </i> </a> ".($role == "Administrator" && $key["ID_EMPLOYEE"] == $auth->ID_EMPLOYEE? "" : "<a href = 'deleteemployees.php?id=". $key["ID_EMPLOYEE"]. "' > <i class = 'fa fa-trash'> </i> </a>"). "</td>";
            echo "</tr>";
            }?> 

                </tbody>
            </table>
         </div>
      </div>
    </div>
    <!-- =====  CONTAINER END  ===== -->
    <!-- =====  FOOTER START  ===== -->
    <div class="footer pt_30">
      <div class="container">
        <div class="row">
          <div class="col-md-12 footer-block">
            <center><div class="footer-contact">
              <div class="footer-logo mb_40"> <a href="index.php"> <img src="images/logokami3.png" alt="HealthCare"> </a> </div>
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
  </div>
  <a id="scrollup">Scroll</a>
  <script src="js/jQuery_v3.1.1.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.magnific-popup.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
  $(function() {
    $("#slider-range").slider({
      range: true,
      min: 0,
      max: 500,
      values: [75, 300],
      slide: function(event, ui) {
        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
      }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
      " - $" + $("#slider-range").slider("values", 1));
  });
  </script>
  <script src="js/jQuery_v3.1.1.min.js"></script>
  <script src="DataTables/datatables.js"></script>
  <script type="text/javascript">

      var save_method; //for save method string
      var table;

      $(document).ready(function() {
          //datatables
          table = $('#table').DataTable({ 
              "processing": true, //Feature control the processing indicator.
              "serverSide": true, //Feature control DataTables' server-side processing mode.
              "order": [], //Initial no order.
          });

      });
  </script>
</body>


<!-- Mirrored from html.lionode.com/healthcare/hc001/listproducts.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Nov 2021 01:47:03 GMT -->
</html>