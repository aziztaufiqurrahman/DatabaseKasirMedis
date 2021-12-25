<?php
session_start(); 
require "../connect.php"; 
require "../models/orders.php"; 

$id_order = $_POST["id_order"];

Orders::archive($db, $id_order);
return header("location:../riwayattransactionssemua.php");
?>