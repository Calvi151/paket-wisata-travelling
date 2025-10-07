<?php
$con= mysqli_connect("localhost","root","","dbs_travell") or die ("Connection eror");
$total_admin = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM users WHERE role='admin'"))['total'];
$total_member = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM users WHERE role='user'"))['total'];
$pilih_admin = mysqli_query($con, "SELECT username from users WHERE role='admin' ORDER BY created_at DESC LIMIT 3" );
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
            <li><a href="manage_user.php">Manage Users</a></li>
            <li><a href="manage_paket.php">Manage Paket Wisata</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="cards" id="cards">
      <div class="card"> <h3>Total dari 
        Semua Admin Terdaftar</h3> 👤 Total Users: <?php echo $total_admin; ?>
    <br>
        Beberapa list Nama Admin di tempat ini
    <br>
        <ul>
            <?php while($row = mysqli_fetch_assoc($pilih_admin)) { ?>
                <li><?php echo $row['username']; ?></li>
            <?php } ?>
        </ul></div>
        <div class="card"> <h3>Total dari 
        Semua Member Terdaftar</h3> 👤 Total Users: <?php echo $total_member; ?></div>
        </div>

    </div>
    <script src="../scripts/script.js"></script>
</body>
</html>