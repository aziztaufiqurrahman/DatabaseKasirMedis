<?php
session_start(); 
require "../connect.php"; 
require "../models/products.php"; 

$nama = $_POST["nama"]; 
$id_product = $_POST["id_product"];
$unit = $_POST['unit']; 
$harga = $_POST['harga']; 

Products::update($db, $id_product, $nama, $unit, $harga);
return header("location:../listproducts.php");
?>