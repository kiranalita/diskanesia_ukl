<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pajak Kendaraan - E-Tax Sidoarjo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --text-color: #333;
            --background-color: #f4f7f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('gambar.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            line-height: 1.6;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 2;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .requirements-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .requirement-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .requirement-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        .requirement-card h2 i {
            margin-right: 10px;
            color: var(--secondary-color);
        }

        .requirements-list {
            list-style-type: none;
        }

        .requirements-list li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 10px;
            color: white;
        }

        .requirements-list li::before {
            content: '\2022';
            color: var(--primary-color);
            font-weight: bold;
            position: absolute;
            left: 0;
            font-size: 1.2em;
        }


        .footer {
            background: rgba(0,0,0,0.7);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        .footer-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .footer-links {
            margin-top: 15px;
        }

        .footer-links a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .requirements-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header">
            <h1>Pembayaran Pajak Kendaraan Online</h1>
        </div>

        <div class="requirements-section">
            <?php 
            $sections = [
                ['icon' => 'user', 'title' => 'Data Pribadi', 'items' => [
                    'Nama lengkap', 'Nomor KTP/SIM', 'Alamat email', 
                    'Nomor telepon', 'Alamat rumah'
                ]],
                ['icon' => 'car', 'title' => 'Data Kendaraan', 'items' => [
                    'Nomor kendaraan', 'Jenis kendaraan', 'Merek dan model', 
                    'Tahun pembuatan', 'Nomor mesin', 'Nomor rangka'
                ]],
                ['icon' => 'file-invoice-dollar', 'title' => 'Data Pajak', 'items' => [
                    'Jenis pajak', 'Tahun pajak', 'Besaran pajak', 
                    'Status pembayaran'
                ]],
                ['icon' => 'file-alt', 'title' => 'Dokumen Pendukung', 'items' => [
                    'Foto KTP/SIM', 'Foto STNK', 'Foto bukti pembayaran', 
                    'Dokumen lainnya'
                ]],
                ['icon' => 'credit-card', 'title' => 'Informasi Pembayaran', 'items' => [
                    'Metode pembayaran', 'Nomor rekening', 
                    'Tanggal pembayaran', 'Jumlah pembayaran'
                ]],
                ['icon' => 'lock', 'title' => 'Keamanan', 'items' => [
                    'Password/PIN', 'Pertanyaan keamanan', 
                    'Izin penggunaan data pribadi'
                ]]
            ];

            foreach ($sections as $section) {
                echo "<div class='requirement-card'>";
                echo "<h2><i class='fas fa-{$section['icon']}'></i>{$section['title']}</h2>";
                echo "<ul class='requirements-list'>";
                foreach ($section['items'] as $item) {
                    echo "<li>{$item}</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
            ?>
        </div>
        </div>
    </div>

    <footer class="footer">
            <p>&copy; 2024 E-Tax Sidoarjo.</p>
    </footer>
</body>
</html>