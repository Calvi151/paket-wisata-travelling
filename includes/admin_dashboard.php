<?php
$con= mysqli_connect("localhost","root","","dbs_travell") or die ("Connection eror");
$total_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM users"))['total'];
//$total_laporan = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM laporan"))['total'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div class="header" id="header">
     <h1 id="title">Admin Dashboard</h1>    
</div>
<div id="main">
    <button class="openbtn" onclick="toggleSidebar()">☰</button>
    </div>
   <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="cards" id="cards">
      <div class="card"> <h3>Total dari 
        Semua User Terdaftar</h3> <br>👤 Total Users: <?php echo $total_users; ?></div>
      <!-- <div class="card">📦 Total Produk: <?php //echo $total_laporan; ?></div>
      <div class="card">💵 Total Transaksi: <?php //echo $total_transaksi; ?></div> -->
        </div>
    </div>
    <script src="../scripts/script.js"></script>
</body>
</html>