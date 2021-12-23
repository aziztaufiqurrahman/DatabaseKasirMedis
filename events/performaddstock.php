<?php
session_start(); 
require "../connect.php"; 
require "../models/products.php";
require "../models/procurements.php";
if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

$id_employee = $_SESSION['employee']->ID_EMPLOYEE;
$proc = Procurements::add($db, $id_employee);

foreach ($_POST['id_product'] as $key => $value)
{
    $id_product = $value;
    $amount = $_POST['count'][$key];
    $expired_at = formatdate($_POST['expired_at'][$key]);
    Products::addStock($db, $proc, $id_product, $id_employee, $amount, $expired_at);
}
return header("location:../category_page.php");
?>