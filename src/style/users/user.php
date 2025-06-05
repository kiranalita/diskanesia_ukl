<?php
    include 'koneksiuser.php';

    // Cek koneksi database
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM users";
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
    <link rel="stylesheet" href="../../src/style/output.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>Admin - User</title>
</head>
<body class="p-4 bg-gray-700">
    <div class="flex p-6 bg-gray-800 border border-gray-400 rounded-md">
    <nav class="flex p-2 space-x-1 bg-blue-800 border border-gray-400 rounded-lg">
        <a href="../kendaraan/kendaraan.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
            Data Kendaraan
        </a>
        <a href="/user.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
            Data User
        </a>
        <a href="../petugassamsat/petugas.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
            Data Petugas
        </a>
    </nav>
</div>
    
    <nav class="p-4 bg-white">
        <div class="container-mx-auto">
            <h1 class="text-xl font-bold ">CRUD - Data User Login</h1>
        </div>
    </nav>
      
    <div class="container p-6 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Data User</h1>
        <figure class="mb-4">
            <blockquote class="pl-4 italic border-l-4 border-gray-500">
                <p>Data User dalam Database.</p>
            </blockquote>
            <figcaption class="mt-2 text-sm text-gray-700">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>

        <!-- Tombol Tambah Data -->
        <a href="kelolauser.php" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
            <i class="fa fa-plus"></i> Tambah Data
        </a>
        
        <!-- Tabel Data -->
        <div class="relative mt-5 overflow-x-auto">
            <table class="w-full border border-gray-600 rounded-lg">
                <thead class="table-light">
                    <tr>
                        <th class="w-4 text-center">No</th>
                        <th>Foto Profil</th>
                        <th>Password</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Tanggal Registrasi</th>
                        <th>Status Akun</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>NIK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
    <?php while ($result = mysqli_fetch_assoc($sql)): ?>
        <tr class="border-b hover:bg-gray-50">
            <td class="p-2 text-center"><?php echo ++$no; ?>.</td>
            <td class="p-2">
                <?php if (!empty($result['foto_profil'])): ?>
                    <img src="/ukl/src/style/users/img/<?php echo $result['foto_profil']; ?>" 
                         class="object-center w-32 h-32 rounded-md"
                         alt="Foto <?php echo htmlspecialchar
                        ($result['nama_lengkap']); ?>">
                <?php else: ?>
                    <p class="text-gray-500">Tidak ada foto</p>
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($result['foto_profil']); ?></td>
            <td><?php echo htmlspecialchars($result['password']); ?></td>
            <td><?php echo htmlspecialchars($result['username']); ?></td>
            <td><?php echo htmlspecialchars($result['nama_lengkap']); ?></td>
            <td><?php echo htmlspecialchars($result['alamat']); ?></td>
            <td><?php echo htmlspecialchars($result['tanggal_registrasi']); ?></td>
            <td><?php echo htmlspecialchars($result['status_akun']); ?></td>
            <td><?php echo htmlspecialchars($result['no_telepon']); ?></td>
            <td><?php echo htmlspecialchars($result['email']); ?></td>
            <td><?php echo htmlspecialchars($result['nik']); ?></td>
            <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="kelolauser.php?ubah=<?php echo htmlspecialchars($row['id_user'] ?? ''); ?>" class="px-3 py-1 text-sm text-white bg-green-500 rounded hover:bg-green-600">
                                            <i class="fa fa-pencil"></i> Ubah
                                        </a>
                                        <a href="prosesuser.php?hapus=<?php echo htmlspecialchars($row['id_user'] ?? ''); ?>" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
        </tr>
    <?php endwhile; ?>
</tbody>
            </table>
        </div>
    </div>

</body>
</html>