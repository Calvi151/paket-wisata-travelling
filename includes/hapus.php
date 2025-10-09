<?php
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Koneksi gagal");

if (isset($_GET['paket_id'])) {
    $id = $_GET['paket_id'];

    // Ambil data paket untuk tahu nama file fotonya
    $result = mysqli_query($con, "SELECT foto FROM paket_wisata WHERE paket_id='$id'");
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        // Hapus file foto di folder uploads jika ada
        if (!empty($data['foto']) && file_exists("../uploads/" . $data['foto'])) {
            unlink("../uploads/" . $data['foto']);
        }

        // Hapus data dari database
        $delete = mysqli_query($con, "DELETE FROM paket_wisata WHERE paket_id='$id'");

        if ($delete) {
            echo "<script>alert('Paket wisata berhasil dihapus');window.location='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus paket wisata: " . mysqli_error($con) . "');window.location='admin_dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Data paket tidak ditemukan');window.location='admin_dashboard.php';</script>";
    }
} else {
    echo "<script>alert('ID paket tidak ditemukan');window.location='admin_dashboard.php';</script>";
}
?>
