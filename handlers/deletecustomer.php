<?php
require "../connect.php";
require "../models/customers.php";
header("Content-type:application/json");

// ambil id milik customer, kalau 0 artinya ngga valid
if (!isset($_POST["id_customer"]) || empty($_POST["id_customer"])) return;
$id_customer = $_POST["id_customer"];
if ($id_customer <= 0) return;

// hapus data customer dari database dengan arti mengatur nilai dari kolom deleted_at-nya
Customers::softDelete($db, $id_customer);
?>