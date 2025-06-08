<?php
session_start();
include '../../koneksi.php';

// Fungsi untuk membersihkan input
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fungsi untuk set pesan dan redirect
function setMessage($message, $type = 'error') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
    header("Location: kelolapajak.php");
    exit();
}

// Proses Tambah Data
if (isset($_POST['aksi']) && $_POST['aksi'] == 'add') {
    $id_kendaraan = cleanInput($_POST['id_kendaraan']);
    $nomor_pajak = cleanInput($_POST['nomor_pajak']);
    $tanggal_penetapan = cleanInput($_POST['tanggal_penetapan']);
    $jatuh_tempo = cleanInput($_POST['jatuh_tempo']);
    $jumlah_pajak = cleanInput($_POST['jumlah_pajak']);
    $denda = cleanInput($_POST['denda']);
    $status_pajak = cleanInput($_POST['status_pajak']);

    // Validasi input
    if (empty($id_kendaraan) || empty($nomor_pajak) || empty($tanggal_penetapan) || 
        empty($jatuh_tempo) || empty($jumlah_pajak) || empty($denda) || empty($status_pajak)) {
        setMessage('Semua field harus diisi!');
    }

    // Validasi format tanggal
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_penetapan) || 
        !preg_match('/^\d{4}-\d{2}-\d{2}$/', $jatuh_tempo)) {
        setMessage('Format tanggal harus YYYY-MM-DD!');
    }

    // Validasi nilai numerik
    if (!is_numeric($jumlah_pajak) || !is_numeric($denda)) {
        setMessage('Jumlah pajak dan denda harus berupa angka!');
    }

    // Konversi ke numeric untuk validasi lebih lanjut
    $jumlah_pajak = floatval($jumlah_pajak);
    $denda = floatval($denda);

    // Validasi jumlah pajak dan denda
    if ($jumlah_pajak < 0 || $denda < 0) {
        setMessage('Jumlah pajak dan denda tidak boleh negatif!');
    }

    // Validasi kendaraan exists
    $check_kendaraan = "SELECT id_kendaraan FROM kendaraan WHERE id_kendaraan = ?";
    $stmt_check = mysqli_prepare($conn, $check_kendaraan);
    mysqli_stmt_bind_param($stmt_check, "s", $id_kendaraan);
    mysqli_stmt_execute($stmt_check);
    $result_kendaraan = mysqli_stmt_get_result($stmt_check);
    
    if (mysqli_num_rows($result_kendaraan) == 0) {
        mysqli_stmt_close($stmt_check);
        setMessage('Kendaraan tidak ditemukan dalam database!');
    }
    mysqli_stmt_close($stmt_check);

    // Cek apakah nomor pajak sudah ada
    $check_query = "SELECT * FROM pajak WHERE nomor_pajak = ?";
    $stmt_check_pajak = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt_check_pajak, "s", $nomor_pajak);
    mysqli_stmt_execute($stmt_check_pajak);
    $check_result = mysqli_stmt_get_result($stmt_check_pajak);
    
    if (mysqli_num_rows($check_result) > 0) {
        mysqli_stmt_close($stmt_check_pajak);
        setMessage('Nomor pajak sudah ada dalam database!');
    }
    mysqli_stmt_close($stmt_check_pajak);

    // Validasi tanggal
    if (strtotime($jatuh_tempo) <= strtotime($tanggal_penetapan)) {
        setMessage('Tanggal jatuh tempo harus lebih besar dari tanggal penetapan!');
    }

    // Insert data menggunakan prepared statement
    $query = "INSERT INTO pajak (id_kendaraan, nomor_pajak, tanggal_penetapan, jatuh_tempo, jumlah_pajak, denda, status_pajak) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssdds", $id_kendaraan, $nomor_pajak, $tanggal_penetapan, 
                              $jatuh_tempo, $jumlah_pajak, $denda, $status_pajak);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            setMessage('Data pajak berhasil ditambahkan!', 'success');
        } else {
            mysqli_stmt_close($stmt);
            setMessage('Gagal menambahkan data pajak: ' . mysqli_error($conn));
        }
    } else {
        setMessage('Error dalam menyiapkan statement: ' . mysqli_error($conn));
    }
}

if(isset($_GET['hapus'])){
    $id_pajak = cleanInput($_GET['hapus']);
    
    if(empty($id_pajak)){
        setMessage('id pajak tidak valid')
    }
    $querycheck = "SELECT * FROM pajak WHERE id_pajak = ?";
    $stmtCheck = mysqli_prepare($conn, $querycheck);

    $query = "DELETE FROM pajak WHERE id_pajak = '$id_pajak'";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header("location: pajak.php");
        exit();
    } else {
        echo $query;
    }
}
?>