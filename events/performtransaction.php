<?php
require "../models/customers.php";
require "../models/transactions.php";
if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

// ambil data petugas
$id_employee = intval(3);

// ambil data customer
$id_customer = intval($_POST['ctx_custid']);
$phone = $_POST['ctx_custphone'];
$address = $_POST['ctx_custaddress'];
$name = ($id_customer == 0)? $_POST['ctx_custname'] : $_POST['ctx_custname'];

// lakukan UPSERT (UPDATE/INSERT) untuk data customer
// Customers::upsert($db, $id_customer, $name, $phone, $address);
print_r(pretty($_POST));
// $id_transaction = Transactions::create($db, $id_customer, $id_employee);
$id_transaction = 1;
// ambil informasi tentang produk
foreach ($_POST['id_product'] as $key => $value)
{
    $id_product = $value;
    $count = $_POST['count'][$key];

    
}
?>