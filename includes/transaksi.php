<?php
session_start();
$con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("Koneksi gagal");



// Jika ada request pesan (via AJAX)
if (isset($_POST['action']) && $_POST['action'] == 'pesan') {
    $username = $_SESSION['username'];
    $paket_id = $_POST['paket_id'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $total_harga = $_POST['total_harga'];

    $query = "INSERT INTO pesanan (username, paket_id, jumlah_orang, total_harga, status, tanggal_pesan)
              VALUES ('$username', '$paket_id', '$jumlah_orang', '$total_harga', 'pending', NOW())";

    if (mysqli_query($con, $query)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($con);
}
exit;
}

// Ambil semua paket wisata
$paket = mysqli_query($con, "SELECT * FROM paket_wisata ORDER BY paket_id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Wisata</title>
    <link rel="stylesheet" href="../styles/stylet.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
    <h1>Paket Wisata</h1>
    <p class="subtitle">Temukan destinasi terbaik dan pesan perjalanan impianmu.</p>

    <div class="paket-container">
        <?php while ($p = mysqli_fetch_assoc($paket)) { ?>
        <div class="card">
            <img src="../uploads/<?= $p['foto']; ?>" alt="<?= $p['nama_paket']; ?>">
            <div class="card-body">
                <h3><?= $p['nama_paket']; ?></h3>
                <p class="tujuan"><?= $p['tujuan']; ?></p>
                <p class="deskripsi"><?= $p['deskripsi']; ?></p>
                <div class="card-footer">
                    <span class="harga">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></span>
                    <span class="durasi"><?= $p['durasi']; ?></span>
                </div>
                <button class="btn-pesan" onclick="pesanPaket(<?= $p['paket_id']; ?>, '<?= $p['nama_paket']; ?>', <?= $p['harga']; ?>)">
                    Pesan Sekarang
                </button>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<footer>
    <p>&copy; <?= date('Y'); ?> Travell. Semua Hak Dilindungi.</p>
    <div class="footer-links">
        <a href="#">Tentang Kami</a>
        <a href="#">Kontak</a>
        <a href="#">Kebijakan Privasi</a>
    </div>
</footer>

<script>
function pesanPaket(id, namaPaket, harga) {
    Swal.fire({
        title: 'Konfirmasi Pesanan',
        html: `
            <b>${namaPaket}</b><br>
            <span style="color:#27ae60;">Harga per orang: Rp ${harga.toLocaleString()}</span><br><br>
            <label>Jumlah Orang:</label><br>
            <input type="number" id="jumlah" min="1" value="1" class="swal2-input" placeholder="Masukkan jumlah orang">
        `,
        confirmButtonText: 'Pesan Sekarang',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#2e86de'
    }).then(result => {
        if (result.isConfirmed) {
            const jumlah = document.getElementById('jumlah').value;
            const total = jumlah * harga;

            fetch('', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `action=pesan&paket_id=${id}&jumlah_orang=${jumlah}&total_harga=${total}`
            })
            .then(res => res.text())
            .then(res => {
                if (res.trim() === 'success') {
                    Swal.fire({
                        title: 'Pesanan Berhasil!',
                        text: 'Pesanan kamu telah dikirim, silakan tunggu konfirmasi admin.',
                        icon: 'success',
                        confirmButtonColor: '#2e86de'
                    });
                } else {
                    Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan pesanan.', 'error');
                }
            });
        }
    });
}
</script>

</body>
</html>
