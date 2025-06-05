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
</head>
<body class="min-h-screen bg-gray-50">
    
    <!-- Sub Navigation -->
    <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-wrap gap-2 p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
            <a href="../kendaraan/kendaraan.php" 
               class="px-4 py-2 font-medium text-white transition-colors bg-indigo-600 rounded-md hover:bg-indigo-700">
                <i class="mr-2 fas fa-car"></i>Data Kendaraan
            </a>
            <a href="../users/user.php" 
               class="px-4 py-2 font-medium text-gray-700 transition-colors bg-gray-200 rounded-md hover:bg-gray-300">
                <i class="mr-2 fas fa-users"></i>Data User
            </a>
            <a href="../petugassamsat/petugas.php" 
               class="px-4 py-2 font-medium text-gray-700 transition-colors bg-gray-200 rounded-md hover:bg-gray-300">
                <i class="mr-2 fas fa-user-tie"></i>Data Petugas
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
        <h1 class="mb-4 text-2xl font-bold">Data Kendaraan</h1>
        <figure class="mb-4">
            <blockquote class="pl-4 italic border-l-4 border-gray-500">
                <p>Data Kendaraan.</p>
            </blockquote>
            <figcaption class="mt-2 text-sm text-gray-700">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>

         <!-- Tombol Tambah Data -->
        <a href="kelolapetugas.php" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
            <i class="fa fa-plus"></i> Tambah Data
        </a>
        
            <!-- Header Section -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
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
            
             <!-- Tabel Data -->
        <div class="relative mt-5 overflow-x-auto">
            <table class="w-full border border-gray-600 rounded-lg">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="p-4 text-center">No.</th>
                        <th class="p-4">id kendaraan</th>
                        <th class="p-4">nomor STNK</th>
                        <th class="p-4">nomor registrasi</th>
                        <th class="p-4">nama pemilik</th>
                        <th class="p-4">alamat</th>
                        <th class="p-4">merek</th>
                        <th class="p-4">tipe</th>
                        <th class="p-4">jenis</th>
                        <th class="p-4">model</th>
                        <th class="p-4">tahun pembuatan</th>
                        <th class="p-4">silinder daya listrik</th>
                        <th class="p-4">nomor rangka VIN</th>
                        <th class="p-4">nomor mesin</th>
                        <th class="p-4">NIK TDO</th>
                        <th class="p-4">warna</th>
                        <th class="p-4">bahan bakar</th>
                        <th class="p-4">warna TNKB</th>
                        <th class="p-4">tahun registrasi</th>
                        <th class="p-4">no bpkb</th>
                        <th class="p-4">no urut pendaftaran</th>
                        <th class="p-4">kode lokasi</th>
                        <th class="p-4">masa berlaku</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($sql)): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2 text-center"><?php echo ++$no; ?>.</td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result['id_'] ?? 'Tidak ada nama'); ?></td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result,['posisi'] ?? 'Tidak ada posisi'); ?></td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result['kantor_samsat'] ?? 'Tidak ada kantor'); ?></td>
                            <td class="p-3 text-center">
                                <a href="kelolapetugas.php?ubah=<?php echo htmlspecialchars($result['id_petugas']); ?>" 
                                   class="px-3 py-1 text-sm text-white bg-green-500 rounded hover:bg-green-600">
                                    <i class="fa fa-pencil"></i> Ubah
                                </a>
                                <a href="proses.php?hapus=<?php echo htmlspecialchars($result['id_petugas']); ?>" 
                                   class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>


            <!-- Footer Info -->
            <div class="px-6 py-3 bg-gray-50">
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