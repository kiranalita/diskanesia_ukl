<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "diskanesia";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset untuk mendukung karakter khusus
mysqli_set_charset($conn, "utf8");
?>