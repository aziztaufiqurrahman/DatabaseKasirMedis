<?php 
include "connect.php";
include "models/products.php";
$produk= Products::getAll($db);
?>

<!DOCTYPE html>
<html>
<head>
<title>Daftar Produk</title>
<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<section class="riwayat">
<div class="container">
<h3>Daftar Produk</h3>

<table class="table table-bordered">
<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Unit</th>
<th>Harga</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$nomor=1;
?>


<?php foreach ($produk as $key) {
echo "<tr>";
echo "<td>". $nomor++."</td>";
echo "<td>". $key["NAME"]."</td>";
echo "<td>". $key["UNIT"]. "</td>";
echo "<td>". $key["PRICE"]. "</td>";
echo "<td>". "</td>";
echo "</tr>";
}?> 

</tbody>
</table>
</div>
</section>
</body>
</html>
