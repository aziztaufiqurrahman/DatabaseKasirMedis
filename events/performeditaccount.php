<?php
session_start(); 
require "../connect.php"; 
require "../models/employees.php"; 

$id_employee = $_SESSION['employee']->ID_EMPLOYEE; 
$nama = $_POST["nama"];
$password = $_POST['password']; 
$address = $_POST['address']; 

try
{
    Employees::update($db, $id_employee, $password, $nama, $address);
    $_SESSION['employee'] = json_decode(Employees::login($db, $_SESSION['employee']->USERNAME, $password));
    return header("location:../accounts.php?status=1");
}
catch (Exception $e)
{
    return header("location:../accounts.php?status=0");
}
?>