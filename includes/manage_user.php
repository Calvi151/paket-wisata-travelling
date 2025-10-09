<?php
session_start();
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Koneksi gagal");



// Ambil data semua user
$users = mysqli_query($con, "SELECT * FROM users WHERE role='user'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User - Travell</title>
    <link rel="stylesheet" href="../styles/styling.css">
</head>
<body>
    <div class="container">
        <h2>Manajemen Data User</h2>
        <div class="top-bar">
            <a href="tambah_user.php" class="btn btn-add">+ Tambah User</a>
            <a href="logout.php" class="logout">Keluar</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($u = mysqli_fetch_assoc($users)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $u['username']; ?></td>
                        <td><?= $u['nama']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><?= $u['no_hp']; ?></td>
                        <td><?= $u['alamat']; ?></td>
                        <td><?= $u['role']; ?></td>
                        <td>
                            <a href="edit_user.php?username=<?= $u['username']; ?>" class="btn btn-edit">Edit</a>
                            <a href="hapus_user.php?username=<?= $u['username']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
