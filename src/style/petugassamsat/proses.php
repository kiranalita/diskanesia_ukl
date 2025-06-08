<?php
include '../../koneksi.php';

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "add"){
        $nama_petugas = $_POST['nama_petugas'];
        $foto_petugas = $_FILES['foto']['name'];
        $posisi = $_POST['posisi'];
        $kantor_samsat = $_POST['kantor_samsat'];

        $dir = "img/";
        $tmpFile = $_FILES['foto']['tmp_name'];
        
        move_uploaded_file($tmpFile, $dir.$foto_petugas);

        $query = "INSERT INTO petugassamsat (nama_petugas, foto_petugas, posisi, kantor_samsat) VALUES ('$nama_petugas', '$foto_petugas', '$posisi', '$kantor_samsat')";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: petugas.php");
            exit();
        } else {
            echo $query;
        }
    } 
    else if($_POST['aksi'] == "edit"){
        $id_petugas = $_POST['id_petugas'];
        $nama_petugas = $_POST['nama_petugas'];
        $posisi = $_POST['posisi'];
        $kantor_samsat = $_POST['kantor_samsat'];

        $queryShow = "SELECT * FROM petugassamsat WHERE id_petugas = '$id_petugas'";
        $sqlShow = mysqli_query($conn, $queryShow);
        $result = mysqli_fetch_assoc($sqlShow);

        if($_FILES['foto']['name'] == ""){
            $foto = $result['foto_petugas']; 
        } else {
            $foto = $_FILES['foto']['name'];
            if(file_exists("img/".$result['foto_petugas']) && !empty($result['foto_petugas'])){
                unlink("img/".$result['foto_petugas']);
            }
            
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$foto);
        }

        $query = "UPDATE petugassamsat SET nama_petugas='$nama_petugas', posisi='$posisi', kantor_samsat='$kantor_samsat', foto_petugas='$foto' 
        WHERE id_petugas='$id_petugas'";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: petugas.php");
            exit();
        } else {
            echo $query;
        }
    }
}

if(isset($_GET['hapus'])){
    $id_petugas = $_GET['hapus'];
    
    $queryShow = "SELECT * FROM petugassamsat WHERE id_petugas = '$id_petugas'";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if(file_exists("img/".$result['foto_petugas']) && !empty($result['foto_petugas'])){
        unlink("img/".$result['foto_petugas']);
    }

    $query = "DELETE FROM petugassamsat WHERE id_petugas = '$id_petugas'";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header("location: petugas.php");
        exit();
    } else {
        echo $query;
    }
}
?>