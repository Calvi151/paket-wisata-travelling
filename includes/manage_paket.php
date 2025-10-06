<!DOCTYPE html>
<html>
<head>
    <title>Data Kelas</title>
</head>
<body>
    <h2>Data Pelanggan</h2>
    <a href="../tambah_paket.php">+ Tambah Paket</a>
    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Paket Id</th>
            <th>Nama Paket</th>
            <th>Tujuan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Durasi</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php
        $con = mysqli_connect("localhost", "root", "", "dbs_travell") or die("gagal konek");
        $data = mysqli_query($con, "SELECT * FROM paket_wisata");
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?= $d['paket_id']?></td>
            <td><?= $d['nama_paket']; ?></td>
            <td><?= $d['tujuan']; ?></td>
            <td><?= $d['deskripsi']; ?></td>
            <td><?= $d['harga']; ?></td>
            <td><?= $d['durasi']; ?></td>
            <td><?= $d['foto']; ?></td>
            
            <td>
                <a href="edit_paket.php?paket_id=<?= $d['paket_id']; ?>">Edit</a> |
                <a href="hapus.php?paket_id=<?= $d['paket_id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h2 {
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
    a {
        text-decoration: none;
        color: #007BFF;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
