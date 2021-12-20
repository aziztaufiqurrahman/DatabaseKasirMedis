<?php
session_start(); // Start session nya
include "connect.php"; // Load file connect.php

$username = $_POST['username']; // Ambil value username yang dikirim dari form
$password = $_POST['password']; // Ambil value password yang dikirim dari form

// Buat query untuk mengecek apakah ada data user dengan username dan password yang dikirim dari form
$sql = $db->prepare("SELECT * FROM employees WHERE username = :a AND password = :b");
$sql->bindValue(':a', $username);
$sql->bindValue(':b', "standard_hash('".$password."', 'MD5')");
$sql->execute(); // Eksekusi querynya

$data = $sql->fetch(); // Ambil datanya dari hasil query tadi
var_dump($data);
// Cek apakah variabel $data ada datanya atau tidak
if( ! empty($data)){ // Jika tidak sama dengan empty (kosong)
  $_SESSION['employee'] = $data; // Set session untuk username (simpan username di session)
  header("location: index.html"); // Kita redirect ke halaman index.php
// }else{ // Jika $data nya kosong
//   // Buat sebuah cookie untuk menampung data pesan kesalahan
//   header("location: login.html"); // Redirect kembali ke halaman login.html
}

?>