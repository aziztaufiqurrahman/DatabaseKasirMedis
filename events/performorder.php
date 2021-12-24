<?php
session_start();
require "../connect.php";
require "../models/customers.php";
require "../models/orders.php";

// ambil data petugas
$id_employee = $_SESSION['employee']->ID_EMPLOYEE;

// ambil data customer
$id_customer = intval($_POST['ctx_custid']);
$phone = $_POST['ctx_custphone'];
$address = $_POST['ctx_custaddress'];
$name = ($id_customer == 0)? $_POST['ctx_customer'] : $_POST['ctx_custname'];
// lakukan UPSERT (UPDATE/INSERT) untuk data customer
$id_customer = Customers::upsert($db, $id_customer, $name, $phone, $address);
$order = Orders::create($db, $id_customer, $id_employee);
// ambil informasi tentang produk
if ($order)
{
    $id_order = $order['ID_ORDER'];
    $code = $order['CODE'];
    foreach ($_POST['id_product'] as $key => $value)
    {
        $id_product = $value;
        $amount = $_POST['count'][$key];
        // masukkan detail produk yang dibeli
        Orders::detail($db, $id_order, $id_product, $amount);
    }
    return header('location:../orders.php?ctx='.$code);
}
return header('location:../orders.php?ctx=0');
?>