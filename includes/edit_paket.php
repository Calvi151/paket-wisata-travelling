<?php
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Koneksi gagal");

$id = $_GET['paket_id']; 
$data = mysqli_query($con, "SELECT * FROM paket_wisata WHERE paket_id='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Paket tidak ditemukan.");
}

if (!file_exists("../uploads")) {
    mkdir("../uploads", 0777, true);
}

if (isset($_POST['update'])) {
    $nama_paket = $_POST['nama_paket'];
    $tujuan = $_POST['tujuan'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $durasi = $_POST['durasi'];

    $foto = $row['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = time() . "_" . basename($_FILES['foto']['name']);
        $target = "../uploads/" . $foto;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            if (!empty($row['foto']) && file_exists("../uploads/" . $row['foto'])) {
                unlink("../uploads/" . $row['foto']);
            }
        } else {
            echo "<script>alert('Gagal upload foto baru');</script>";
        }
    }

    $update = mysqli_query($con, "UPDATE paket_wisata SET 
        nama_paket='$nama_paket',
        tujuan='$tujuan',
        deskripsi='$deskripsi',
        harga='$harga',
        durasi='$durasi',
        foto='$foto'
        WHERE paket_id='$id'");

    if ($update) {
        echo "<script>alert('Paket berhasil diperbarui');window.location='admin_dashboard.php';</script>";
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
    <title>Edit Paket Wisata</title>
    <link rel="stylesheet" href="../styles/stylep.css">
</head>
<body>

    <div class="container">
        <h2>Edit Paket Wisata</h2>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID Paket</td>
                    <td><input type="text" name="paket_id" value="<?= $row['paket_id'] ?>" readonly></td>
                </tr>
                <tr>
                    <td>Nama Paket</td>
                    <td><input type="text" name="nama_paket" value="<?= $row['nama_paket'] ?>" required></td>
                </tr>
                <tr>
                    <td>Tujuan</td>
                    <td><input type="text" name="tujuan" value="<?= $row['tujuan'] ?>" required></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><textarea name="deskripsi" required><?= $row['deskripsi'] ?></textarea></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="number" name="harga" value="<?= $row['harga'] ?>" required></td>
                </tr>
                <tr>
                    <td>Durasi (hari)</td>
                    <td><input type="text" name="durasi" value="<?= $row['durasi'] ?>" required></td>
                </tr>
                <tr>
                    <td>Foto Lama</td>
                    <td>
                        <?php if (!empty($row['foto'])): ?>
                            <img src="../uploads/<?= $row['foto'] ?>" width="150" alt="Foto Paket"><br>
                        <?php else: ?>
                            <p style="color:#777;">Tidak ada foto</p>
                        <?php endif; ?>
                        <input type="file" name="foto" accept="image/*">
                    </td>
                </tr>
            </table>

            <div class="form-footer">
                <input type="submit" name="update" value="Update Paket" class="btn-primary">
                <button type="button" class="btn-secondary" onclick="window.location.href='admin_dashboard.php'">Kembali</button>
            </div>
        </form>
    </div>

</body>
</html>
