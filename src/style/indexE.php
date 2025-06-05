<?php
define('BASE_URL', './');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TAX Sidoarjo - Sistem Pembayaran Pajak Digital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/output.css">
    <style>
        .background-overlay {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="font-sans leading-10 text-white bg-fixed bg-center bg-cover" style="background-image: url('gambar.jpeg');">
    <div class="fixed inset-0 z-10 overlay background-overlay"></div>
    <div class="container relative z-20 max-w-5xl p-5 mx-auto">
        <header class="flex items-center justify-between py-5 border-b border-white header border-opacity-10">
            <div class="text-2xl font-bold text-white logo">E-Tax Sidoarjo</div>
            <nav class="flex gap-51">
                <a href="<?php echo BASE_URL; ?>indexE.php" class="flex items-center gap-2 text-white transition-colors hover:text-green-700"><i class="fas fa-home"></i> Beranda</a>
                <a href="<?php echo BASE_URL; ?>contact.php" class="flex items-center gap-2 text-white transition-colors hover:text-green-700"><i class="fas fa-envelope"></i> Kontak</a>
                <a href="<?php echo BASE_URL; ?>login.php" class="flex items-center gap-2 text-white transition-colors hover:text-green-700"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a href="<?php echo BASE_URL; ?>akun.php" class="flex items-center gap-2 text-white transition-colors hover:text-green-700"><i class="fa-regular fa-user"></i> Akun</a>
            </nav>
        </header>

        <div class="py-12 text-center welcome-banner">
            <h1 class="mb-4 text-4xl">Selamat Datang di E-Tax Sidoarjo</h1>
            <p class="max-w-xl mx-auto text-lg text-shadow">Platform pembayaran pajak online untuk wilayah Sidoarjo. Kelola pajak Anda dengan mudah, cepat, dan aman.</p>
        </div>

        <div class="grid grid-cols-1 gap-5 mt-20 services md:grid-cols-2 lg:grid-cols-3">
            <a href="pajak_kendaraan.php" class="p-8 text-center transition-transform transform bg-white rounded-lg card bg-opacity-10 hover:scale-105 hover:bg-opacity-100">
                <i class="mb-4 text-6xl text-green-700 fas fa-car"></i>
                <h2 class="mb-2 text-xl">Pajak Kendaraan</h2>

               
