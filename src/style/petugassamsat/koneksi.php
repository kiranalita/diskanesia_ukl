<?php
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'diskanesia';
  
    $conn = mysqli_connect($host, $user, $pass, $db);
    if($conn){
      //echo "Terkoneksi";
    }

    mysqli_select_db($conn,$db);
?>
