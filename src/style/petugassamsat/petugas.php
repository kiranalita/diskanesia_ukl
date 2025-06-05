<?php
    include 'koneksi.php';

    // Cek koneksi database
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM petugassamsat;";
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
    
    <title>Data Petugas Samsat</title>
</head>
<body class="min-h-screen bg-gray-50">
    
     <!-- Sub Navigation -->
    <div class="flex p-6 bg-gray-800 border border-gray-400 rounded-md">
    <nav class="flex p-2 space-x-1 bg-blue-800 border border-gray-400 rounded-lg">
        <a href="../kendaraan/kendaraan.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
            Data Kendaraan
        </a>
        <a href="../users/user.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
            Data User
        </a>
        <a href="petugas.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
            Data Petugas
        </a>
    </nav>
</div>

    <!-- Navbar -->
    <nav class="p-4 bg-white">
        <div class="container mx-auto">
            <h1 class="text-xl font-bold">CRUD - Data Petugas Samsat</h1>
        </div>
    </nav>
      
    <!-- Content -->
    <div class="container p-6 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Data Petugas Samsat</h1>
        <figure class="mb-4">
            <blockquote class="pl-4 italic border-l-4 border-gray-500">
                <p>Data petugas samsat dalam database.</p>
            </blockquote>
            <figcaption class="mt-2 text-sm text-gray-700">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>

        <!-- Tombol Tambah Data -->
        <a href="kelolapetugas.php" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
            <i class="fa fa-plus"></i> Tambah Data
        </a>

        <!-- Tabel Data -->
        <div class="relative mt-5 overflow-x-auto">
            <table class="w-full border border-gray-600 rounded-lg">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="p-4 text-center">No.</th>
                        <th class="p-4">Foto</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Posisi</th>
                        <th class="p-4">Kantor Samsat</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($sql)): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2 text-center"><?php echo ++$no; ?>.</td>
                            <td class="p-2">
                                <?php if (!empty($result['foto_petugas'])): ?>
                                    <img src="/ukl/src/style/petugassamsat/img/<?php echo $result['foto_petugas']; ?>" 
                                         class="object-center w-32 h-32 rounded-md"
                                         alt="Foto <?php echo htmlspecialchars($result['nama_petugas']); ?>">
                                <?php else: ?>
                                    <p class="text-gray-500">Tidak ada foto</p>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result['nama_petugas'] ?? 'Tidak ada nama'); ?></td>
                            <td class="p-3 text-center"><?php echo htmlspecialchars($result['posisi'] ?? 'Tidak ada posisi'); ?></td>
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

</body>
</html>