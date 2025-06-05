<!DOCTYPE html>
<?php
include 'koneksi.php'; 
             $id_petugas = '';
             $nama_petugas = '';
             $posisi = '';
             $kantor_samsat = '';

            if (isset($_GET['ubah'])){ 
                $id_petugas = $_GET['ubah'];

                $query = "SELECT * FROM petugassamsat WHERE id_petugas = '$id_petugas';";
                $sql = mysqli_query($conn, $query);
                $result = mysqli_fetch_assoc($sql);

                $nama_petugas = $result['nama_petugas'];
                $posisi = $result['posisi'];
                $kantor_samsat =$result ['kantor_samsat'];
                            
                //var_dump($result);    
                //die();
                        }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/ukl/src/style/output.css">
    <title>petugassamsat</title>
</head>
<body class="max-w-md p-6 mx-auto mt-10 text-center bg-white shadow-md rounded-2xl">
    <nav class="p-8 bg-white">
        <div class="container mx-auto">
          <a class="text-3xl font-bold text-gray-800">
            CRUD
          </a>
        </div>
      </nav>
      <div class="container p-6 mx-auto">
       
      <form method="POST" action="proses.php" enctype="multipart/form-data">
        <div class="page-header">
            <input type="hidden" value="<?php echo $id_petugas ?>" name="id_petugas">
            
            <div class="mb-3 row">    
            <label for="Nama"  class="col-sm-2 col-form-label">
                    Nama
                </label>
                <div class="col-sm-10">
                <input required type="text" name="nama_petugas" class="form-control" id="Nama" placeholder="Contoh: Yanto" value="<?php echo $nama_petugas ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="posisi" class="col-sm-2 col-form-label">
                    Posisi
                </label>
                <div class="col-sm-10">
                <input required type="text" name="posisi" class="form-control" id="Posisi" placeholder="Contoh: Manajer" value="<?php echo $posisi ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kantor_samsat"  class="col-sm-2 col-form-label">
                    Kantor
                </label>
                <div class="col-sm-10">
                <input required type="text" name= "kantor_samsat" class="form-control" id="Kantor" placeholder="Contoh: Sepanjang" value="<?php echo $kantor_samsat ?>">
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="foto"  class="col-sm-2 col-form-label">
                    Foto
                </label>
                <div class="col-sm-10">
                
                <input <?php if (!isset($_GET['ubah'])){ echo "required";} ?>  class="form-control" name="foto" type="file" id="foto" accept="image/*">
                </div>
            </div>
            <div class="mt-5 mb-3 row">
                    <div class="col">
                        <?php
                        if (isset($_GET['ubah'])){ 
                        ?>
                        <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Simpan Perubahan 
                        </button>
                        <?php
                        } else {
                        ?>
                        <button type="submit" name="aksi" value="add" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Tambahkan
                        </button>
                        <?php
                        }
                        ?>
                        <a href="petugas.php" type="button" class="btn btn-danger">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div> 
</body>
</html>