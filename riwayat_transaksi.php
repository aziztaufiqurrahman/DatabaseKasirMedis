<?php 
include "connect.php";
include "models/transactions.php";
$dataTransaksi= Transactions::getAll($db);
?>

<!DOCTYPE html>
<html>
<head>
<title>riwayat belanja</title>
<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<section class="riwayat">
<div class="container">
<h3>Riwayat Belanja</h3>

<table class="table table-bordered">
<thead>
<tr>
<th>No</th>
<th>Tanggal Berlangsung</th>
<th>Kode</th>
<th>Total</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$nomor=1;
?>

<td><?php echo $nomor++; ?></td>
<?php foreach ($dataTransaksi as $key) {
echo "<tr>";
echo "<td>". $key["CREATED_AT"]."</td>";
echo "<td>". $key["CODE"]. "</td>";
echo "<td>". "</td>";
echo "</tr>";
}?> 

</tbody>
</table>
</div>
</section>
</body>
</html>
