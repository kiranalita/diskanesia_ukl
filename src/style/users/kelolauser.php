<?php
include 'koneksiuser.php';

$id_user = '';
$username = '';
$password = '';
$nama_lengkap = '';
$no_telepon = '';
$alamat = '';
$tanggal_registrasi = '';
$status_akun = '';
$foto_profil = '';
$email = '';
$nik = '';

if (isset($_GET['ubah'])) {  
    $id_user = $_GET['ubah']; // Pastikan ID User diambil dari parameter GET

    $query = "SELECT * FROM users WHERE id_user = '$id_user';";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $username = $result['username'] ?? ''; 
    $password = $result['password'] ?? ''; 
    $nama_lengkap = $result['nama_lengkap'] ?? ''; 
    $no_telepon = $result['no_telepon'] ?? ''; 
    $alamat = $result['alamat'] ?? ''; 
    $tanggal_registrasi = $result['tanggal_registrasi'] ?? ''; 
    $status_akun = $result['status_akun'] ?? ''; 
    $foto_profil = $result['foto_profil'] ?? ''; 
    $email = $result['email'] ?? ''; 
    $nik = $result['nik'] ?? ''; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/ukl/src/style/output.css">
  <title>Kelola User</title>
</head>
<body class="max-w-md p-6 mx-auto mt-10 text-center bg-white shadow-md rounded-2xl">

<nav class="p-8 bg-white">
  <div class="container mx-auto">
    <a class="text-3xl font-bold text-gray-800">CRUD USER</a>
  </div>
</nav>

<div class="container p-6 mx-auto">
  <form method="POST" action="prosesuser.php" enctype="multipart/form-data">
    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

    <div class="mb-3">
      <label for="username" class="block text-left">Username</label>
      <input required type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
    </div>

    <div class="mb-3">
      <label for="password" class="block text-left">Password</label>
      <input required type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
    </div>

    <div class="mb-3">
      <label for="nama_lengkap" class="block text-left">Nama Lengkap</label>
      <input required type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?php echo $nama_lengkap ?>">
    </div>

    <div class="mb-3">
      <label for="no_telepon" class="block text-left">No Telepon</label>
      <input required type="text" name="no_telepon" id="no_telepon" class="form-control" value="<?php echo $no_telepon ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="block text-left">Email</label>
      <input required type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>">
    </div>

    <div class="mb-3">
      <label for="alamat" class="block text-left">Alamat</label>
      <input required type="text" name="alamat" id="alamat" class="form-control" value="<?php echo $alamat ?>">
    </div>

    <div class="mb-3">
      <label for="nik" class="block text-left">NIK</label>
      <input required type="text" name="nik" id="nik" class="form-control" value="<?php echo $nik ?>">
    </div>

    <div class="mb-3">
      <label for="status_akun" class="block text-left">Status Akun</label>
      <input required type="text" name="status_akun" id="status_akun" class="form-control" value="<?php echo $status_akun ?>">
    </div>

    <div class="mb-3">
      <label for="foto" class="block text-left">Foto</label>
      <input <?php if (!isset($_GET['ubah'])) echo "required"; ?> type="file" name="foto" id="foto" class="form-control" accept="image/*">
    </div>

    <div class="mt-5 mb-3 row">
      <?php if (isset($_GET['ubah'])): ?>
        <button type="submit" name="aksi" value="edit" class="btn btn-primary">
          <i class="fa fa-floppy-o" aria-hidden="true"></i>
          Simpan Perubahan
        </button>
      <?php else: ?>
        <button type="submit" name="aksi" value="add" class="btn btn-primary">
          <i class="fa fa-floppy-o" aria-hidden="true"></i>
          Tambahkan
        </button>
      <?php endif; ?>
      <a href="user.php" class="btn btn-danger">Batal</a>
      <i class="fa fa-reply" aria-hidden="true"></i>
    </div>

  </form>
</div>

</body>
</html>
