<?php
include 'koneksiuser.php';

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "add"){
        // Remove id_user from POST since it should be auto-increment
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];
        $tanggal_registrasi = $_POST['tanggal_registrasi']; // Fixed: was using 'alamat'
        $status_akun = $_POST['status_akun'];
        $nik = $_POST['nik'];

        // Handle file upload
        $foto_profil = "";
        if(isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0){
            $dir = "img/";
            $foto_profil = $_FILES['foto_profil']['name'];
            $tmpFile = $_FILES['foto_profil']['tmp_name'];
            
            // Create directory if it doesn't exist
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            
            move_uploaded_file($tmpFile, $dir.$foto_profil);
        }

        // Fixed SQL query - removed id_user and fixed syntax error
        $query = "INSERT INTO users (username, password, email, nama_lengkap, no_telepon, alamat, tanggal_registrasi, status_akun, foto_profil, nik) VALUES ('$username', '$password', '$email', '$nama_lengkap', '$no_telepon', '$alamat', '$tanggal_registrasi', '$status_akun', '$foto_profil', '$nik')";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: user.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } 
    else if($_POST['aksi'] == "edit"){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];
        $status_akun = $_POST['status_akun'];
        $nik = $_POST['nik'];

        // Handle file upload for edit
        $foto_profil_query = "";
        if(isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0){
            $dir = "img/";
            $foto_profil = $_FILES['foto_profil']['name'];
            $tmpFile = $_FILES['foto_profil']['tmp_name'];
            
            // Create directory if it doesn't exist
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            
            move_uploaded_file($tmpFile, $dir.$foto_profil);
            $foto_profil_query = ", foto_profil='$foto_profil'";
        }

        $query = "UPDATE users SET username='$username', password='$password', email='$email', nama_lengkap='$nama_lengkap', no_telepon='$no_telepon', alamat='$alamat', status_akun='$status_akun', nik='$nik'$foto_profil_query WHERE id_user='$id'";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: user.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    
    // Fixed table name and column name
    $query = "DELETE FROM users WHERE id_user = '$id'";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header("location: user.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>