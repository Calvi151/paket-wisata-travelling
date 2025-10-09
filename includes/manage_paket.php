<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Paket Wisata - Travell</title>
    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #f4f6fb;
            color: #333;
            padding: 30px;
        }

        h2 {
            color: #0a3d80;
            text-align: center;
            margin-bottom: 25px;
        }

        /* Tombol Tambah */
        .btn-add {
            display: inline-block;
            background-color: #0a3d80;
            color: #fff;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-add:hover {
            background-color: #08376d;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        thead {
            background-color: #0a3d80;
            color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f2f6ff;
        }

        tr:hover {
            background-color: #eaf1ff;
        }

        th {
            font-weight: 600;
        }

        /* Gambar */
        td img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        /* Tombol aksi */
        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            margin-right: 5px;
            transition: 0.3s;
        }

        .btn-edit {
            background-color: #2a9d8f;
        }
        .btn-edit:hover {
            background-color: #21867d;
        }

        .btn-delete {
            background-color: #e63946;
        }
        .btn-delete:hover {
            background-color: #c71c2b;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                font-size: 13px;
                padding: 10px;
            }

            .btn-add {
                padding: 8px 14px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <h2>Data Paket Wisata</h2>
    <a href="../tambah_paket.php" class="btn-add">+ Tambah Paket</a>

    <table>
        <thead>
            <tr>
                <th>ID Paket</th>
                <th>Nama Paket</th>
                <th>Tujuan</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Durasi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $con = mysqli_connect("localhost", "root", "passwordbaru", "dbs_travell") or die("gagal konek");
            $data = mysqli_query($con, "SELECT * FROM paket_wisata");
            while ($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?= $d['paket_id']?></td>
                <td><?= $d['nama_paket']; ?></td>
                <td><?= $d['tujuan']; ?></td>
                <td><?= $d['deskripsi']; ?></td>
                <td>Rp <?= number_format($d['harga'], 0, ',', '.'); ?></td>
                <td><?= $d['durasi']; ?> hari</td>
                <td>
                    <?php if (!empty($d['foto'])) { ?>
                        <img src="../uploads/<?= $d['foto']; ?>" alt="Foto Paket">
                    <?php } else { ?>
                        <span style="color:#888;">(tidak ada)</span>
                    <?php } ?>
                </td>
                <td>
                    <a href="edit_paket.php?paket_id=<?= $d['paket_id']; ?>" class="btn-edit">Edit</a>
                    <a href="hapus.php?paket_id=<?= $d['paket_id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus paket ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
