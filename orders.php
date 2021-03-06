<?php
session_start();
require "connect.php";
require "models/producttypes.php";
$type = ProductTypes::getAll($db);
if (isset($_GET['ctx']))
{
  if (strlen($_GET['ctx']) > 1) echo "<script>alert('Transaksi jual beli berhasil dilakukan, Kode: ".$_GET['ctx']."');</script>";
  else echo "<script>alert('Transaksi jual beli gagal');</script>";
}
// guard
$role = "NONE";
if (isset($_SESSION['employee']) && !empty($_SESSION['employee']))
{
  $auth = $_SESSION['employee'];
  $role = $auth->ROLE;
}
if ($role != "Administrator" && $role != "Cashier") return header("location:login.php");
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
    <form method="post" action="events/performorder.php"> 
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
            </div>
          </div>
          <div class="left_banner left-sidebar-widget mt_30 mb_50"> <a href="#"><img src="images/leftt 1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
          <div class="left-cms left-sidebar-widget mb_50">
            
          </div>
         
          <!-- <div class="left_banner left-sidebar-widget mb_50"> <a href="#"><img src="images/left2.jpg" alt="Left Banner" class="img-responsive" /></a> </div> -->
          
        </div>
        <div id="column-right" class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="breadcrumb ptb_20">
            <h1>Transaksi Jual Beli</h1>
            <ul>
              <li><a href="index-2.html">Halaman Utama</a></li>
              <li class="active">Transaksi Jual Beli</li>
            </ul>
          </div>
          <!-- =====  BREADCRUMB END===== -->
            <div class="table-responsive">
              <table class="table table-bordered" id="cs-ordertb">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <!-- <th class="text-center" style="width: 15%;">Gambar</th> -->
                    <th class="text-center" style="width: 35%;">Nama Produk</th>
                    <th class="text-center" style="width: 5%;">Jumlah</th>
                    <th class="text-center" style="width: 20%;">Harga Satuan</th>
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
                        <div class="col-md-4"><label for="ctx_count">Jumlah Pembelian Produk</label></div>
                        <div class="col-md-8">
                          <input type="number" id="ctx_count" value="1" min="1" max="100">
                          <span>(Stok Tersedia: <span id="ctx_stock">0</span>)</span>
                        </div>
                      </div>
                      <div class="col-md-12 mt_10">
                        <span class="btn pull-right" id="add_product">Tambah</span>
                      </div>
                    </div>
              </div>
          </div>
          <div class="panel panel-default pull-left">
            <div class="panel-heading">
              <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Identitas Pembeli</a></h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 no-padding mt_10">
                    <div class="col-md-4"><label for="ctx_customer">Nama Pembeli</label></div>
                    <div class="col-md-8">
                      <select id="ctx_customer" name="ctx_customer" style='width: 100%;'></select>
                    </div>
                  </div>
                  <div class="col-md-12 no-padding mt_10">
                    <div class="col-md-4"><label for="ctx_custphone">No. Telepon</label></div>
                    <div class="col-md-8">
                      <input type="hidden" name="ctx_custid" id="ctx_custid" value="0">
                      <input type="hidden" name="ctx_custname" id="ctx_custname" value="">
                      <input type="text" class="form-control" name="ctx_custphone" id="ctx_custphone" placeholder="Masukkan No. Telepon Pembeli">
                    </div>
                  </div>
                  <div class="col-md-12 no-padding mt_10">
                    <div class="col-md-4"><label for="ctx_custaddress">Alamat</label></div>
                    <div class="col-md-8">
                      <textarea class="form-control cs-textarea" name="ctx_custaddress" id="ctx_custaddress"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mt_10" id="ctx_custhelper">
                      <p style="text-align: right; margin-bottom: 1em; font-style: italic;"><b>*)</b> Tekan tombol di bawah apabila anda ingin menghapus pembeli ini secara permanen.</p>
                      <span class="btn pull-right" id="ctx_custdelete">Hapus Pembeli</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td class="text-right" style="width: 70%;"><strong>Total:</strong></td>
                    <td class="text-right" id="ctx_total">Rp 0,00</td>
                  </tr>
                  <tr>
                    <td class="text-right" style="vertical-align: middle;">
                      <span style="vertical-align: middle;"><strong>Uang Bayar (Rp):</strong></span>
                    </td>
                    <td class="text-right">
                      <input class="form-control pull-right" style="height: 30px; width: auto;" placeholder="Masukkan uang bayar" id="ctx_custpay" type="text" min="0" max="999999999">
                    </td>
                  </tr>
                  <tr>
                    <td class="text-right"><strong>Kembalian:</strong></td>
                    <td class="text-right" id="ctx_change">Rp 0,00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12" style="padding: 0;">
            <div style="float:right">
              <button class="btn" id="clear_input">Bersihkan</button>
              <button type="submit" class="btn">Simpan Transaksi</button>
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
function generateRow(id, name, count, maxstock, price)
{
  let total = count * price
  return `<tr>
      <td class="text-center"></td>
      <td class="text-left"><input type="hidden" name="id_product[]" id="id_product[]" value="${id}">${name}</td>
      <td class="text-center"><input type="number" class="cs-inputcount" name="count[]" id="count[]" value="${count}" min="1" max="100"><input type="hidden" value="${maxstock}"></td>
      <td class="text-right">${numberToCurrency(price)}</td>
      <td class="text-right" id="subtotal">${numberToCurrency(total)}</td>
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
      total += currencyToNumber(subtotal)
  })
  $('#ctx_total').text(numberToCurrency(total))
  let payment = parseFloat($('#ctx_custpay').val().replaceAll('.','').replace(',','.'))
  let change = payment - total
  if (isNaN(change)) change = 0

  if (change < 0) $('#ctx_change').text(`Kurang ${numberToCurrency(change * -1)}`)
  else $('#ctx_change').text(numberToCurrency(change))
}
/**
 * hapus input yang ada di formulir (kecuali data input yang ada di tabel) 
 */
function clearInput()
{
  $('#ctx_product').val('').trigger('change')
  $('#ctx_customer').val('').trigger('change')
  $('ctx_content_count').hide()
  $('#ctx_count').val(1)
  $('ctx_customer').val('')
  $('#ctx_custphone').val('')
  $('#ctx_custaddress').val('')
  $('#ctx_custpay').val('')
  $('#ctx_change').text(numberToCurrency(0))
}
$(document).ready(() => {
    var tbody = $('#cs-ordertb').children('tbody')
    var table =  tbody.length? tbody : $('#cs-ordertb')
    var ctx_product = $('#ctx_product')
    var ctx_customer = $('#ctx_customer')
    var ctx_count = $('#ctx_count')
    var ctx_content_count = $('#ctx_content_count')
    var ctx_custhelper = $('#ctx_custhelper')
    var row_count = 0

    ctx_content_count.hide()
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
        url: 'handlers/productsuggestionorder.php',
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
    // ambil data customer dari databases
    ctx_customer.select2({
      placeholder: 'Masukkan Nama Pembeli',
      tags: true,
      ajax: {
        type: 'POST',
        url: 'handlers/customersuggestion.php',
        data: function(params) {
          return {
            name: params.term
          }
        },
        dataType: 'json',
        delay: 250,
        processResults: function(res) {
          let result = []
          res.forEach(element => {
            dataCustomers.push(element)
          });
          $.each(res, function(index, item) {
            result.push({
              id: item['ID_CUSTOMER'],
              text: item['NAME'] + ' (' + item['PHONE'] + ')'
            })
          })
          return {
            results: result
          }
        }
      }
    })
    // hapus hasil dari seleksi sebelumnya
    ctx_product.on('change', function() {
      let id_product = ctx_product.children('option:selected').val()
      if (typeof id_product === typeof(undefined)) return
      dataPickProduct = dataProducts.find(data => data.ID_PRODUCT == id_product)
      ctx_content_count.show()
      $('#ctx_stock').text(dataPickProduct.STOCK)
    })
    // hapus hasil dari seleksi sebelumnya
    ctx_customer.on('change', function() {
      let id_customer = $(this).val()
      if (typeof id_customer === typeof(undefined)) return
      dataPickCustomer = dataCustomers.find(data => data.ID_CUSTOMER == id_customer)
      let phone = ''
      let address = ''
      let id = 0
      let name = $('#ctx_customer :selected').text()
      if (dataPickCustomer)
      {
        phone = dataPickCustomer.PHONE
        address = dataPickCustomer.ADDRESS
        id = dataPickCustomer.ID_CUSTOMER
        name = dataPickCustomer.NAME
        $('#ctx_custhelper').show()
      }
      else $('#ctx_custhelper').hide()
      $('#ctx_custid').val(id)
      $('#ctx_custname').val(name)
      $('#ctx_custphone').val(phone)
      $('#ctx_custaddress').val(address)
    })
    // hitung harga subtotal dari produk yang dibeli
    $(document).on('input', '#ctx_count', function() {
      let val = Number($(this).val())
      if (val > dataPickProduct.STOCK) $(this).val(dataPickProduct.STOCK)
      else if (val >= 1) return
      else $(this).val(1)
    })
    // ganti subtotal produk
    $(document).on('input', 'input[name^="count"]', function() {
      let col_count = $(this)
      let col_max = $(this).next()
      let col_price = col_count.parent().next()
      let col_subtotal = col_price.next()
      let count = Number(col_count.val())
      let max = Number(col_max.val())
      if (count < 1) return col_count.val(1)
      else if (count > max) return col_count.val(max)
      
      let subtotal = count * currencyToNumber(col_price.text())
      col_subtotal.text(numberToCurrency(subtotal))
      countTotal(table)
    })
    // tambah produk baru ke tabel
    $('#add_product').click(function() {
      if (row_count == 10) return alert('Peringatan: Maksimal hanya 10 produk yang dapat dibeli dalam satu transaksi')
      let name = ctx_product.children('option:selected').text()
      let count = ctx_count.val()
      if (name.length == 0 || count.length == 0) return

      let id_product = dataPickProduct.ID_PRODUCT
      let price = dataPickProduct.PRICE
      let maxstock = dataPickProduct.STOCK
      table.append(generateRow(id_product, name, count, maxstock, price))
      countTotal(table)
      
      ctx_product.val('').trigger('change')
      ctx_content_count.hide()
      ctx_count.val(1)
      dataPickProduct = null
      row_count++
    })  
    // hapus baris dari tabel di baris ketika tulisan delete diklik
    $(table).on('click', '.cs-btndelete', function() {
      $(this).closest('tr').remove()
      countTotal(table)
      row_count--
    })
    // hapus semua input, kecuali data yang ada di tabel
    $('#clear_input').click(function() {
      clearInput()
    })
    // hitung kembalian berdasarkan uang yang dikasih sama pembeli
    $('#ctx_custpay').on('input', function() {
      countTotal(table)
    })
    // hapus customer ketika tombol diklik
    $('#ctx_custdelete').click(function(e) {
      let id_customer = Number($('#ctx_custid').val())
      if (id_customer == 0) return;
      let name = $('#ctx_custname').val()
      e.preventDefault()
      $.ajax({
        type: 'POST',
        url: 'handlers/deletecustomer.php',
        data: {
          id_customer: id_customer
        }
      })
      clearInput()
    })
})
</script>
</body>
</html>
