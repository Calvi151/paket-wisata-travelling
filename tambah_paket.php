<?php
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Connection error");

if (isset($_POST['submit'])) {
    $paket_id = $_POST['paket_id'];
    $nama_paket = $_POST['nama_paket'];
    $tujuan = $_POST['tujuan'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $durasi = $_POST['durasi'];

    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = time() . "_" . basename($_FILES['foto']['name']);
        $target = "../uploads/" . $foto;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            echo "<script>alert('Gagal upload foto.');</script>";
        }
    }

    $query = mysqli_query($con, "INSERT INTO paket_wisata (paket_id, nama_paket, tujuan, deskripsi, harga, durasi, foto)
    VALUES ('$paket_id', '$nama_paket', '$tujuan', '$deskripsi', '$harga', '$durasi', '$foto')");

    if ($query) {
        echo "<script>alert('Paket travel berhasil ditambahkan'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Wisata</title>
    <link rel="stylesheet" href="./styles/tambah.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Paket Wisata</h2>
        <form action="" method="post" enctype="multipart/form-data" class="form-paket">
            <div class="form-group">
                <label for="paket_id">Paket ID</label>
                <input type="text" name="paket_id" id="paket_id" required>
            </div>

            <div class="form-group">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" required>
            </div>

            <div class="form-group">
                <label for="tujuan">Tujuan</label>
                <input type="text" name="tujuan" id="tujuan" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" required>
            </div>

            <div class="form-group">
                <label for="durasi">Durasi</label>
                <input type="text" name="durasi" id="durasi" required>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*">
            </div>

            <div class="form-buttons">
                <input type="submit" name="submit" value="Tambah Paket" class="btn-submit">
                <button type="button" class="btn-back" onclick="window.location.href='admin_dashboard.php'">Kembali</button>
            </div>
        </form>
    </div>
</body>
</html>
