<?php
    include 'koneksikendaraan.php';

    // Cek koneksi database
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM kendaraan";
    $sql = mysqli_query($conn, $query);

    if (!$sql) {
        die("Error dalam query: " . mysqli_error($conn));
    }

    $no = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan - SAMSAT</title>
    <link rel="stylesheet" href="../../src/style/output.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gray-50">
    
    <!-- Sub Navigation -->
    <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-wrap gap-2 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
            <a href="../kendaraan/kendaraan.php" 
               class="px-4 py-2 font-medium text-white transition-colors bg-indigo-600 rounded-md hover:bg-indigo-700">
                Data Kendaraan
            </a>
            <a href="../users/user.php" 
               class="px-4 py-2 font-medium text-gray-700 transition-colors bg-gray-200 rounded-md hover:bg-gray-300">
                Data User
            </a>
            <a href="../petugassamsat/petugas.php" 
               class="px-4 py-2 font-medium text-gray-700 transition-colors bg-gray-200 rounded-md hover:bg-gray-300">
                Data Petugas
            </a>
        </div>
    </div>
    
    <!-- Navbar -->
    <nav class="p-4 bg-white">
        <div class="container mx-auto">
            <h1 class="text-xl font-bold">CRUD - Data Kendaraan</h1>
        </div>
    </nav>
    
    <!-- Content -->
    <div class="container p-6 mx-auto">
        <!-- Header Section -->
        <div class="px-6 py-4 border-b border-gray-200 rounded-t-lg bg-gray-50">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Data Kendaraan</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Kelola data kendaraan yang terdaftar di sistem SAMSAT
                    </p>
                </div>
                <a href="kelolakendaraan.php" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i class="mr-2 fas fa-plus"></i>
                    Tambah Data
                </a>
            </div>
        </div>

        <figure class="mb-4">
            <blockquote class="pl-4 italic border-l-4 border-gray-500">
                <p>Data Kendaraan dalam Database.</p>
            </blockquote>
            <figcaption class="mt-2 text-sm text-gray-700">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>
            
        <!-- Tabel Data -->
        <div class="relative mt-5 overflow-x-auto rounded-lg shadow-md">
            <table class="w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="p-4 text-center">No.</th>
                        <th class="p-4">ID Kendaraan</th>
                        <th class="p-4">Nomor STNK</th>
                        <th class="p-4">Nomor Registrasi</th>
                        <th class="p-4">Nama Pemilik</th>
                        <th class="p-4">Alamat</th>
                        <th class="p-4">Merek</th>
                        <th class="p-4">Tipe</th>
                        <th class="p-4">Jenis</th>
                        <th class="p-4">Model</th>
                        <th class="p-4">Tahun Pembuatan</th>
                        <th class="p-4">Silinder/Daya Listrik</th>
                        <th class="p-4">Nomor Rangka/VIN</th>
                        <th class="p-4">Nomor Mesin</th>
                        <th class="p-4">NIK TDO</th>
                        <th class="p-4">Warna</th>
                        <th class="p-4">Bahan Bakar</th>
                        <th class="p-4">Warna TNKB</th>
                        <th class="p-4">Tahun Registrasi</th>
                        <th class="p-4">No BPKB</th>
                        <th class="p-4">No Urut Pendaftaran</th>
                        <th class="p-4">Kode Lokasi</th>
                        <th class="p-4">Masa Berlaku</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($sql)): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 text-center"><?php echo ++$no; ?>.</td>
                            <td class="p-3"><?php echo htmlspecialchars($result['id_kendaraan'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['nomor_stnk'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['nomor_registrasi'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['nama_pemilik'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['alamat'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['merek'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['tipe'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['jenis'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['model'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['tahun_pembuatan'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['silinder_daya_listrik'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['nomor_rangka_vin'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['nomor_mesin'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['nik_tdo'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['warna'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['bahan_bakar'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['warna_tnkb'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['tahun_registrasi'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['no_bpkb'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['no_urut_pendaftaran'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['kode_lokasi'] ?? 'N/A'); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($result['masa_berlaku'] ?? 'N/A'); ?></td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="kelolakendaraan.php?ubah=<?php echo htmlspecialchars($result['id_kendaraan']); ?>" 
                                       class="px-3 py-1 text-sm text-white bg-green-500 rounded hover:bg-green-600">
                                        <i class="fa fa-pencil"></i> Ubah
                                    </a>
                                    <a href="proseskendaraan.php?hapus=<?php echo htmlspecialchars($result['id_kendaraan']); ?>" 
                                       class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Footer Info -->
        <div class="px-6 py-3 rounded-b-lg bg-gray-50">
            <div class="flex items-center justify-between text-sm text-gray-700">
                <div>
                    Total data: <span class="font-semibold"><?php echo mysqli_num_rows($sql); ?></span> kendaraan
                </div>
                <div>
                    <span class="text-xs text-gray-500">
                        Sistem Manajemen SAMSAT © <?php echo date('Y'); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Auto refresh setiap 5 menit untuk update status berlaku sampai
        setTimeout(function(){
            location.reload();
        }, 300000);
    </script>
</body>
</html>