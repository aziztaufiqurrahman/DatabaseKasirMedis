<?php
session_start(); 
require "../connect.php"; 
require "../models/products.php"; 

$id_product = $_POST['id_product']; 
$count = $_POST['count']; 
$expired_at = $_POST['expired_at']; 

?>