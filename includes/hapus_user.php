<?php
$con = mysqli_connect("localhost", "root", "", "dbs_travell") or die("Koneksi gagal");

if (!isset($_GET['username'])) {
    die("Username tidak ditemukan.");
}

$username = $_GET['username'];

// Pastikan user yang dihapus bukan admin
$cek = mysqli_query($con, "SELECT * FROM user WHERE username='$username' AND role='user'");
if (mysqli_num_rows($cek) == 0) {
    echo "<script>alert('User tidak ditemukan atau tidak bisa dihapus!');window.location='manage_user.php';</script>";
    exit;
}

// Hapus user
$query = mysqli_query($con, "DELETE FROM user WHERE username='$username'");

if ($query) {
    echo "<script>alert('User berhasil dihapus');window.location='manage_user.php';</script>";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
