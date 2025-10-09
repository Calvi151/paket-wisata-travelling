<?php
session_start();
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Koneksi gagal");



$username = $_SESSION['username'];
$query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi User</title>
    <link rel="stylesheet" href="../styles/stylu.css">
</head>
<body>
    <div class="container">
        <h2>Informasi Akun</h2>
        <div class="info-card">
            <div class="info-item">
                <label>Username:</label>
                <p><?php echo $user['username']; ?></p>
            </div>
            <div class="info-item">
                <label>Nama Lengkap:</label>
                <p><?php echo $user['nama']; ?></p>
            </div>
            <div class="info-item">
                <label>Email:</label>
                <p><?php echo $user['email']; ?></p>
            </div>
            <div class="info-item">
                <label>No HP:</label>
                <p><?php echo $user['no_hp']; ?></p>
            </div>
            <div class="info-item">
                <label>Alamat:</label>
                <p><?php echo $user['alamat']; ?></p>
            </div>
        </div>
        <a href="user_dashboard.php" class="btn-back">Kembali ke Dashboard</a>
    </div>

    <footer>
        <p>&copy; 2025 Travell. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
