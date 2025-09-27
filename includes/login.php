<?php
session_start();
$con = mysqli_connect("localhost","root", "","dbs_travell") or die("Koneksi gagal");

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // simpan session
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;
        } else {
            echo "<script>alert('Login gagal, periksa username dan password Anda'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Login gagal, periksa username dan password Anda'); window.location='login.php';</script>";
    }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <style>
        .hidden{
            display: none;
        }
        form{
            border: 5px solid black;
            margin-bottom: 10px;
            display:flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 350px;
            padding: 25px;
            background: linear-gradient(white, lightblue);
            border-radius: 20px;
            box-shadow: 5px 10px 18px #888888;
            font-family: Arial, Helvetica, sans-serif;
        }
        input{
            margin: 10px;
            align-items: center;
        }
        body{
            display: flex;
            justify-content: center;
           
        }
        input, select, button{
            padding: 10px;
            border-radius: 5px;
            border: 2px solid black;
            margin: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: scale3d(1deg);
        }
        form div{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        button{
            cursor: pointer;
            background-color: orange;
        }

    </style>
</head>
<body>
    <form action="" method="post">
        <h1>
            Register Account
        </h1>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="role">Role</label>
            <select name="role" id="role" required onchange="togglefields()">
                <option value="">--pilih posisi--</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
      <div id="customs-field" class="hidden">
         <div>
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" >
        </div>
         <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" >
        </div>
         <div>
            <label for="no_hp">No </label>
            <input type="text" name="no_hp" id="no_hp" >
        </div>
         <div>
            <label for="alamat">Alamat </label>
            <input type="text" name="alamat" id="alamat" >
        </div>
      </div>
      <button type="submit" name="submit" value="<?php echo $nameBtn ?>"><?php echo $valueBtn ?>
      </button>
    </form>

    <script>
        function togglefields(){
            const role = document.getElementById("role").value;
            const customsfield = document.getElementById("customs-field");
            if(role === "user"){
                customsfield.classList.remove("hidden");    
            }
            else{
                    customsfield.classList.add("hidden");
                }
            }
        
    </script>
</body>
</html>



