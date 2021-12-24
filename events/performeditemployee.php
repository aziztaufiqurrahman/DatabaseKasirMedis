<?php
session_start(); 
require "../connect.php"; 
require "../models/employees.php"; 

$id_employee = $_POST["id_employee"]; 
$nama = $_POST["nama"];
$password = $_POST['password']; 
$address = $_POST['address']; 

Employees::update($db, $id_employee, $password, $nama, $address);
return header("location:../employee.php");
?>