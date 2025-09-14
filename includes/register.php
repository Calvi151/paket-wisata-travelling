<?php
$con = mysqli_connect("localhost","root","","dbs_travel") or die("Connection was not established");

$usernmae = "";
$password = "";

if(isset($_GET['act']) && $_GET['act'] == 'hapus' && isset($_GET['id'])){
    $usernmae_hapus = $_GET['id'];
    mysqli_query($con, "DELETE FROM users WHERE id = '$usernmae_hapus'");
    header('location:?');
    exit;
}
?>