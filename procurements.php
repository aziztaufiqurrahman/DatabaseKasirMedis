<?php
session_start();
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
  <link rel="stylesheet" type="text/css" href="css/select2.min.css"> 
  <link rel="stylesheet" type="text/css" href="css/custom.css"> 
  <link rel="stylesheet" type="text/css" href="css/web.css"> 
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
    <form method="post" action="events/performaddstock.php"> 
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
            </div>
            <div class="collapse navbar-collapse js-navbar-collapse pull-right">
              <ul id="menu" class="nav navbar-nav">
                <li> <a href="index.php">Halaman Utama</a></li>
                <li> <a href="listproducts.php">Daftar Produk</a></li>
                <li> <a href="checkout_page.php">Riwayat Transaksi</a></li>
                <li> <a href="orders.php">Transaksi</a></li>
                <li> <a href="employee.php">Kelola Pegawai</a></li>
                <li> <a href="about-us.php">Tentang Kami</a></li>
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
          <div class="left-cms left-sidebar-widget mb_50">
            <ul>
              <li>
                <div class="feature-i-left ptb_40">
                  <div class="icon-right Shipping"></div>
                  <h6>Free Shipping</h6>
                  <p>Siap Melayani Anda</p>
                </div>
              </li>
              <li>
                <div class="feature-i-left ptb_40">
                  <div class="icon-right Order"></div>
                  <h6>Order Online</h6>
                  <p>Mudah Bertransaksi di Toko Kami</p>
                </div>
              </li>
              <li>

              </li>
              <li>
                <div class="feature-i-left ptb_40">
                  <div class="icon-right Safe"></div>
                  <h6>Safe Shoping</h6>
                  <p>Memberikan Pelayanan Terbaik</p>
                </div>
              </li>
            </ul>
          </div>
         
          <!-- <div class="left_banner left-sidebar-widget mb_50"> <a href="#"><img src="images/left2.jpg" alt="Left Banner" class="img-responsive" /></a> </div> -->
          
        </div>
        <div id="column-right" class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="breadcrumb ptb_20">
            <h1>Transaksi Penambahan Stok</h1>
            <ul>
              <li><a href="index-2.html">Halaman Utama</a></li>
              <li class="active">Transaksi Penambahan Stok</li>
            </ul>
          </div>
          <!-- =====  BREADCRUMB END===== -->
            <div class="table-responsive">
              <table class="table table-bordered" id="cs-ordertb">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 5%;">No.</th>
                    <!-- <th class="text-center" style="width: 15%;">Gambar</th> -->
                    <th class="text-center" style="width: 20%;">Nama Produk</th>
                    <th class="text-center" style="width: 25%;">Kadaluwarsa</th>
                    <th class="text-center" style="width: 15%;">Stok</th>
                    <th class="text-center" style="width: 20%;">Penambahan</th>
                    <th class="text-center" style="width: 20%;">Subtotal</th>
                    <th class="text-center" style="width: 10%;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td class="text-center"></td>
                    <td class="text-left"><input type="hidden" name="id_product[]" id="id_product[]" value="0">product 11</td>
                    <td class="text-center">
                      <input type="number" class="cs-inputcount" name="count[]" id="count[]" value="1" min="1" max="100">
                    </td>
                    <td class="text-right">Rp. 100.000,00</td>
                    <td class="text-right" id="subtotal">Rp. 100.000,00</td>
                    <td class="text-center"><a href="#" class="cs-btndelete">Hapus</a></td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          <div class="panel panel-default pull-left">
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 no-padding mt-10">
                        <div class="col-md-4"><label for="ctx_product">Nama Produk</label></div>
                        <div class="col-md-8">
                          <select id='ctx_product' name="ctx_product" style='width: 100%;'></select>
                        </div>
                      </div>
                      <div class="col-md-12 no-padding mt_10" id="ctx_content_count">
                        <div class="col-md-4"><label for="ctx_count">Jumlah Penambahan Stok</label></div>
                        <div class="col-md-8">
                          <input type="number" id="ctx_count" value="1" min="1" max="100">
                          <span>(Total Saat Ini: <span id="ctx_stock">0</span>)</span>
                        </div>
                      </div>
                      <div class="col-md-12 no-padding mt_10" id="ctx_content_expired_at">
                        <div class="col-md-4"><label for="ctx_expired_at">Kadaluwarsa</label></div>
                        <div class="col-md-8">
                          <input type="datetime-local" class="form-control" id="ctx_expired_at" value="1" min="1" max="100">
                        </div>
                      </div>
                      <div class="col-md-12 mt_10">
                        <span class="btn pull-right" id="add_product">Tambah</span>
                      </div>
                    </div>
              </div>
          </div>
          <div class="col-md-12" style="padding: 0;">
            <div style="float:right">
              <button type="submit" class="btn">Simpan Penambahan Stok</button>
            </div>
          </div>
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
    </form>
    <!-- =====  FOOTER END  ===== -->
  </div>
  <a id="scrollup">Scroll</a>
<script src="js/jQuery_v3.1.1.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/custom.js"></script>
<script src="js/web.js"></script>
<script>
/**
 * tambah baris baru ke tabel transaksi
 */
function generateRow(id, name, count, existing, expired_at)
{
  let total = Number(count) + Number(existing)
  return `<tr>
      <td class="text-center"></td>
      <td class="text-left"><input type="hidden" name="id_product[]" id="id_product[]" value="${id}">${name}</td>
      <td class="text-right"><input type="datetime-local" class="form-control" name="expired_at[]" value="${expired_at}"></td>
      <td class="text-right"><input type="hidden" value="${existing}">${existing}</td>
      <td class="text-center"><input type="number" class="cs-inputcount" name="count[]" id="count[]" value="${count}" min="1" max="100"></td>
      <td class="text-right" id="subtotal">${total}</td>
      <td class="text-center"><a class="cs-btndelete">Hapus</a></td>
  </tr>`
}
/**
 * hitung total berdasarkan subtotal dari produk yang dibeli
 */
function countTotal(table)
{
  let rows = table.children('tr')
  let total = 0
  rows.each(function() {
      let subtotal = $(this).find('#subtotal').html()
      total += subtotal
  })
}
/**
 * hapus input yang ada di formulir (kecuali data input yang ada di tabel) 
 */
function clearInput()
{
  $('#ctx_product').val('').trigger('change')
  $('ctx_content_count').hide()
  $('ctx_content_expired_at').hide()
  $('#ctx_count').val(1)
  $('#ctx_expired_at').val(null)
}
$(document).ready(() => {
    var tbody = $('#cs-ordertb').children('tbody')
    var table =  tbody.length? tbody : $('#cs-ordertb')
    var ctx_product = $('#ctx_product')
    var ctx_customer = $('#ctx_customer')
    var ctx_count = $('#ctx_count')
    var ctx_expired_at = $('#ctx_expired_at')
    var ctx_content_count = $('#ctx_content_count')
    var ctx_content_expired_at = $('#ctx_content_expired_at')
    var ctx_custhelper = $('#ctx_custhelper')
    var row_count = 0

    ctx_content_count.hide()
    ctx_content_expired_at.hide()
    ctx_custhelper.hide()
    ctx_count.val(1)

    var dataProducts = []
    var dataCustomers = []
    var dataPickProduct
    var dataPickCustomer
    // ambil data produk dari database
    ctx_product.select2({
      placeholder: 'Masukkan Nama Produk',
      ajax: {
        type: 'POST',
        url: 'handlers/productsuggestionproc.php',
        data: function(params) {
          return {
            name: params.term
          }
        },
        dataType: 'json',
        delay: 250,
        processResults: function(res) {
          while (dataProducts.length > 0) dataProducts.pop()
          let result = []
          let existId = []
          table.find('tr').each(function() {
             existId.push(Number($(this).find('td').children('input[name^="id_product"]').val()))
          })
          res.forEach(element => {
            // kalau udah ada, jangan dimasukkin ke daftar seleksi
            if (!existId.includes(element.ID_PRODUCT)) dataProducts.push(element)
          });
          $.each(dataProducts, function(index, item) {
            result.push({
              id: item['ID_PRODUCT'],
              text: item['NAME'] + (item['UNIT']? ' - ' + item['UNIT'] : '') + ' (' + item['TYPE'] +')',
            })
          })
          return {
            results: result
          }
        },
        cache: false
      }
    })
    // hapus hasil dari seleksi sebelumnya
    ctx_product.on('change', function() {
      let id_product = ctx_product.children('option:selected').val()
      if (typeof id_product === typeof(undefined)) return
      dataPickProduct = dataProducts.find(data => data.ID_PRODUCT == id_product)
      ctx_content_count.show()
      ctx_content_expired_at.show()
      $('#ctx_stock').text(dataPickProduct.STOCK)
    })
    // hitung harga subtotal dari produk yang dibeli
    $(document).on('input', '#ctx_count', function() {
      let val = Number($(this).val())
      if (val > 100) $(this).val(100)
      else if (val >= 1) return
      else $(this).val(1)
    })
    // ganti subtotal produk
    $(document).on('input', 'input[name^="count"]', function() {
      let col_count = $(this)
      let col_stock = col_count.parent().prev()
      let col_subtotal = col_stock.next().next()
      let count = Number(col_count.val())
      if (count < 1) return col_count.val(1)
      else if (count > 100) return col_count.val(100)
      
      let subtotal = Number(count) + Number(col_stock.text())
      col_subtotal.text(subtotal)
    })
    // tambah produk baru ke tabel
    $('#add_product').click(function() {
      if (row_count == 10) return alert('Peringatan: Maksimal hanya 10 produk yang stoknya dapat ditambahkan')
      let name = ctx_product.children('option:selected').text()
      let count = ctx_count.val()
      let expired_at = ctx_expired_at.val()
      if (name.length == 0 || count.length == 0 || !expired_at) return

      let id_product = dataPickProduct.ID_PRODUCT
      let existing = dataPickProduct.STOCK
      table.append(generateRow(id_product, name, count, existing, expired_at))
      
      ctx_product.val('').trigger('change')
      ctx_content_count.hide()
      ctx_content_expired_at.hide()
      ctx_count.val(1)
      dataPickProduct = null
      row_count++
    })  
    // hapus baris dari tabel di baris ketika tulisan delete diklik
    $(table).on('click', '.cs-btndelete', function() {
      $(this).closest('tr').remove()
      row_count--
    })
})
</script>
</body>
</html>
