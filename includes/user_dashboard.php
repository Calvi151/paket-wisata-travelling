<?php
session_start();
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Koneksi gagal");



$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE username='$username'"));
$rekomen = mysqli_query($con, "SELECT * FROM paket_wisata ORDER BY paket_id DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Travell</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<div class="dashboard"> 
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">TRAVELL</div>
        <div class="user-panel">
            <div class="avatar"></div>
            <p class="username"><?= htmlspecialchars($user['nama']); ?></p>
            <p class="user-email"><?= htmlspecialchars($user['email']); ?></p>
        </div>
        <ul class="menu">
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="transaksi.php">Paket Wisata</a></li>
        </ul>
        <a href="logout.php" class="logout">Logout</a>
    </aside>

    <!-- Main Content -->
    <main class="main">
         <header class="header">
        Halo <?php echo $user['nama']?>
    </header>   
        <header class="topbar">
            <input type="text" class="search" placeholder="Cari sesuatu...">
        </header>

        <section class="content">
            <h2>Paket Wisata Rekomendasi</h2>
            <div class="paket-container">
                <?php while ($p = mysqli_fetch_assoc($rekomen)) { ?>
                    <div class="paket-card">
                        <div class="img-box">
                            <img src="../uploads/<?= htmlspecialchars($p['foto']); ?>" alt="<?= htmlspecialchars($p['nama_paket']); ?>">
                        </div>
                        <div class="paket-content">
                            <h4><?= htmlspecialchars($p['nama_paket']); ?></h4>
                            <p class="tujuan"><?= htmlspecialchars($p['tujuan']); ?></p>
                            <p class="deskripsi"><?= htmlspecialchars($p['deskripsi']); ?></p>
                            <div class="card-footer">
                                <span class="harga">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></span>
                                <span class="durasi"><?= htmlspecialchars($p['durasi']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
</div>
</body>
</html>
