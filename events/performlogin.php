<?php
session_start(); // Start session nya
require "../connect.php"; // Load file connect.php
require "../models/employees.php"; // Load file employees.php

$username = $_POST['username']; // Ambil value username yang dikirim dari form
$password = $_POST['password']; // Ambil value password yang dikirim dari form

$data = Employees::login($db, $username, $password);
// Cek apakah variabel $data ada datanya atau tidak
if(!empty($data)){ // Jika tidak sama dengan empty (kosong)
  $_SESSION['employee'] = json_decode($data); // Set session untuk username (simpan username di session)
  header("location: ../index.php"); // Kita redirect ke halaman index.php
 }else{ // Jika $data nya kosong
   // Buat sebuah cookie untuk menampung data pesan kesalahan
   header("location: ../login.php?status=gagal"); // Redirect kembali ke halaman login.php
}

?>