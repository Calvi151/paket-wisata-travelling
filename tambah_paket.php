<?php
$con = mysqli_connect("localhost", "root", "", "dbs_travell") or die("Connection error");

if(isset($_POST['submit'])){
    $paket_id = $_POST['paket_id'];
    $nama_paket = $_POST['nama_paket'];
    $tujuan = $_POST['tujuan'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $durasi = $_POST['durasi'];
    
  $foto = "";
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        $foto = time() . "_" . basename($_FILES['foto']['name']); // rename biar unik
        $target = "uploads/" . $foto; // buat folder 'uploads' di projectx/
        
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $target)){
            // berhasil upload
        } else {
            echo "Gagal upload foto.";
        }
    }
    
$query = mysqli_query($con, "INSERT INTO paket_wisata (paket_id, nama_paket, tujuan, deskripsi, harga, durasi, foto) 
VALUES ('$paket_id', '$nama_paket', '$tujuan', '$deskripsi', '$harga', '$durasi', '$foto')");

if($query){
    echo "<script>alert('Paket travel berhasil ditambahkan'); window.location='admin_dashboard.php';</script>";
} else {
    echo "Error: " . mysqli_error($con);
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket</title>
</head>
<body>
    <table border="1">
        <form action="" method="post" enctype="multipart/form-data">
            <tr>
                <td>Paket ID</td>
                <td><input type="text" name="paket_id" required></td>
            </tr>
            <tr>
                <td>Nama Paket</td>
                <td><input type="text" name="nama_paket" required></td>
            </tr>
            <tr>
                <td>Tujuan</td>
                <td><input type="text" name="tujuan" required></td>
            </tr>
            <tr>
                <td>Deksripsi</td>
                <td><input type="text" name="deskripsi" required></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="number" name="harga" required></td>
            </tr>
            <tr>
                <td>Durasi</td>
                <td><input type="text" name="durasi" required></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto" accept="image/*"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Tambah Paket"></td>
            </tr>

            <button type="button" onclick="window.location.href='admin_dashboard.php'">Kembali
                submit
            </button>
        </form>
    </table>
</body>
</html>