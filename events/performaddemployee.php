<?php
session_start(); 
require "../connect.php"; 
require "../models/employees.php"; 

$id_employee = $_SESSION['employee']->ID_EMPLOYEE; 
$nama = $_POST["nama"]; 
$username = $_POST['username']; 
$password = $_POST['password']; 
$phone = $_POST['phone']; 
$role = $_POST['role']; 
$address = $_POST['address']; 

Employees::add($db, $username, $password, $nama, $role, $phone, $address);
return header("location:../employee.php");
?>