<?php
session_start(); 
require "../connect.php"; 
require "../models/employees.php"; 

$id_employee = $_POST["id_employee"];

Employees ::delete($db, $id_employee);
return header("location:../employee.php");
?>