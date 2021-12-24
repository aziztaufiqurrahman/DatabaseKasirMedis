<?php
session_start(); 
require "../connect.php"; 
require "../models/employees.php"; 

$username = $_POST["username"]; 
$nama = $_POST["nama"];
$password = $_POST['password']; 
$address = $_POST['address']; 

Employees::update($db, $username, $password, $nama, $address);
return header("location:../employee.php");
?>