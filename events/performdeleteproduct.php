<?php
session_start(); 
require "../connect.php"; 
require "../models/products.php"; 

$id_product = $_POST["id_product"];

Products::delete($db, $id_product);
return header("location:../listproducts.php");
?>