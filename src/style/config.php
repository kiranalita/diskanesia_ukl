<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "diskanesia"; // Mengubah nama database dari etaxdb ke diskanesia


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


define('BASE_URL', 'http://localhost/ukl/');
?>