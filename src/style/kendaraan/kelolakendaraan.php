<?php
include 'koneksikendaraan.php';

// Inisialisasi variabel
$id_kendaraan = '';
$id_wajibpajak = '';
$nomor_STNK = '';
$nomor_registrasi = '';
$nama_pemilik = '';
$Alamat = '';
$merek = '';
$Tipe = '';
$Jenis = '';
$model = '';
$tahun_pembuatan = '';
$isi_silinder_daya_listrik = '';
$nomor_rangka_VIN = '';
$nomor_mesin = '';
$NIK_TDO_KITAS_KITAP = '';
$warna = '';
$bahan_bakar = '';
$warna_TNKB = '';
$tahun_registrasi = '';
$no_bpkb = '';
$no_urut_pendaftaran = '';
$kode_lokasi = '';
$berlaku_sampai = '';

// Jika mode edit (parameter ubah ada)
if (isset($_GET['ubah'])) { 
    $id_kendaraan = $_GET['ubah'];

    $query = "SELECT * FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    // Pastikan data ditemukan
    if ($result) {
        $id_kendaraan = $result['id_kendaraan'];
        $id_wajibpajak = $result['id_wajibpajak'];
        $nomor_STNK = $result['nomor_STNK'];
        $nomor_registrasi = $result['nomor_registrasi'];
        $nama_pemilik = $result['nama_pemilik'];
        $Alamat = $result['Alamat'];
        $merek = $result['merek'];
        $Tipe = $result['Tipe'];
        $Jenis = $result['Jenis'];
        $model = $result['model'];
        $tahun_pembuatan = $result['tahun_pembuatan'];
        $isi_silinder_daya_listrik = $result['isi_silinder_daya_listrik'];
        $nomor_rangka_VIN = $result['nomor_rangka_VIN'];
        $nomor_mesin = $result['nomor_mesin'];
        $NIK_TDO_KITAS_KITAP = $result['NIK_TDO_KITAS_KITAP'];
        $warna = $result['warna'];
        $bahan_bakar = $result['bahan_bakar'];
        $warna_TNKB = $result['warna_TNKB'];
        $tahun_registrasi = $result['tahun_registrasi'];
        $no_bpkb = $result['no_bpkb'];
        $no_urut_pendaftaran = $result['no_urut_pendaftaran'];
        $kode_lokasi = $result['kode_lokasi'];
        $berlaku_sampai = $result['berlaku_sampai'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Kendaraan</title>
    <link href="/ukl/src/style/output.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="shadow-lg bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h2 class="text-xl font-bold text-white">SAMSAT Management</h2>
                </div>
                <div class="text-white">
                    <span class="text-sm">Kelola Data Kendaraan</span>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Container -->
    <div class="max-w-4xl px-4 mx-auto my-8 sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white rounded-lg shadow-xl">
            <!-- Header -->
            <div class="px-6 py-8 bg-gradient-to-r from-indigo-600 to-purple-600 sm:px-8">
                <h1 class="text-2xl font-bold text-center text-white">
                    <?php echo isset($_GET['ubah']) ? 'Edit Data Kendaraan' : 'Tambah Data Kendaraan Baru'; ?>
                </h1>
            </div>
            
            <!-- Form -->
            <form method="POST" action="proseskendaraan.php" enctype="multipart/form-data" class="px-6 py-8 sm:px-8">
                <input type="hidden" value="<?php echo htmlspecialchars($id_kendaraan); ?>" name="id_kendaraan">
                
                <!-- ID Wajib Pajak -->
                <div class="mb-6">
                    <label for="id_wajibpajak" class="block mb-2 text-sm font-semibold text-gray-700">
                        ID Wajib Pajak
                    </label>
                    <input type="text" name="id_wajibpajak" id="id_wajibpajak" 
                           class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                           placeholder="Masukkan ID Wajib Pajak" 
                           value="<?php echo htmlspecialchars($id_wajibpajak); ?>">
                </div>
                
                <!-- Nama Pemilik & NIK -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="nama_pemilik" class="block mb-2 text-sm font-semibold text-gray-700">
                            Nama Pemilik <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_pemilik" id="nama_pemilik" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Nama Pemilik" 
                               value="<?php echo htmlspecialchars($nama_pemilik); ?>">
                    </div>
                    
                    <div>
                        <label for="NIK_TDO_KITAS_KITAP" class="block mb-2 text-sm font-semibold text-gray-700">
                            NIK/TDO/KITAS/KITAP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="NIK_TDO_KITAS_KITAP" id="NIK_TDO_KITAS_KITAP" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan NIK/TDO/KITAS/KITAP" 
                               value="<?php echo htmlspecialchars($NIK_TDO_KITAS_KITAP); ?>">
                    </div>
                </div>
                
                <!-- Alamat -->
                <div class="mb-6">
                    <label for="Alamat" class="block mb-2 text-sm font-semibold text-gray-700">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="Alamat" id="Alamat" required rows="3"
                           class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                           placeholder="Masukkan Alamat Lengkap"><?php echo htmlspecialchars($Alamat); ?></textarea>
                </div>
                
                <!-- Nomor STNK & Nomor Registrasi -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="nomor_STNK" class="block mb-2 text-sm font-semibold text-gray-700">
                            Nomor STNK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor_STNK" id="nomor_STNK" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Nomor STNK" 
                               value="<?php echo htmlspecialchars($nomor_STNK); ?>">
                    </div>
                    
                    <div>
                        <label for="nomor_registrasi" class="block mb-2 text-sm font-semibold text-gray-700">
                            Nomor Registrasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor_registrasi" id="nomor_registrasi" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Nomor Registrasi" 
                               value="<?php echo htmlspecialchars($nomor_registrasi); ?>">
                    </div>
                </div>
                
                <!-- Merek & Tipe -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="merek" class="block mb-2 text-sm font-semibold text-gray-700">
                            Merek <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="merek" id="merek" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Merek Kendaraan" 
                               value="<?php echo htmlspecialchars($merek); ?>">
                    </div>
                    
                    <div>
                        <label for="Tipe" class="block mb-2 text-sm font-semibold text-gray-700">
                            Tipe <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="Tipe" id="Tipe" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Tipe Kendaraan" 
                               value="<?php echo htmlspecialchars($Tipe); ?>">
                    </div>
                </div>
                
                <!-- Jenis & Model -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="Jenis" class="block mb-2 text-sm font-semibold text-gray-700">
                            Jenis <span class="text-red-500">*</span>
                        </label>
                        <select name="Jenis" id="Jenis" required
                                class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            <option value="">Pilih Jenis Kendaraan</option>
                            <option value="Mobil" <?php echo ($Jenis == 'Mobil') ? 'selected' : ''; ?>>Mobil</option>
                            <option value="Motor" <?php echo ($Jenis == 'Motor') ? 'selected' : ''; ?>>Motor</option>
                            <option value="Truck" <?php echo ($Jenis == 'Truck') ? 'selected' : ''; ?>>Truck</option>
                            <option value="Bus" <?php echo ($Jenis == 'Bus') ? 'selected' : ''; ?>>Bus</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="model" class="block mb-2 text-sm font-semibold text-gray-700">
                            Model
                        </label>
                        <input type="text" name="model" id="model"
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Model Kendaraan" 
                               value="<?php echo htmlspecialchars($model); ?>">
                    </div>
                </div>
                
                <!-- Tahun Pembuatan & Tahun Registrasi -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="tahun_pembuatan" class="block mb-2 text-sm font-semibold text-gray-700">
                            Tahun Pembuatan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="tahun_pembuatan" id="tahun_pembuatan" required
                               min="1900" max="<?php echo date('Y'); ?>"
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Tahun Pembuatan" 
                               value="<?php echo htmlspecialchars($tahun_pembuatan); ?>">
                    </div>
                    
                    <div>
                        <label for="tahun_registrasi" class="block mb-2 text-sm font-semibold text-gray-700">
                            Tahun Registrasi <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="tahun_registrasi" id="tahun_registrasi" required
                               min="1900" max="<?php echo date('Y'); ?>"
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Tahun Registrasi" 
                               value="<?php echo htmlspecialchars($tahun_registrasi); ?>">
                    </div>
                </div>
                
                <!-- Isi Silinder/Daya Listrik -->
                <div class="mb-6">
                    <label for="isi_silinder_daya_listrik" class="block mb-2 text-sm font-semibold text-gray-700">
                        Isi Silinder/Daya Listrik
                    </label>
                    <input type="text" name="isi_silinder_daya_listrik" id="isi_silinder_daya_listrik"
                           class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                           placeholder="Masukkan Isi Silinder atau Daya Listrik" 
                           value="<?php echo htmlspecialchars($isi_silinder_daya_listrik); ?>">
                </div>
                
                <!-- Nomor Rangka/VIN & Nomor Mesin -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="nomor_rangka_VIN" class="block mb-2 text-sm font-semibold text-gray-700">
                            Nomor Rangka/VIN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor_rangka_VIN" id="nomor_rangka_VIN" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Nomor Rangka/VIN" 
                               value="<?php echo htmlspecialchars($nomor_rangka_VIN); ?>">
                    </div>
                    
                    <div>
                        <label for="nomor_mesin" class="block mb-2 text-sm font-semibold text-gray-700">
                            Nomor Mesin <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor_mesin" id="nomor_mesin" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Nomor Mesin" 
                               value="<?php echo htmlspecialchars($nomor_mesin); ?>">
                    </div>
                </div>
                
                <!-- Warna & Bahan Bakar -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="warna" class="block mb-2 text-sm font-semibold text-gray-700">
                            Warna <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="warna" id="warna" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Warna Kendaraan" 
                               value="<?php echo htmlspecialchars($warna); ?>">
                    </div>
                    
                    <div>
                        <label for="bahan_bakar" class="block mb-2 text-sm font-semibold text-gray-700">
                            Bahan Bakar <span class="text-red-500">*</span>
                        </label>
                        <select name="bahan_bakar" id="bahan_bakar" required
                                class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            <option value="">Pilih Bahan Bakar</option>
                            <option value="Bensin" <?php echo ($bahan_bakar == 'Bensin') ? 'selected' : ''; ?>>Bensin</option>
                            <option value="Solar" <?php echo ($bahan_bakar == 'Solar') ? 'selected' : ''; ?>>Solar</option>
                            <option value="Listrik" <?php echo ($bahan_bakar == 'Listrik') ? 'selected' : ''; ?>>Listrik</option>
                            <option value="Hybrid" <?php echo ($bahan_bakar == 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
                            <option value="Gas" <?php echo ($bahan_bakar == 'Gas') ? 'selected' : ''; ?>>Gas</option>
                        </select>
                    </div>
                </div>
                
                <!-- Warna TNKB -->
                <div class="mb-6">
                    <label for="warna_TNKB" class="block mb-2 text-sm font-semibold text-gray-700">
                        Warna TNKB <span class="text-red-500">*</span>
                    </label>
                    <select name="warna_TNKB" id="warna_TNKB" required
                            class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <option value="">Pilih Warna TNKB</option>
                        <option value="Hitam" <?php echo ($warna_TNKB == 'Hitam') ? 'selected' : ''; ?>>Hitam (Pribadi)</option>
                        <option value="Kuning" <?php echo ($warna_TNKB == 'Kuning') ? 'selected' : ''; ?>>Kuning (Angkutan Umum)</option>
                        <option value="Merah" <?php echo ($warna_TNKB == 'Merah') ? 'selected' : ''; ?>>Merah (Pemerintah)</option>
                        <option value="Hijau" <?php echo ($warna_TNKB == 'Hijau') ? 'selected' : ''; ?>>Hijau (TNI/Polri)</option>
                    </select>
                </div>
                
                <!-- Nomor BPKB & Nomor Urut Pendaftaran -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="no_bpkb" class="block mb-2 text-sm font-semibold text-gray-700">
                            Nomor BPKB <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="no_bpkb" id="no_bpkb" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Nomor BPKB" 
                               value="<?php echo htmlspecialchars($no_bpkb); ?>">
                    </div>
                    
                    <div>
                        <label for="no_urut_pendaftaran" class="block mb-2 text-sm font-semibold text-gray-700">
                            Nomor Urut Pendaftaran
                        </label>
                        <input type="text" name="no_urut_pendaftaran" id="no_urut_pendaftaran"
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Nomor Urut Pendaftaran" 
                               value="<?php echo htmlspecialchars($no_urut_pendaftaran); ?>">
                    </div>
                </div>
                
                <!-- Kode Lokasi & Berlaku Sampai -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="kode_lokasi" class="block mb-2 text-sm font-semibold text-gray-700">
                            Kode Lokasi
                        </label>
                        <input type="text" name="kode_lokasi" id="kode_lokasi"
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               placeholder="Masukkan Kode Lokasi" 
                               value="<?php echo htmlspecialchars($kode_lokasi); ?>">
                    </div>
                    
                    <div>
                        <label for="berlaku_sampai" class="block mb-2 text-sm font-semibold text-gray-700">
                            Berlaku Sampai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="berlaku_sampai" id="berlaku_sampai" required
                               class="w-full px-4 py-3 transition-colors duration-200 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" 
                               value="<?php echo htmlspecialchars($berlaku_sampai); ?>">
                    </div>
                </div>
                
                <!-- Buttons -->
                <div class="flex flex-col justify-center gap-4 pt-6 border-t border-gray-200 sm:flex-row">
                    <?php if (isset($_GET['ubah'])): ?>
                        <button type="submit" name="aksi" value="edit" 
                                class="px-8 py-3 font-semibold text-white transition-colors duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <i class="mr-2 fas fa-save"></i>Simpan Perubahan
                        </button>
                    <?php else: ?>
                        <button type="submit" name="aksi" value="add" 
                                class="px-8 py-3 font-semibold text-white transition-colors duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <i class="mr-2 fas fa-plus"></i>Tambah Data
                        </button>
                    <?php endif; ?>
                    
                    <a href="kendaraan.php" 
                       class="px-8 py-3 font-semibold text-center text-white transition-colors duration-200 bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <i class="mr-2 fas fa-times"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>