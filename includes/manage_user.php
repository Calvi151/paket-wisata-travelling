<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "dbs_travell") or die("Koneksi gagal");

// Pastikan hanya user yang bisa masuk
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE username='$username'"));
$paket = mysqli_query($con, "SELECT * FROM paket_wisata");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Travell</title>
    <link rel="stylesheet" href="../styles/sty">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Selamat Datang, <?= $user['nama']; ?> 👋</h2>
            <a href="logout.php" class="logout">Keluar</a>
        </div>
        
        <div class="profile">
            <div class="profile-header">
                <h3>Informasi Profil</h3>
            </div>
            <div class="profile-info">
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?= $user['email']; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">No. HP</span>
                    <span class="info-value"><?= $user['no_hp']; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Alamat</span>
                    <span class="info-value"><?= $user['alamat']; ?></span>
                </div>
            </div>
        </div>
        
        <h3 class="section-title">Daftar Paket Wisata</h3>
        <div class="paket">
            <?php while ($p = mysqli_fetch_assoc($paket)) { ?>
                <div class="card">
                    <img src="../uploads/<?= $p['foto']; ?>" alt="<?= $p['nama_paket']; ?>" class="card-img">
                    <div class="card-content">
                        <h4 class="card-title"><?= $p['nama_paket']; ?></h4>
                        <div class="card-destination"><?= $p['tujuan']; ?></div>
                        <p class="card-description"><?= $p['deskripsi']; ?></p>
                        <div class="card-footer">
                            <span class="card-price">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></span>
                            <span class="card-duration"><?= $p['durasi']; ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>