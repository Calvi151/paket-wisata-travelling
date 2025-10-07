<?php
$con = mysqli_connect("localhost", "root", "", "dbs_travell") or die("Koneksi gagal");

$username = $_GET['username']; // username dikirim dari halaman manage_user
$data = mysqli_query($con, "SELECT * FROM user WHERE username='$username' AND role='user'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("User tidak ditemukan.");
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];

    // Jika password tidak kosong, ubah password juga
    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $update = mysqli_query($con, "UPDATE user SET 
            nama='$nama',
            email='$email',
            no_hp='$no_hp',
            alamat='$alamat',
            password='$hashed'
            WHERE username='$username'");
    } else {
        $update = mysqli_query($con, "UPDATE user SET 
            nama='$nama',
            email='$email',
            no_hp='$no_hp',
            alamat='$alamat'
            WHERE username='$username'");
    }

    if ($update) {
        echo "<script>alert('Data user berhasil diperbarui');window.location='manage_user.php';</script>";
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
    <title>Edit Data User</title>
</head>
<body>
    <h2>Edit Data User</h2>
    <form method="post">
        <table border="1" cellpadding="5">
            <tr><td>Username</td><td><input type="text" name="username" value="<?= $row['username'] ?>" readonly></td></tr>
            <tr><td>Nama Lengkap</td><td><input type="text" name="nama" value="<?= $row['nama'] ?>" required></td></tr>
            <tr><td>Email</td><td><input type="email" name="email" value="<?= $row['email'] ?>" required></td></tr>
            <tr><td>No HP</td><td><input type="text" name="no_hp" value="<?= $row['no_hp'] ?>" required></td></tr>
            <tr><td>Alamat</td><td><textarea name="alamat" required><?= $row['alamat'] ?></textarea></td></tr>
            <tr><td>Password Baru</td><td><input type="password" name="password" placeholder="Kosongkan jika tidak ubah"></td></tr>
            <tr><td>Role</td><td><input type="text" name="role" value="<?= $row['role'] ?>" readonly></td></tr>
            <tr><td colspan="2" align="center">
                <input type="submit" name="update" value="Update User">
                <button type="button" onclick="window.location.href='manage_user.php'">Kembali</button>
            </td></tr>
        </table>
    </form>
</body>
</html>
