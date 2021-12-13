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
$name = ($id_customer == 0)? $_POST['ctx_customer'] : $_POST['ctx_custname'];
// lakukan UPSERT (UPDATE/INSERT) untuk data customer
$id_customer = Customers::upsert($db, $id_customer, $name, $phone, $address);
$transaction = Transactions::create($db, $id_customer, $id_employee);
// ambil informasi tentang produk
if ($transaction)
{
    $id_transaction = $transaction['ID_TRANSACTION'];
    $code = $transaction['CODE'];
    foreach ($_POST['id_product'] as $key => $value)
    {
        $id_product = $value;
        $amount = $_POST['count'][$key];
        // masukkan detail produk yang dibeli
        Transactions::detail($db, $id_transaction, $id_product, $amount);
    }
    return header('location:../calculator.html?ctx='.$code);
}
return header('location:../calculator.html?ctx=0');
?>