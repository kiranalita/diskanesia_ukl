<!DOCTYPE html>
<?php
include '../../koneksi.php';

// Variabel untuk menyimpan data yang akan diedit
$id_pajak = '';
$id_kendaraan = '';
$nomor_pajak = '';
$tanggal_penetapan = '';
$jatuh_tempo = '';
$jumlah_pajak = '';
$denda = '';
$status_pajak = '';

// Mengecek apakah ada parameter ubah
if (isset($_GET['ubah'])) {
    $id_pajak = $_GET['ubah'];
    
    // Query untuk mengambil data pajak beserta data kendaraan
    $query = "SELECT d.*, k.nomor_registrasi as plat_kendaraan 
              FROM kendaraan d 
              LEFT JOIN kendaraan k ON d.id_kendaraan = k.id_kendaraan 
              WHERE d.id_pajak = '$id_pajak'";
    
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);
    
    if ($result) {
        $id_kendaraan = $result['id_kendaraan'];
        $nomor_pajak = $result['nomor_pajak'];
        $tanggal_penetapan = $result['tanggal_penetapan'];
        $jatuh_tempo = $result['jatuh_tempo'];
        $jumlah_pajak = $result['jumlah_pajak'];
        $denda = $result['denda'];
        $status_pajak = $result['status_pajak'];
    }
}

// Query untuk mengambil data kendaraan dengan informasi lengkap
$query_kendaraan = "SELECT id_kendaraan, nomor_registrasi, merek, model, tipe 
                    FROM kendaraan 
                    ORDER BY nomor_registrasi ASC";
$sql_kendaraan = mysqli_query($conn, $query_kendaraan);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ukl/src/style/output.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Kelola Data Denda</title>
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
            <a href="../petugas/petugas.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
                Data Petugas
            </a>
            <a href="../pajak/pajak.php" class="px-4 py-2 font-medium text-black transition-colors border border-gray-400 rounded-md bg-sky-400 hover:bg-slate-600 hover:text-white">
                Data Denda
            </a>
        </nav>
    </div>

    <!-- Header -->
    <nav class="p-8 bg-white">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold text-gray-800">CRUD</h1>
        </div>
    </nav>

    <!-- Content -->
    <div class="container p-6 mx-auto">
        <div class="max-w-2xl p-6 mx-auto mt-10 bg-white shadow-md rounded-2xl">
            
            <form method="POST" action="prosespajak.php">
                <!-- Hidden field untuk ID saat edit -->
                <input type="hidden" value="<?php echo $id_pajak ?>" name="id_pajak">
                
                <!-- Pilih Kendaraan -->
                <div class="mb-6">
                    <label for="id_kendaraan" class="block mb-2 text-sm font-medium text-gray-700">
                        Kendaraan <span class="text-red-500">*</span>
                    </label>
                    <select required name="id_kendaraan" id="id_kendaraan" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Kendaraan --</option>
                        <?php 
                        // Reset pointer untuk kendaraan
                        mysqli_data_seek($sql_kendaraan, 0);
                        while ($kendaraan = mysqli_fetch_assoc($sql_kendaraan)): ?>
                            <option value="<?php echo $kendaraan['id_kendaraan']; ?>" 
                                    <?php echo ($kendaraan['id_kendaraan'] == $id_kendaraan) ? 'selected' : ''; ?>
                                    data-plat="<?php echo htmlspecialchars($kendaraan['nomor_registrasi']); ?>"
                                    data-merek="<?php echo htmlspecialchars($kendaraan['merek']); ?>"
                                    data-model="<?php echo htmlspecialchars($kendaraan['model']); ?>"
                                    data-tipe="<?php echo htmlspecialchars($kendaraan['tipe']); ?>">
                                <?php echo htmlspecialchars($kendaraan['nomor_registrasi'] . ' - ' . $kendaraan['merek'] . ' ' . $kendaraan['model']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <small class="text-gray-500">Pilih kendaraan berdasarkan plat nomor dan merek</small>
                </div>

                <!-- Info Kendaraan Terpilih -->
                <div id="info-kendaraan" class="hidden mb-6">
                    <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                        <h4 class="mb-2 font-semibold text-blue-800">Informasi Kendaraan</h4>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div><strong>Plat Nomor:</strong> <span id="info-plat">-</span></div>
                            <div><strong>Merek:</strong> <span id="info-merek">-</span></div>
                            <div><strong>Model:</strong> <span id="info-model">-</span></div>
                            <div><strong>Tipe:</strong> <span id="info-tipe">-</span></div>
                        </div>
                    </div>
                </div>

                <!-- Nomor Pajak -->
                <div class="mb-6">
                    <label for="nomor_pajak" class="block mb-2 text-sm font-medium text-gray-700">
                        Nomor Pajak <span class="text-red-500">*</span>
                    </label>
                    <input required type="text" name="nomor_pajak" id="nomor_pajak" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           placeholder="Contoh: PJK001" 
                           value="<?php echo $nomor_pajak ?>">
                </div>

                <!-- Tanggal Penetapan -->
                <div class="mb-6">
                    <label for="tanggal_penetapan" class="block mb-2 text-sm font-medium text-gray-700">
                        Tanggal Penetapan <span class="text-red-500">*</span>
                    </label>
                    <input required type="date" name="tanggal_penetapan" id="tanggal_penetapan" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           value="<?php echo $tanggal_penetapan ?>">
                </div>

                <!-- Jatuh Tempo -->
                <div class="mb-6">
                    <label for="jatuh_tempo" class="block mb-2 text-sm font-medium text-gray-700">
                        Jatuh Tempo <span class="text-red-500">*</span>
                    </label>
                    <input required type="date" name="jatuh_tempo" id="jatuh_tempo" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           value="<?php echo $jatuh_tempo ?>">
                </div>

                <!-- Jumlah Pajak -->
                <div class="mb-6">
                    <label for="jumlah_pajak" class="block mb-2 text-sm font-medium text-gray-700">
                        Jumlah Pajak (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input required type="number" name="jumlah_pajak" id="jumlah_pajak" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           placeholder="Contoh: 500000" 
                           step="0.01" min="0"
                           value="<?php echo $jumlah_pajak ?>">
                </div>

                <!-- Denda -->
                <div class="mb-6">
                    <label for="denda" class="block mb-2 text-sm font-medium text-gray-700">
                        Denda (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input required type="number" name="denda" id="denda" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           placeholder="Contoh: 50000" 
                           step="0.01" min="0"
                           value="<?php echo $denda ?>">
                </div>

                <!-- Status Pajak -->
                <div class="mb-6">
                    <label for="status_pajak" class="block mb-2 text-sm font-medium text-gray-700">
                        Status Pajak <span class="text-red-500">*</span>
                    </label>
                    <select required name="status_pajak" id="status_pajak" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Lunas" <?php echo ($status_pajak == 'Belum Lunas') ? 'selected' : ''; ?>>Belum Lunas</option>
                        <option value="Lunas" <?php echo ($status_pajak == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-8 text-center">
                    <?php if (isset($_GET['ubah'])): ?>
                        <button type="submit" name="aksi" value="edit" 
                                class="px-6 py-2 mr-3 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fa fa-save" aria-hidden="true"></i>
                            Simpan Perubahan
                        </button>
                    <?php else: ?>
                        <button type="submit" name="aksi" value="add" 
                                class="px-6 py-2 mr-3 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Tambahkan
                        </button>
                    <?php endif; ?>
                    
                    <a href="pajak.php" 
                       class="px-6 py-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan info kendaraan yang dipilih
        document.getElementById('id_kendaraan').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const infoDiv = document.getElementById('info-kendaraan');
            
            if (this.value) {
                // Ambil data dari atribut option
                const plat = selectedOption.getAttribute('data-plat');
                const merek = selectedOption.getAttribute('data-merek');
                const model = selectedOption.getAttribute('data-model');
                const tipe = selectedOption.getAttribute('data-tipe');
                
                // Update info kendaraan
                document.getElementById('info-plat').textContent = plat || '-';
                document.getElementById('info-merek').textContent = merek || '-';
                document.getElementById('info-model').textContent = model || '-';
                document.getElementById('info-tipe').textContent = tipe || '-';
                
                // Tampilkan info box
                infoDiv.classList.remove('hidden');
            } else {
                // Sembunyikan info box jika tidak ada yang dipilih
                infoDiv.classList.add('hidden');
            }
        });

        // Jalankan saat halaman dimuat (untuk mode edit)
        document.addEventListener('DOMContentLoaded', function() {
            const kendaraanSelect = document.getElementById('id_kendaraan');
            if (kendaraanSelect.value) {
                kendaraanSelect.dispatchEvent(new Event('change'));
            }
        });

        // Auto-format angka pada input
        document.getElementById('jumlah_pajak').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            e.target.value = value;
        });

        document.getElementById('denda').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            e.target.value = value;
        });

        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const jumlahPajak = parseFloat(document.getElementById('jumlah_pajak').value);
            const denda = parseFloat(document.getElementById('denda').value);

            if (jumlahPajak < 0 || denda < 0) {
                alert('Jumlah pajak dan denda tidak boleh negatif!');
                e.preventDefault();
                return false;
            }

            // Validasi tanggal
            const tanggalPenetapan = new Date(document.getElementById('tanggal_penetapan').value);
            const jatuhTempo = new Date(document.getElementById('jatuh_tempo').value);

            if (jatuhTempo <= tanggalPenetapan) {
                alert('Tanggal jatuh tempo harus lebih besar dari tanggal penetapan!');
                e.preventDefault();
                return false;
            }

            // Konfirmasi sebelum submit
            const konfirmasi = confirm('Apakah Anda yakin ingin menyimpan data ini?');
            if (!konfirmasi) {
                e.preventDefault();
                return false;
            }
        });
    </script>

</body>
</html>