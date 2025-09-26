<?php
session_start();
$con = mysqli_connect("localhost","root", "","dbs_travell") or die("Koneksi gagal");

if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username= '$username' AND password = '$password'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

 
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];
      if($row['role'] == 'admin'){
          header('Location: admin_dashboard.php');
      } else {
          header('Location: user_dashboard.php');
      }
      exit;
  } else {
      echo "<script>alert('Login gagal, periksa username dan password Anda'); window.location='login.php';</script>";
  }

 



