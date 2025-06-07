<?php
    include 'koneksipajak.php';

    // Cek koneksi database
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query dengan JOIN untuk mendapatkan data dari tabel pajak dan kendaraan
    $query = "SELECT p.*, k.merek, k.model, k.nomor_registrasi 
              FROM pajak p 
              LEFT JOIN kendaraan k ON p.id_kendaraan = k.id_kendaraan 
              ORDER BY p.id_pajak DESC";
    
    $sql = mysqli_query($conn, $query);

    if (!$sql) {
        die("Error dalam query: " . mysqli_error($conn));
    }

    $no = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Updated CSS path to match your directory structure -->
    <link rel="stylesheet" href="/ukl/src/style/output.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>Data Pajak</title>
</head>
<body class="min-h-screen bg-gray-50">
    
     <!-- Sub Navigation -->

    <nav class="flex p-2 space-x-1 border border-gray-400 rounded-lg bg">
        <a href="../kendaraan/kendaraan.php" class="px-4 py-2 font-medium text-black transition-colors bg-white border border-gray-400 rounded-md hover:bg-slate-600 hover:text-white">
            Data Kendaraan
        </a>
        <a href="../users/user.php" class="px-4 py-2 font-medium text-black transition-colors bg-white border border-gray-400 rounded-md hover:bg-slate-600 hover:text-white">
            Data User
        </a>
        <a href="../petugassamsat/petugas.php" class="px-4 py-2 font-medium text-black transition-colors bg-white border border-gray-400 rounded-md hover:bg-slate-600 hover:text-white">
            Data Petugas
        </a>
        <a href="pajak.php" class="px-4 py-2 font-medium text-black transition-colors bg-white border border-gray-400 rounded-md hover:bg-slate-600 hover:text-white">
            Data Pajak
        </a>
    </nav>

    <!-- Navbar -->
    <nav class="p-4 bg-white">
        <div class="container mx-auto">
            <h1 class="text-xl font-bold">CRUD - Data Pajak</h1>
        </div>
    </nav>
      
    <!-- Content -->
    <div class="container p-6 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Data Pajak</h1>
        <figure class="mb-4">
            <blockquote class="pl-4 italic border-l-4 border-gray-500">
                <p>Data pajak kendaraan dalam database.</p>
            </blockquote>
            <figcaption class="mt-2 text-sm text-gray-700">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>

        <!-- Tombol Tambah Data -->
        <a href="kelolapajak.php" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
            <i class="fa fa-plus"></i> Tambah Data
        </a>

        <!-- Tabel Data -->
        <div class="relative mt-5 overflow-x-auto">
            <table class="w-full border border-gray-600 rounded-lg">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="p-4 text-center">No.</th>
                        <th class="p-4">Plat Nomor</th>
                        <th class="p-4">Merek/Model</th>
                        <th class="p-4">Nomor Pajak</th>
                        <th class="p-4">Tanggal Penetapan</th>
                        <th class="p-4">Jatuh Tempo</th>
                        <th class="p-4">Jumlah Pajak</th>
                        <th class="p-4">Denda</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($sql)): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2 text-center"><?php echo ++$no; ?>.</td>
                            <td class="p-3 font-semibold text-center text-blue-600">
                                <?php 
                                // Gabungkan plat kendaraan dan nomor registrasi
                                $plat_info = '';
                                if (!empty($result['plat_kendaraan'])) {
                                    $plat_info = htmlspecialchars($result['plat_kendaraan']);
                                }
                                if (!empty($result['nomor_registrasi'])) {
                                    if (!empty($plat_info)) {
                                        $plat_info .= ' (' . htmlspecialchars($result['nomor_registrasi']) . ')';
                                    } else {
                                        $plat_info = htmlspecialchars($result['nomor_registrasi']);
                                    }
                                }
                                echo !empty($plat_info) ? $plat_info : 'Data Tidak Ditemukan';
                                ?>
                            </td>
                            <td class="p-3 text-center">
                                <?php 
                                if (!empty($result['merek']) && !empty($result['model'])) {
                                    echo htmlspecialchars($result['merek'] . ' ' . $result['model']);
                                } else {
                                    echo 'Data Tidak Ditemukan';
                                }
                                ?>
                            </td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result['nomor_pajak'] ?? 'Tidak ada nomor'); ?></td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result['tanggal_penetapan'] ?? 'Tidak ada tanggal'); ?></td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result['jatuh_tempo'] ?? 'Tidak ada jatuh tempo'); ?></td>
                            <td class="p-3 text-center">Rp <?php echo number_format($result['jumlah_pajak'] ?? 0, 0, ',', '.'); ?></td>
                            <td class="p-3 text-center">Rp <?php echo number_format($result['denda'] ?? 0, 0, ',', '.'); ?></td>
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 text-xs rounded-full <?php 
                                    echo ($result['status_pajak'] == 'Lunas') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; 
                                ?>">
                                    <?php echo htmlspecialchars($result['status_pajak'] ?? 'Tidak ada status'); ?>
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <a href="kelolapajak.php?ubah=<?php echo htmlspecialchars($result['id_pajak']); ?>" 
                                   class="px-3 py-1 mr-1 text-sm text-white bg-green-500 rounded hover:bg-green-600">
                                    <i class="fa fa-pencil"></i> Ubah
                                </a>
                                <a href="prosespajak.php?hapus=<?php echo htmlspecialchars($result['id_pajak']); ?>" 
                                   class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    
                    <?php if (mysqli_num_rows($sql) == 0): ?>
                        <tr>
                            <td colspan="10" class="p-4 text-center text-gray-500">
                                Tidak ada data pajak yang tersedia
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>