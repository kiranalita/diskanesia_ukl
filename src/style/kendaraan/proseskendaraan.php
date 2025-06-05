<?php
// File: proseskendaraan.php
include 'koneksikendaraan.php';

// Cek koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Fungsi untuk membersihkan input dari potensi serangan
function clean_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

// Proses tambah atau edit data
if (isset($_POST['aksi'])) {
    // Ambil data dari form
    $id_kendaraan = clean_input($_POST['id_kendaraan'] ?? '');
    $nama_pemilik = clean_input($_POST['nama_pemilik'] ?? '');
    $nomor_STNK = clean_input($_POST['nomor_STNK'] ?? '');
    $nomor_registrasi = clean_input($_POST['nomor_registrasi'] ?? '');
    $alamat = clean_input($_POST['alamat'] ?? '');
    $merek = clean_input($_POST['merek'] ?? '');
    $tipe = clean_input($_POST['tipe'] ?? '');
    $jenis = clean_input($_POST['jenis'] ?? '');
    $model = clean_input($_POST['model'] ?? '');
    $tahun_pembuatan = clean_input($_POST['tahun_pembuatan'] ?? '');
    $isi_silinder_daya_listrik = clean_input($_POST['isi_silinder_daya_listrik'] ?? '');
    $nomor_rangka_VIN = clean_input($_POST['nomor_rangka_VIN'] ?? '');
    $nomor_mesin = clean_input($_POST['nomor_mesin'] ?? '');
    $NIK_TDO_KITAS_KITAP = clean_input($_POST['NIK_TDO_KITAS_KITAP'] ?? '');
    $warna = clean_input($_POST['warna'] ?? '');
    $bahan_bakar = clean_input($_POST['bahan_bakar'] ?? '');
    $warna_TNKB = clean_input($_POST['warna_TNKB'] ?? '');
    $tahun_registrasi = clean_input($_POST['tahun_registrasi'] ?? '');
    $no_bpkb = clean_input($_POST['no_bpkb'] ?? '');
    $no_urut_pendaftaran = clean_input($_POST['no_urut_pendaftaran'] ?? '');
    $kode_lokasi = clean_input($_POST['kode_lokasi'] ?? '');
    $berlaku_sampai = clean_input($_POST['berlaku_sampai'] ?? '');

    if ($_POST['aksi'] === 'add') {
        // Query INSERT data baru
        $query = "INSERT INTO kendaraan (id_kendaraan, nama_pemilik, nomor_STNK, nomor_registrasi, alamat, 
                  merek, tipe, jenis, model, tahun_pembuatan, isi_silinder_daya_listrik, 
                  nomor_rangka_VIN, nomor_mesin, NIK_TDO_KITAS_KITAP, warna, bahan_bakar, 
                  warna_TNKB, tahun_registrasi, no_bpkb, no_urut_pendaftaran, 
                  kode_lokasi, berlaku_sampai) 
                  VALUES ('$id_kendaraan', '$nama_pemilik', '$nomor_STNK', '$nomor_registrasi', '$alamat', 
                  '$merek', '$tipe', '$jenis', '$model', '$tahun_pembuatan', '$isi_silinder_daya_listrik', 
                  '$nomor_rangka_VIN', '$nomor_mesin', '$NIK_TDO_KITAS_KITAP', '$warna', '$bahan_bakar', 
                  '$warna_TNKB', '$tahun_registrasi', '$no_bpkb', '$no_urut_pendaftaran', 
                  '$kode_lokasi', '$berlaku_sampai')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data kendaraan berhasil disimpan!');</script>";
            header("Location: kendaraan.php");
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
        }
    } else if ($_POST['aksi'] === 'edit') {
        // Query UPDATE data
        $query = "UPDATE kendaraan SET 
                  nama_pemilik = '$nama_pemilik',
                  nomor_STNK = '$nomor_STNK',
                  nomor_registrasi = '$nomor_registrasi',
                  alamat = '$alamat',
                  merek = '$merek',
                  tipe = '$tipe',
                  jenis = '$jenis',
                  model = '$model',
                  tahun_pembuatan = '$tahun_pembuatan',
                  isi_silinder_daya_listrik = '$isi_silinder_daya_listrik',
                  nomor_rangka_VIN = '$nomor_rangka_VIN',
                  nomor_mesin = '$nomor_mesin',
                  NIK_TDO_KITAS_KITAP = '$NIK_TDO_KITAS_KITAP',
                  warna = '$warna',
                  bahan_bakar = '$bahan_bakar',
                  warna_TNKB = '$warna_TNKB',
                  tahun_registrasi = '$tahun_registrasi',
                  no_bpkb = '$no_bpkb',
                  no_urut_pendaftaran = '$no_urut_pendaftaran',
                  kode_lokasi = '$kode_lokasi',
                  berlaku_sampai = '$berlaku_sampai'
                  WHERE id_kendaraan = '$id_kendaraan'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil diperbarui!');</script>";
            header("Location: kendaraan.php");
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
            header("Location: kelolakendaraan.php?ubah=$id_kendaraan");
            exit();
        }
    }
}

// Proses hapus data
if (isset($_GET['hapus'])) {
    $id_kendaraan = clean_input($_GET['hapus']);

    $query = "DELETE FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
        header("Location: kendaraan.php");
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
        header("Location: kendaraan.php");
        exit();
    }
}

// Redirect jika tidak ada aksi yang dipilih
if (!isset($_POST['aksi']) && !isset($_GET['hapus'])) {
    header("Location: kendaraan.php");
    exit();
}
?>