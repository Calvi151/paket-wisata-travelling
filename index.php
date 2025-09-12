<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>.:Aplikasi Penilaian:.</title>
</head>
<body>
  <div id="wrapper">
    <header></header>
    <nav>
      <ul>
        <li><a href="?">Home</a></li>
        <li><a href="?page=kelas">Kelas</a></li>
        <li><a href="?page=siswa">Siswa</a></li>
        <li><a href="?page=mapel">Mata Pelajaran</a></li>
        <li><a href="?page=nilai">Nilai</a></li>
      </ul>
    </nav>
    <main>
      <?php
      if(isset($_GET['page'])){
        include('includes/'.$_GET['page'].'.php');
      }else{
        include('includes/home.php');
      }
      ?>
    </main>
  </div>
</body>
</html>