<?php 
require 'koneksi.php';
// ambil data di url
$id = $_GET["id"];
// query data berdasarkan id
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $id");
// if( !$result ) {
//     echo mysqli_error($conn);
// }
$rows = [];
while($row = mysqli_fetch_assoc($pelanggan)) {
    $rows[] = $row;
}

// cek apakah tombol submit sudah di tekan atau belum
if(isset($_POST["submit"]) ) {
    $id = $_POST["id"];
    $nama = htmlspecialchars($_POST["nama"]);
    $jenis_kelamin = htmlspecialchars($_POST["jenis_kelamin"]);
    $telpon = htmlspecialchars($_POST["telpon"]);
    $alamat = htmlspecialchars($_POST["alamat"]); // ambil semua data di dalam form

    // Masukan ke dalam database
    $query = "UPDATE pelanggan SET 
                    nama = '$nama',
                    jenis_kelamin = '$jenis_kelamin',
                    telpon = '$telpon',
                    alamat = '$alamat'
                    WHERE id = $id";
        mysqli_query($conn, $query);

    if( mysqli_affected_rows($conn) > 0 ) {
        echo "<script>
                alert('data berhasil di ubah!');
                document.location.href='index.php';
             </script>";
    } else {
        // echo "<script>
        //         alert('data gagal di tambahkan!');
        //         document.location.href='index.php';
        //      </script>";
        echo "gagal";
        echo mysqli_error($conn);
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Form Ubah Data Pelanggan</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Department Stores</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Pelanggan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="penjualan.php">Penjualan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="produk.php">Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="supplier.php">Supplier</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h3>Form Ubah Data Pelanggan</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                <table class="table-bordered" width="100%" cellpadding="10">
                    <?php foreach($rows as $row) : ?>
                    <input type="hidden" name="id" value="<?= $row["id"]; ?>">
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" class="form-control" value="<?= $row["nama"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="<?= $row["jenis_kelamin"]; ?>" selected="selected"><?= $row["jenis_kelamin"]; ?></option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Telpon</td>
                        <td><input type="text" name="telpon" class="form-control" value="<?= $row["telpon"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><input type="text" name="alamat" class="form-control" value="<?= $row["alamat"]; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="form-control btn-primary" name="submit">Simpan Data</button></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>