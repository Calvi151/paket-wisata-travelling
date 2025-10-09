<?php
session_start();
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Koneksi gagal");



// Ambil semua data pesanan (join ke tabel users dan paket_wisata)
$query = mysqli_query($con, "
    SELECT p.id_pesanan, p.username, u.nama, pw.nama_paket, pw.tujuan, p.jumlah_orang, 
           p.total_harga, p.status, p.tanggal_pesan
    FROM pesanan p
    JOIN users u ON p.username = u.username
    JOIN paket_wisata pw ON p.paket_id = pw.paket_id
    ORDER BY p.id_pesanan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan - Admin</title>
    <link rel="stylesheet" href="../styles/report.css">
</head>
<body>
    <div class="container">
        <h2>Laporan Pesanan</h2>
        <p class="subtitle">Semua transaksi yang dilakukan oleh user</p>

        <table>
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Username</th>
                    <th>Nama User</th>
                    <th>Nama Paket</th>
                    <th>Tujuan</th>
                    <th>Jumlah Orang</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal Pesan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= $row['id_pesanan']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nama_paket']; ?></td>
                    <td><?= $row['tujuan']; ?></td>
                    <td><?= $row['jumlah_orang']; ?></td>
                    <td>Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td>
                        <span class="status <?= strtolower($row['status']); ?>">
                            <?= ucfirst($row['status']); ?>
                        </span>
                    </td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_pesan'])); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

   
</body>
</html>
