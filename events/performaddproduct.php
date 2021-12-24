<?php
session_start(); 
require "../connect.php"; 
require "../models/products.php"; 

$id_employee = $_SESSION['employee']->ID_EMPLOYEE; 
$nama = $_POST["nama"]; 
$unit = $_POST['unit']; 
$harga = $_POST['harga']; 
$expired_at = formatdate($_POST['expired_at']);
$tipe = $_POST['tipe']; 
$stock = $_POST['stock']; 

Products::add($db, $id_employee, $tipe, $nama, $unit, $harga, $stock, $expired_at);
return header("location:../listproducts.php");
?>